<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Storage;
use App\Item;
use App\Chapter;
use App\Person;
use App\ChapterPerson;
use App\Tag;
use App\Taggable;

class IngestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $json = Storage::disk('local')->get('data.json');
        $data = json_decode($json);
        $i = 0;
        foreach($data->data as $idx => $item)
        {
            $itemParams = [
                'id'                    => $item->id,
                'name'                  => $item->name,
                'month'                 => $item->month,
                'year'                  => $item->year,
                'yearmonth'             => $item->year.$item->month,
                'cover_variant'         => $item->cover_variant,
                'special_issue'         => $item->special_issue,
                'front_cover_path'      => $item->coverphoto->src,
                'front_cover_name'      => 'Front Cover',
                'front_cover_persons'   => '',
                'back_cover_path'       => '',
                'back_cover_name'       => 'Back Cover',
                'back_cover_persons'    => '',
            ];

            // Setup Tags
            $item->tags = [];
            if(strlen($item->year))
            {
                $item->tags[] = $item->year;
            }
            if(strlen($item->special_issue))
            {
                $item->tags[] = 'Special Issue';
            }
            
            $chapters_persons   = [];
            $persons            = [];
            foreach($item->toc as $idx2 => $toc)
            {
                if($toc->title == 'Back Cover')
                {
                    if($itemParams['front_cover_path'] != $toc->coverphoto->src)
                    {
                        $itemParams['back_cover_path'] = $toc->coverphoto->src;
                    }
                    break;
                }

                if(strlen($toc->title) == 0)
                {
                    // echo '<pre>'.print_r($toc,TRUE).'</pre>';
                    continue;
                }

                $chapterParams = [
                    'id'        => $toc->id,
                    'name'      => $toc->title,
                    'pagenum'   => $toc->pagenum,
                    'item_id'  => $item->id
                ];
                $chapterObj = Chapter::create($chapterParams);
                $chapterObj->id = $toc->id;
                $chapterObj->save();
                

                foreach($toc->artists as $idx3 => $artist)
                {
                    $persons[$artist->id] = $artist->name;
                    $chapters_persons[$toc->id.'.'.$artist->id] = ['chapter_id' => $toc->id, 'person_id' => $artist->id];
                }
            }

            foreach($persons as $person_id => $person_name)
            {
                $personParams = [
                    'id'     => $person_id,
                    'name'   => (strlen($person_name) ? $person_name : 'Missing')
                ];
                    
                $personObj = Person::create($personParams);

                $personObj->id = $person_id;
                $personObj->save();
            }
            
            foreach($chapters_persons as $key => $val)
            {
                if(strlen($val['person_id']) == 0)
                {
                    // echo '<pre>'.print_r($val,TRUE).'</pre>';
                    continue;
                }
                $caParams = [
                    'id'            => Str::uuid(),
                    'chapter_id'    => $val['chapter_id'],
                    'person_id'     => $val['person_id'],
                    'role'          => 'artist',
                    'item_id'      => $item->id
                ];

                ChapterPerson::create($caParams);
            }
            
            $itemObj = Item::create($itemParams);
            
            // Save with original ID
            $itemObj->id = $item->id;
            $itemObj->save();

            foreach($item->tags as $idx => $tag)
            {
                $tagObj = Tag::firstOrNew(['tag' => $tag]);
                $tagObj->tag = $tag;
                $tagObj->save();

                $itemObj->tag($tagObj);
            }
            $i++;
        }
        die("Ingested ".$i." Items");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
