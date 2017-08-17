<?php

namespace Notes;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public static function findBySection($section_id){
    	return Note::where('section_id','=',$section_id)->get();
    }
}
