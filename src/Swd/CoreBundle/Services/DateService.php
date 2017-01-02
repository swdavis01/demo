<?php

namespace Swd\CoreBundle\Services;

class DateService
{
	const DATE_TIME_FORMAT = 'jS M, Y g:i A';
	const DATE_FORMAT = 'jS M, Y';
	const DATE_TIME = 'Y-m-d H:i:s';
	const DATE = 'Y-m-d';
	const DATE_TIME_UI = 'd MMM yyyy hh:mm tt';

	public static function formatDateTime( \DateTime $date )
	{
		return $date->format( self::DATE_TIME_FORMAT );
	}

	public static function getDateTime( \DateTime $date )
	{
		return $date->format( self::DATE_TIME );
	}
}
