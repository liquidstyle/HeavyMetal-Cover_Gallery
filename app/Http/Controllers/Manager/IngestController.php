<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Storage;
use App\Title;
use App\Chapter;
use App\Author;
use App\ChapterAuthor;
use App\Tag;

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
        foreach($data->data as $idx => $title)
        {
            $titleParams = [
                'id'                    => $title->id,
                'name'                  => $title->name,
                'month'                 => $title->month,
                'year'                  => $title->year,
                'yearmonth'             => $title->year.$title->month,
                'cover_variant'         => $title->cover_variant,
                'special_issue'         => $title->special_issue,
                'front_cover_path'      => $title->coverphoto->src,
                'front_cover_name'      => 'Front Cover',
                'front_cover_authors'   => '',
                'back_cover_path'       => '',
                'back_cover_name'       => 'Back Cover',
                'back_cover_authors'    => '',
            ];

            foreach($title->tags as $key => $val)
            {
                $tagParams = [
                    'id'        => $key,
                    'tag'       => $val,
                    'title_id'  => $title->id,
                ];
                Tag::create($tagParams);
            }

            $chapters_authors   = [];
            $authors            = [];
            foreach($title->toc as $idx2 => $toc)
            {
                if($toc->title == 'Back Cover')
                {
                    if($titleParams['front_cover_path'] != $toc->coverphoto->src)
                    {
                        $titleParams['back_cover_path'] = $toc->coverphoto->src;
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
                    'title_id'  => $title->id
                ];
                Chapter::create($chapterParams);

                foreach($toc->artists as $idx3 => $artist)
                {
                    $authors[$artist->id] = $artist->name;
                    $chapters_authors[$toc->id.'.'.$artist->id] = ['chapter_id' => $toc->id, 'author_id' => $artist->id];
                }
            }

            foreach($authors as $author_id => $author_name)
            {
                $authorParams = [
                    'id'            => $author_id,
                    'name'   => (strlen($author_name) ? $author_name : 'Missing')
                ];
                    
                Author::create($authorParams);
            }
            
            foreach($chapters_authors as $key => $val)
            {
                if(strlen($val['author_id']) == 0)
                {
                    // echo '<pre>'.print_r($val,TRUE).'</pre>';
                    continue;
                }
                $caParams = [
                    'id'            => Str::uuid(),
                    'chapter_id'    => $val['chapter_id'],
                    'author_id'     => $val['author_id'],
                    'title_id'      => $title->id
                ];
                ChapterAuthor::create($caParams);
            }

            Title::create($titleParams);
            $i++;
        }
        die("Ingested ".$i." Titles");
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
