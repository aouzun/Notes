<?php

namespace Notes\Http\Controllers;

use Notes\Video;
use Illuminate\Http\Request;

use Notes\Section;
use Notes\Course;
use Notes\Department;
use FollowerHelper;
use Notes\Http\Middleware\Logger;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($_department,$_course,$_section)
    {
        $department = Department::findByName($_department);
        $course = Course::findByName($department->id,$_course);
        $section = Section::findByName($course->id,$_section);
/*
        $video_id = "cT9EFRd4LBw";

        $html = 'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key=AIzaSyA3HOCU1JTtPKK5dMKq9PL6pT_zE869100&part=snippet';
        $response = file_get_contents($html);
        $decoded = json_decode($response, true);
        foreach($decoded['items'] as $items){
            $title = $items['snippet']['title'];
            break;
        } 
        dd($title);

        */  
        return view('section.add_video',compact(['department','course','section']));
    }
    public static function getID($url){
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
        return $matches[1];
    }
    public static function getTitle($url){
        $video_id = self::getID($url);
        // Move it to file
        $key = 'AIzaSyA3HOCU1JTtPKK5dMKq9PL6pT_zE869100';
        $html = 'https://www.googleapis.com/youtube/v3/videos?id=' . $video_id .'&key=' . $key . '&part=snippet';
        $response = file_get_contents($html);
        $decoded = json_decode($response,true);
        foreach($decoded['items'] as $items){
            $title = $items['snippet']['title'];
            return $title;
        }
    }


    public static function getThumbnail($url){
        $id = self::getID($url);
        $src = "https://img.youtube.com/vi/" . $id . "/hqdefault.jpg";
        return $src;   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach($request->input('link') as $link){
            $id = self::getID(($link));
            if(Video::check($id)){
                $error = "One or more videos already exists. Please check again.";
                return view('error',compact('error'));

            }
        }
        foreach($request->input('link') as $link){
            $id = self::getID($link);
            if(!Video::check($id)){
                $video = new Video();
                $video->name = self::getTitle($link);
                $video->youtube_id = self::getID($link);
                $video->section_id = $request->input('id');

                $video->save();
                $_request = ['operation' => 'add', 'changed_data' => 'video', 'name' => $video->name, 'info' => null];
                Logger::handle($_request,$video->id);
            }
        }
        return redirect(FollowerHelper::findURL_S($request->input('id')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Notes\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Notes\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Notes\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Notes\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
