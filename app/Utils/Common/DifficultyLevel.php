<?php
namespace App\Utils\Common;
class DifficultyLevel{
	const EASY = 1;
	const MEDIUM = 2;
	const DIFFICULT = 3;
	const TYPES = [
		self::EASY => 'Easy',
		self::MEDIUM => 'Medium',
		self::DIFFICULT	   => 'Difficult'
	];
}