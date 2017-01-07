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
}
