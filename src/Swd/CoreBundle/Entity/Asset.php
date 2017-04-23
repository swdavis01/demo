<?php

namespace Swd\CoreBundle\Entity;

/**
 * Asset
 */
class Asset
{
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var int
	 */
	private $createdBy;
	/**
	 * @var string
	 */
	private $createdByName;
	/**
	 * @var int
	 */
	private $updatedBy;
	/**
	 * @var string
	 */
	private $updatedByName;
	/**
	 * @var int
	 */
	private $isActive;
	/**
	 * @var int
	 */
	private $canDelete;
	/**
	 * @var int
	 */
	private $size;
	/**
	 * @var string
	 */
	private $manager;
	/**
	 * @var string
	 */
	private $url;
	/**
	 * @var string
	 */
	private $tag;
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $type;
	/**
	 * @var datetime
	 */
	private $created;
	/**
	 * @var datetime
	 */
	private $updated;

	/**
	 * Get id
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

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
	 * Get createdBy
	 * @return integer
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set createdBy
	 * @param int $createdBy
	 * @return Asset
	 */
	public function setCreatedBy( $createdBy )
	{
		$this->createdBy = $createdBy;
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
	 * Get updatedBy
	 * @return integer
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}

	/**
	 * Set updatedBy
	 * @param int $updatedBy
	 * @return Asset
	 */
	public function setUpdatedBy( $updatedBy )
	{
		$this->updatedBy = $updatedBy;
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
	 * Get isActive
	 * @return integer
	 */
	public function getIsActive()
	{
		return $this->isActive;
	}

	/**
	 * Set isActive
	 * @param int $isActive
	 * @return Asset
	 */
	public function setIsActive( $isActive )
	{
		$this->isActive = $isActive;
		return $this;
	}

	/**
	 * Get canDelete
	 * @return integer
	 */
	public function getCanDelete()
	{
		return $this->canDelete;
	}

	/**
	 * Set canDelete
	 * @param int $canDelete
	 * @return Asset
	 */
	public function setCanDelete( $canDelete )
	{
		$this->canDelete = $canDelete;
		return $this;
	}

	/**
	 * Get size
	 * @return integer
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Set size
	 * @param int $size
	 * @return Asset
	 */
	public function setSize( $size )
	{
		$this->size = $size;
		return $this;
	}

	/**
	 * Get manager
	 * @return string
	 */
	public function getManager()
	{
		return $this->manager;
	}

	/**
	 * Set manager
	 * @param string $manager
	 * @return Asset
	 */
	public function setManager( $manager )
	{
		$this->manager = $manager;
		return $this;
	}

	/**
	 * Get url
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Set url
	 * @param string $url
	 * @return Asset
	 */
	public function setUrl( $url )
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * Get tag
	 * @return string
	 */
	public function getTag()
	{
		return $this->tag;
	}

	/**
	 * Set tag
	 * @param string $tag
	 * @return Asset
	 */
	public function setTag( $tag )
	{
		$this->tag = $tag;
		return $this;
	}

	/**
	 * Get name
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set name
	 * @param string $name
	 * @return Asset
	 */
	public function setName( $name )
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * Get type
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set type
	 * @param string $type
	 * @return Asset
	 */
	public function setType( $type )
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * Get created
	 * @return \DateTime
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * Set created
	 * @param \DateTime $created
	 * @return Asset
	 */
	public function setCreated($created)
	{
		$this->created = $created;
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
	 *
	 * @return \DateTime
	 */
	public function getUpdated()
	{
		return $this->updated;
	}

	/**
	 * Set updated
	 * @param \DateTime $updated
	 * @return Asset
	 */
	public function setUpdated( $updated )
	{
		$this->updated = $updated;

		return $this;
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
