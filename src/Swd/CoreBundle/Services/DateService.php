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

	public static function formatDateTimeString( string $date )
	{
		$date = new \DateTime( $date );
		return self::formatDateTime( $date );
	}

	public static function getDateTime( $date )
	{
	    if ( !$date instanceof \DateTime )
        {
            $date = new \DateTime( $date );
        }

		return $date->format( self::DATE_TIME );
	}

	public static function getCurrentDateTimeString()
	{
		$date = new \DateTime();

		return $date->format( self::DATE_TIME );
	}
}
