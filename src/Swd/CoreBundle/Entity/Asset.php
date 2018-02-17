<?php

namespace Swd\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asset
 *
 * @ORM\Table(name="asset", indexes={@ORM\Index(name="createdBy", columns={"createdBy"}), @ORM\Index(name="updatedBy", columns={"updatedBy"}), @ORM\Index(name="manager", columns={"manager"}), @ORM\Index(name="name", columns={"name"}), @ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 */
class Asset
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="createdBy", type="bigint", nullable=false)
     */
    private $createdby = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="updatedBy", type="bigint", nullable=false)
     */
    private $updatedby = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true)
     */
    private $isactive = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="canDelete", type="boolean", nullable=true)
     */
    private $candelete = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="bigint", nullable=false)
     */
    private $size = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="manager", type="string", length=50, nullable=false)
     */
    private $manager = '';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=false)
     */
    private $tag = '';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=false)
     */
    private $type = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    private $path = '';



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdby
     *
     * @param integer $createdby
     *
     * @return Asset
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get createdby
     *
     * @return integer
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set updatedby
     *
     * @param integer $updatedby
     *
     * @return Asset
     */
    public function setUpdatedby($updatedby)
    {
        $this->updatedby = $updatedby;

        return $this;
    }

    /**
     * Get updatedby
     *
     * @return integer
     */
    public function getUpdatedby()
    {
        return $this->updatedby;
    }

    /**
     * Set isactive
     *
     * @param boolean $isactive
     *
     * @return Asset
     */
    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get isactive
     *
     * @return boolean
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Set candelete
     *
     * @param boolean $candelete
     *
     * @return Asset
     */
    public function setCandelete($candelete)
    {
        $this->candelete = $candelete;

        return $this;
    }

    /**
     * Get candelete
     *
     * @return boolean
     */
    public function getCandelete()
    {
        return $this->candelete;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return Asset
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set manager
     *
     * @param string $manager
     *
     * @return Asset
     */
    public function setManager($manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return string
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Asset
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Asset
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Asset
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Asset
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Asset
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Asset
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
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
     * Set path
     *
     * @param string $path
     *
     * @return Asset
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
