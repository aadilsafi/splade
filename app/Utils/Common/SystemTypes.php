<?php
namespace App\Utils\Common;

class SystemTypes{
	const LMS = 1;
	const PORTAL = 2;
	const ALL = [
		self::LMS => 'Learning Managment System',
		self::PORTAL => 'Portal',
	];
}