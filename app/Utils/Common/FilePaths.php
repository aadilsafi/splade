<?php

namespace App\Utils\Common;

class FilePaths
{
	const DEFAULT_COURSE_IMAGE 	= '/images/defaults/course.png';
	const DEFAULT_SAMPLE_PDF 	= '/images/defaults/sample.pdf';

	const COURSE_DIRECTORY 		= '/images/courses';
	const RESOURCE_DIRECTORY 	= '/resource';

	public static function getCoursesDirectory($course_id)
	{
		return "/images/courses/$course_id";
	}
	public static function getTopicsDirectory($topic_id, $course_id)
	{
		return "/images/courses/$course_id/topics/$topic_id";
	}
	public static function getResourceDirectory($resource_id)
	{
		return "/resource/$resource_id";
	}
}
