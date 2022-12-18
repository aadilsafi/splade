<?php

namespace App\Utils\Common;
class QuestionCategory{

	const Excel        = 1;
	const Powerpoint   = 2;
	const Power_BI 	   = 3;
	const Stakeholder  = 4;
	const Presentation = 5;
	const Analytical   = 6;
	const Forecasting  = 7;

	const Types = [
		self::Excel         => 'MS Excel',
		self::Powerpoint    => 'MS Powerpoint',
		self::Power_BI	    => 'Power BI',
		self::Stakeholder   => 'Stakeholder / Conflict Management',
		self::Presentation  => 'Presentation Skills',
		self::Analytical    => 'Analytical Skills',
		self::Forecasting   => 'Forecasting Skills'
	];
}
