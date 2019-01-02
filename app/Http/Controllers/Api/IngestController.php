<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Storage;

use App\User;
use App\Item;
use App\Chapter;
use App\Person;
use App\ChapterPerson;
use App\Tag;
use App\Taggable;
use App\Image;
use App\Imageable;

use \stdClass;

use SoapBox\Formatter\Formatter;

class IngestController extends Controller
{

    public function index()
    {
        // $this->dump();
        $this->process_csv();
        $this->process_likes();
        die();
    }

    public function process_likes()
    {
        $file       = public_path().'/data/hm_likes.csv';
        $csv        = file_get_contents($file);
        $formatter  = Formatter::make($csv, Formatter::CSV);
        $json       = json_decode($formatter->toJson());

        $user = User::where('email','me@jayemiller.com')->first();
        Auth::loginUsingId($user->id);
        $i=0;
        foreach($json as $idx => $like)
        {
            $item = Item::find($like->likeable_id);
            if(! isset($item->id))
            {
                echo '<div style="color:red">Item Not Found: '.$like->likeable_id.'</div>';
            } else {
                    $item->like();
            $i++;
            }
        }

        echo "Ingested ".$i." Item Likes<br>";

        return ;
    }

    public function process_csv()
    {
        $file       = public_path().'/data/hm_data.csv';
        $csv        = file_get_contents($file);
        $formatter  = Formatter::make($csv, Formatter::CSV);
        $json       = json_decode($formatter->toJson());

        $data = self::normalize($json);

        $i=0;
        foreach($data as $idx => $issue)
        {
            self::process($issue);
            $i++;
        }

        echo "Ingested ".$i." Items<br>";

        return ;
    }

    private function normalize($json)
    {
        foreach($json as $idx => $row)
        {
            $key = $row->issue_name.'-'.$row->issue_published_month.'-'.$row->issue_published_year;
            if(! isset($data[$key]))
            {
                $issue = new stdClass();
                $issue->id                  = $row->issue_id;
                $issue->name                = $row->issue_name;
                $issue->cover_variant       = $row->issue_cover_variant;
                $issue->special_issue       = $row->issue_special_issue;
                $issue->published_month     = $row->issue_published_month;
                $issue->published_year      = $row->issue_published_year;
                $issue->front_image         = $row->issue_front_image;
                $issue->front_image_name    = $row->issue_front_image_name;
                $issue->front_image_persons = explode('^',$row->issue_front_image_persons);
                $issue->back_image          = $row->issue_back_image;
                $issue->back_image_name     = $row->issue_back_image_name;
                $issue->back_image_persons  = explode('^',$row->issue_back_image_persons);
                $issue->tags                = explode('^',$row->issue_tags);
                $issue->chapters            = [];

                $data[$key]  = $issue;
            }

            if( strlen($row->chapter_name) > 0)
            {
                $chapter = new stdClass();
                $chapter->id            = $row->chapter_id;
                $chapter->page          = $row->chapter_page;
                $chapter->name          = $row->chapter_name;
                $chapter->subtitle      = $row->chapter_subtitle;
                $chapter->description   = $row->chapter_description;
                $chapter->persons       = explode('^',$row->chapter_persons);

                $data[$key]->chapters[] = $chapter;

            }
        }
        return $data;
    }
    

    public function process($item)
    {

            $itemObj = Item::firstOrNew(['id'=>$item->id,'name'=>$item->name,'month'=>$item->published_month,'year'=>$item->published_year]);
            $itemObj->yearmonth = $item->published_year.$item->published_month;
            $itemObj->cover_variant = $item->cover_variant;
            $itemObj->special_issue = $item->special_issue;
            $itemObj->save();

            $itemObj->id = $item->id;
            $itemObj->save();
            
            // Setup Tags
            $item->tags = [];
            if(strlen($item->published_year))
            {
                $item->tags[] = $item->published_year;
            }
            if(strlen($item->special_issue))
            {
                $item->tags[] = 'Special Issue';
            }
            
            // Save Front Image
            if(strlen($item->front_image))
            {
                $imageObj = Image::firstOrNew(['path' => $item->front_image]);
                $imageObj->key = 'frontcover';
                $imageObj->name = 'Front Cover';
                $imageObj->path = $item->front_image;
                $imageObj->save();

                $itemObj->image($imageObj);
            }

            // Save Back Image
            if(strlen($item->back_image))
            {
                $imageObj = Image::firstOrNew(['path' => $item->back_image]);
                $imageObj->key = 'backcover';
                $imageObj->name = 'Back Cover';
                $imageObj->path = $item->back_image;
                $imageObj->save();

                $itemObj->image($imageObj);
            }

            $chapters_persons   = [];
            $persons            = [];
            foreach($item->chapters as $idx2 => $toc)
            {
                
                if(strlen($toc->name) == 0)
                {
                    continue;
                }

                $chapterParams = [
                    'id'            => $toc->id,
                    'name'          => $toc->name,
                    'subtitle'      => $toc->subtitle,
                    'description'   => $toc->description,
                    'pagenum'       => (strlen($toc->page) == 0 ? 5555 : $toc->page),
                    'item_id'       => $itemObj->id
                ];
                $chapterObj = Chapter::create($chapterParams);

                foreach($toc->persons as $idx3 => $person)
                {
                    $personObj = Person::firstOrNew(['name' => $person]);
                    $personObj->name = $person;
                    $personObj->save();

                    $persons[$personObj->id] = $personObj->name;
                    $chapters_persons[$chapterObj->id.'.'.$personObj->id] = ['chapter_id' => $chapterObj->id, 'person_id' => $personObj->id];
                }
            }
            
            foreach($chapters_persons as $key => $val)
            {
                if(strlen($val['person_id']) == 0)
                {
                    // echo '<pre>'.print_r($val,TRUE).'</pre>';
                    continue;
                }
                $caParams = [
                    'chapter_id'    => $val['chapter_id'],
                    'person_id'     => $val['person_id'],
                    'role'          => 'artist',
                    'item_id'       => $itemObj->id
                ];

                ChapterPerson::create($caParams);
            }
            
            foreach($item->tags as $idx => $tag)
            {
                $tagObj = Tag::firstOrNew(['tag' => $tag]);
                $tagObj->tag = $tag;
                $tagObj->save();

                $itemObj->tag($tagObj);
            }
    }






















