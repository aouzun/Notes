<?php

namespace Notes;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public static function check($id){
    	$ret = Video::where('youtube_id',$id)->get();
    	return !$ret->isEmpty();
    }

    public static function findBySection($section_id){
    	return Video::where('section_id',$section_id)->get();
    }

}
