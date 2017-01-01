<?php

namespace Swd\CoreBundle\Response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiResponse extends JsonResponse
{
	public static function Response( Request $request, $result )
	{
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(new JsonEncoder()));

		return new Response( $request->query->get('callback') . "(" . $serializer->serialize( $result, 'json' ) . ")" );
	}
}