    /** Turn OLD Json to CSV */
    public function dump()
    {
        $json = Storage::disk('local')->get('data.json');
        $json = json_decode($json);

        $headers = [
            'issue_id',
            'issue_name',
            'issue_published_month',
            'issue_published_year',
            'issue_cover_variant',
            'issue_special_issue',
            'issue_tags',
            'issue_front_image',
            'issue_front_image_name',
            'issue_front_image_persons',
            'issue_back_image',
            'issue_back_image_name',
            'issue_back_image_persons',
            'chapter_id',
            'chapter_page',
            'chapter_name',
            'chapter_subtitle',
            'chapter_description',
            'chapter_persons',
        ];
        $return = implode(',',$headers)."\n";
        $returnArr = [];
        foreach($json->data as $idx => $row)
        {
            $issueBase = [
                'issue_id'                      => $row->id,
                'issue_name'                    => $row->name,
                'issue_published_month'         => $row->month,
                'issue_published_year'          => $row->year,
                'issue_cover_variant'           => NULL,
                'issue_special_issue'           => NULL,
                'issue_tags'                    => NULL,
                'issue_front_image'             => NULL,
                'issue_front_image_name'        => NULL,
                'issue_front_image_persons'     => NULL,
                'issue_back_image'              => NULL,
                'issue_back_image_name'         => NULL,
                'issue_back_image_persons'      => NULL,
                'chapter_id'                    => NULL,
                'chapter_page'                  => NULL,
                'chapter_name'                  => NULL,
                'chapter_subtitle'              => NULL,
                'chapter_description'           => NULL,
                'chapter_persons'               => NULL,
            ];

            $issue = [
                'issue_id'                      => $row->id,
                'issue_name'                    => $row->name,
                'issue_published_month'         => $row->month,
                'issue_published_year'          => $row->year,
                'issue_cover_variant'           => $row->cover_variant,
                'issue_special_issue'           => $row->special_issue,
                'issue_tags'                    => $row->year,
                'issue_front_image'             => NULL,
                'issue_front_image_name'        => NULL,
                'issue_front_image_persons'     => NULL,
                'issue_back_image'              => NULL,
                'issue_back_image_name'         => NULL,
                'issue_back_image_persons'      => NULL,
                'chapter_id'                    => NULL,
                'chapter_page'                  => NULL,
                'chapter_name'                  => NULL,
                'chapter_subtitle'              => NULL,
                'chapter_description'           => NULL,
                'chapter_persons'               => NULL,
            ];

            $outRow = $issue;
            foreach($row->toc as $idx2 => $toc)
            {

                if(! in_array($toc->pagenum,['0','9999']))
                {
                    continue;
                }

                // Build Artists Array
                $artists = [];
                foreach($toc->artists as $idx3 => $artist)
                {
                    $artists[] = $artist->name;
                }
                $artists = implode('^',$artists);

                if($toc->pagenum == 0) // is this a front cover
                {
                    $outRow['issue_front_image']            = $toc->coverphoto->src;
                    $outRow['issue_front_image_name']       = $toc->title;
                    $outRow['issue_front_image_persons']    = $artists;
                } else if($toc->pagenum == 9999)// is this a back cover 
                {
                    if($toc->coverphoto->src == $outRow['issue_front_image'])
                    {
                        continue;
                    }
                    $outRow['issue_back_image']             = $toc->coverphoto->src;
                    $outRow['issue_back_image_name']        = $toc->title;
                    $outRow['issue_back_image_persons']     = $artists;
                }
            }

            // setup chapter rows
            $chapter_i=0;
            foreach($row->toc as $idx2 => $toc)
            {
                if($chapter_i > 0)
                {
                    $outRow = $issueBase;
                }


                if(in_array($toc->pagenum,['0','9999']))
                {
                    continue;
                }

                // Build Artists Array
                $artists = [];
                foreach($toc->artists as $idx3 => $artist)
                {
                    $artists[] = $artist->name;
                }
                $artists = implode('^',$artists);
                
                $title = explode('^',$toc->title);

                $outRow['chapter_id']           = $toc->id;
                $outRow['chapter_page']         = $toc->pagenum;
                $outRow['chapter_name']         = (isset($title[0]) ? trim($title[0]) : NULL);
                $outRow['chapter_subtitle']     = (isset($title[1]) ? '"'.trim($title[1]).'"' : NULL);
                $outRow['chapter_persons']      = $artists;
                   
                $chapter_i++;
                $return .= implode(',',$outRow)."\n";
            }
        }
 
        die($return);
    }

}
