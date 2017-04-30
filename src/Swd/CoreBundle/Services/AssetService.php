<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Services\CommonService;
use Swd\CoreBundle\Database\Database;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AssetService
{
	/**
	 * @var \Swd\CoreBundle\Database\Database
	 */
	private $db;

	/**
	 * @var string
	 */
	private $configPath;

	/**
	 * @var \Aws\S3\S3Client
	 */
	private $client;

	/**
	 * @var string
	 */
	private $bucket;

	/**
	 * AssetService constructor.
	 * @param Database $db
	 * @param EncoderFactoryInterface $encoderFactory
	 */
	public function __construct( Database $db, $configPath )
	{
		$this->db = $db;
		$this->configPath = $configPath;

		//$this->connect();
	}

	private function connect()
	{
		if ( !is_object( $this->client ) )
		{
			$config = json_decode( file_get_contents( $this->configPath ) );
			try {
				$this->client = new S3Client(array(
					'version' => $config->version,
					'region'  => $config->region,
					'credentials' => array(
						'key'    => $config->credentials->key,
						'secret' => $config->credentials->secret,
					)
				));

				$this->bucket = $config->bucket;
			} catch (S3Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n"; exit;
			}
		}
	}

	public function uploadFile( UploadedFile $file, $path = "" )
	{
		$this->connect();
		echo "";

		$bucketPath = $this->bucket;
		if ( strlen( $path ) )
		{
			//$bucketPath .= "/" . $path;
		}

		try {
			$result = $this->client->putObject(array(
				'Bucket'       => $bucketPath,
				'Key'          => $file->getClientOriginalName(),
				'SourceFile'   => $file->getRealPath(),
				'ContentType'  => $file->getMimeType(),
				'ACL'          => 'public-read'
			));
		} catch (S3Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n"; exit;
		}

		$params = array
		(
			'size' => $file->getSize(),
			'url' => $result->get('ObjectURL'),
			'tag' => $result->get('ETag'),
			'name' => $file->getClientOriginalName(),
			'type' => $file->getMimeType()
		);

		$id = $this->save( $params );

		return $id;
	}

	/**
	 * @param array $params
	 * @return string
	 */
	public function save( $params = array() )
	{
  		$size = 0;
  		$manager = "AWS";
  		$url = "";
  		$tag = "";
  		$name = "";
  		$type = "";
		$isActive = 1;

		extract( $params );

		$sql = "
			isActive = :isActive,
			size = :size,
			manager = :manager,
			url = :url,
			tag = :tag,
			name = :name,
			type = :type,
			created = :created,
			updated = :updated
		";

		$placeholders = array
		(
			':isActive' => $isActive,
			':size' => $size,
			':manager' => $manager,
			':url' => $url,
			':tag' => $tag,
			':name' => $name,
			':type' => $type,
			':created' => DateService::getCurrentDateTimeString(),
			':updated' => DateService::getCurrentDateTimeString()
		);

		$sql = "INSERT INTO asset SET " . $sql;
		$this->db->execute( $sql, $placeholders );
		$id = $this->db->lastInsertId();

		return $id;
	}

}
