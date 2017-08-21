<?php


namespace Notes\Http\Helpers;

use Notes\Follower;
use Notes\Department;
use Notes\Course;
use Notes\Section;
use Auth;
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
		if($course){
			$path = self::findURL_D($course->department_id) . $course->slug_name . '/';
			return $path;
		}
		return '/';
		
	}

	public static function findURL_S($section_id){
		$section = Section::find($section_id);
		$path = self::findURL_C($section->course_id) . $section->slug_name . '/';
		return $path;
	}

	public static function findPopularDepartments(){
		$type = 1;
		$res = DB::table('followers')->where(['type' => $type])->groupBy('followed_id');
		
		$first = 'departments';
		$second = 'departments.id';
	

		$res == $res->join($first,'followers.followed_id','=',$second)->select(DB::raw('*,count(*) as follower_count'))->take(10);
		return $res->get();
	}

	public static function findPopularCourses($department_id){
		return DB::select('select * from (select *,id as course_id from courses where department_id = :department_id) as t1 join (select *,count(*) as follower_count,id as _id from followers where type = :type group by followed_id) as t2 on t1.id = t2.followed_id order by follower_count desc ',
			['department_id' => $department_id,'type' => 2]);

	}

	public static function findPopularSections($course_id){
		return DB::select('select * from (select *,id as section_id from sections where course_id = :course_id) as t1 join (select *,count(*) as follower_count,id as _id from followers where type = :type group by followed_id) as t2 on t1.id = t2.followed_id order by follower_count desc',
			['course_id' => $course_id,'type' => 3]);	
	}


	public static function findNewDepartments(){
		return DB::select('select * from departments order by created_at desc');
	}

	public static function findNewCourses($department_id){
		return DB::select('select * from courses where department_id = :department_id order by created_at desc',['department_id' => $department_id]);
	}

	public static function findNewSections($course_id){
		return DB::select('select * from sections where course_id = :course_id order by created_at desc',['course_id' => $course_id]);
	}

	public static function getUserID(){
		$user = Auth::user();

		if($user){
			return $user->id;
		}
		return -1;
	}


	public static function getCreatedByUser($user_id){
		$created_departments = self::createdDepartments($user_id);
		$created_courses = self::createdCourses($user_id);
		$created_sections = self::createdSections($user_id);
		
		return compact(['created_departments','created_courses','created_sections']);

	}


	public static function createdDepartments($user_id){
		return DB::select('select * from (select * from logs where user_id = :user_id and changed_data = "department") as t1 join (select *,id as department_id from departments) as t2 on t1.data_id = t2.id',['user_id' => $user_id]);
	}
	public static function createdCourses($user_id){
		return DB::select('select * from (select * from logs where user_id = :user_id and changed_data = "course") as t1 join (select *,id as course_id from courses) as t2 on t1.data_id = t2.id',['user_id' => $user_id]);
	}

	public static function createdSections($user_id){
		return DB::select('select * from (select * from logs where user_id = :user_id and changed_data = "section") as t1 join (select *,id as section_id from sections) as t2 on t1.data_id = t2.id',['user_id' => $user_id]);
	}


	public static function getProfileURL($user_id){
		return '/profile/' . $user_id;
	}
}

