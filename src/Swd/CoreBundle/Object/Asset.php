<?php

namespace Swd\CoreBundle\Object;

/**
 * Asset
 */
class Asset extends \Swd\CoreBundle\Entity\Asset
{
	/**
	 * @var string
	 */
	private $createdByName;
	/**
	 * @var string
	 */
	private $updatedByName;

	/**
	 * Set id
	 * @param int $id
	 * @return Asset
	 */
	public function setId( $id )
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Get createdByName
	 * @return string
	 */
	public function getCreatedByName()
	{
		return $this->createdByName;
	}

	/**
	 * Set createdByName
	 * @param string $createdByName
	 * @return Asset
	 */
	public function setCreatedByName( $createdByName )
	{
		$this->createdByName = $createdByName;
		return $this;
	}

	/**
	 * Get updatedByName
	 * @return string
	 */
	public function getUpdatedByName()
	{
		return $this->updatedByName;
	}

	/**
	 * Set updatedByName
	 * @param string $updatedByName
	 * @return Asset
	 */
	public function setUpdatedByName( $updatedByName )
	{
		$this->updatedByName = $updatedByName;
		return $this;
	}

	/**
	 * Get created
	 * @return string
	 */
	public function getCreatedDateTime()
	{
		return DateService::getDateTime( $this->created );
	}

	/**
	 * Get created
	 * @return string
	 */
	public function getCreatedDateTimeFormat()
	{
		return DateService::formatDateTimeString( $this->created );
	}

	/**
	 * Get updated
	 * @return string
	 */
	public function getUpdatedDateTime()
	{
		return DateService::getDateTime( $this->updated );
	}

	/**
	 * Get updated
	 * @return string
	 */
	public function getUpdatedDateTimeFormat()
	{
		return DateService::formatDateTimeString( $this->updated );
	}
}
