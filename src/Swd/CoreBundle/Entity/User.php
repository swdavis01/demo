<?php

namespace Swd\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="username", columns={"username"}), @ORM\Index(name="assetId", columns={"assetId"}), @ORM\Index(name="createdBy", columns={"createdBy"}), @ORM\Index(name="updatedBy", columns={"updatedBy"})})
 * @ORM\Entity
 */
class User
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
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true)
     */
    private $isactive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="canDelete", type="boolean", nullable=true)
     */
    private $candelete;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

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
     * @var integer
     *
     * @ORM\Column(name="assetId", type="bigint", nullable=false)
     */
    private $assetid = '0';

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set isactive
     *
     * @param boolean $isactive
     *
     * @return User
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
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return User
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
     * @return User
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
     * Set assetid
     *
     * @param integer $assetid
     *
     * @return User
     */
    public function setAssetid($assetid)
    {
        $this->assetid = $assetid;

        return $this;
    }

    /**
     * Get assetid
     *
     * @return integer
     */
    public function getAssetid()
    {
        return $this->assetid;
    }

    /**
     * Set createdby
     *
     * @param integer $createdby
     *
     * @return User
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
     * @return User
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
}
