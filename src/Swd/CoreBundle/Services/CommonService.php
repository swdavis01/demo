<?php

namespace Swd\CoreBundle\Services;

class CommonService
{
	public function __construct()
	{
	}

	public static function debug( $object )
	{
		echo "<pre>";
			print_r( $object );
		echo "</pre>";
	}
}
