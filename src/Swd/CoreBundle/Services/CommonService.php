<?php

namespace Swd\CoreBundle\Services;

class CommonService
{
	public static function debug( $object )
	{
		echo "<pre>";
			var_dump( $object );
		echo "</pre>";
	}

	public static function print_r( $object )
	{
		echo "<pre>";
		print_r( $object );
		echo "</pre>";
	}
}
