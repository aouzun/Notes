<?php


namespace Notes\Http\Helpers;

use Notes\Follower;
use Notes\Department;
use Notes\Course;
use Notes\Section;

use DB;
class FollowerHelper{
	public static function checkFollowed($type,$user_id,$id){
		return Follower::check($type,$user_id,$id) ? 'Unfollow' : 'Follow';	
	}

	public static function findURL_D($department_id){
		$path = '/';
		$department = Department::find($department_id);
		$path = $path . $department->slug_name . '/';

		return $path;
	}

	public static function findURL_C($course_id){
		$course = Course::find($course_id);
		$path = self::findURL_D($course->department_id) . $course->slug_name . '/';
		return $path;
	}

	public static function findURL_S($section_id){
		$section = Section::find($section_id);
		$path = self::findURL_C($section->course_id) . $section->slug_name . '/';
		return $path;
	}

	public static function findPopular($type){
		$res = DB::table('followers')->where(['type' => $type])->groupBy('followed_id');
		$first;
		$second;
		if($type == 1){
			$first = 'departments';
			$second = 'departments.id';
		}
		else if($type == 2){
			$first = 'courses';
			$second = 'course.id';
		}
		else if($type == 3){
			$first = 'sections';
			$second = 'sections.id';
		}

		$res == $res->join($first,'followers.followed_id','=',$second)->select(DB::raw('*,count(*) as follower_count'));
		return $res->get();
	}

	public static function findPopularCourses($department_id){
		return DB::select('select * from (select *,id as course_id from courses where department_id = :department_id) as t1 join (select *,count(*) as follower_count,id as _id from followers where type = :type group by followed_id) as t2 on t1.id = t2.followed_id order by follower_count desc ',
			['department_id' => $department_id,'type' => 2]);

	}

}

