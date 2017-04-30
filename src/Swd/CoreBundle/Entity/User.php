<?php

namespace Swd\CoreBundle\Entity;

use Swd\CoreBundle\Services\CommonService;
use Swd\CoreBundle\Services\DateService;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var boolean
     */
    private $isActive = '1';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var string
     */
    private $username;

	/**
	 * @var string
	 */
	private $name;

    /**
     * @var \DateTime
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $updated = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

	/**
	 */
	protected $userRoles;

	/**
	 * @var array()
	 */
	protected $userRoleIds;

	/**
	 * @var int
	 */
	private $assetId;

	/**
	 * @var Swd/CoreBundle/Entity/Asset;
	 */
	private $asset;

	private $profileImageUrl;

    /**yy
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
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
	 * @param string $username
	 * @return User
	 */
	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * Get username
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
	 * Get created
	 *
	 * @return string
	 */
	public function getCreatedDateTime()
	{
		return DateService::getDateTime( $this->created );
	}

	/**
	 * Get created
	 *
	 * @return string
	 */
	public function getCreatedDateTimeFormat()
	{
		return DateService::formatDateTimeString( $this->created );
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
	 * Get updated
	 *
	 * @return string
	 */
	public function getUpdatedDateTime()
	{
		return DateService::getDateTime( $this->updated );
	}

	/**
	 * Get updated
	 *
	 * @return string
	 */
	public function getUpdatedDateTimeFormat()
	{
		return DateService::formatDateTimeString( $this->updated );
	}

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
	 * @return User
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getRecid()
	{
		return $this->id;
	}

	public function __construct()
	{
		$this->isActive = true;
		$this->userRoles = new \Doctrine\Common\Collections\ArrayCollection();
		$this->userRoleIds = array();
		$this->created = new \DateTime();
		$this->updated = new \DateTime();
	}

	/** @see \Serializable::serialize() */
	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->username,
			$this->password,
		));
	}

	/** @see \Serializable::unserialize() */
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->username,
			$this->password,
			) = unserialize($serialized);
	}

	public function isAccountNonExpired()
	{
		return true;
	}

	public function isAccountNonLocked()
	{
		return true;
	}

	public function isCredentialsNonExpired()
	{
		return true;
	}

	public function getSalt()
	{
		// you *may* need a real salt depending on your encoder
		// see section on salt below
		return null;
	}

	public function setUserRoles( $userRoles )
	{
		$this->userRoles = $userRoles;
	}

	public function getUserRoles() {

		$result = array();

		foreach( $this->userRoles as $userRole )
		{
			$result[] = $userRole;
		}

		return $result;
	}

	public function getRoles()
	{
		$roles = array();
		foreach( $this->userRoles as $role )
		{
			$roles[] = 'ROLE_' . $role->getRole()->getName();
		}
		//CommonService::debug( $roles ); exit;
		return $roles;
	}

	public function setUserRoleIds( $userRoleIds )
	{
		if ( is_array( $userRoleIds ) )
		{
			$this->userRoleIds = $userRoleIds;
		}
	}

	public function getUserRoleIds() {
		return $this->userRoleIds;
	}

	public function getRolesString()
	{
		return implode( ", ", str_replace( 'ROLE_', '', $this->getRoles() ) );
	}

	public function eraseCredentials()
	{
	}

	public function isEnabled()
	{
		return $this->isActive;
	}

	public function debug()
	{
		CommonService::debug( $this->getUsername() );
		CommonService::debug( $this->getRoles() );
	}

    /**
     * Add user role
     *
     * @param \Swd\CoreBundle\Entity\UserRole $userRole
     *
     * @return User
     */
    public function addUserRole(\Swd\CoreBundle\Entity\UserRole $userRole)
    {
        $this->userRoles[] = $userRole;
		//$userRole->setUser($this);

        return $this;
    }

    /**
     * Remove user role
     *
     * @param \Swd\CoreBundle\Entity\UserRole $userRole
     */
    public function removeUserRole(\Swd\CoreBundle\Entity\UserRole $userRole)
    {
        $this->userRoles->removeElement($userRole);
    }

	/**
	 * Get assetId
	 * @return string
	 */
	public function getAssetId()
	{
		return $this->assetId;
	}

	/**
	 * Set assetId
	 * @param string $assetId
	 * @return User
	 */
	public function setAssetId($assetId)
	{
		$this->assetId = $assetId;

		return $this;
	}

	/**
	 * Get asset
	 * @return string
	 */
	public function getAsset()
	{
		return $this->asset;
	}

	/**
	 * Set asset
	 * @param object $asset
	 * @return Swd/CoreBundle/Entity/Asset
	 */
	public function setAsset( $asset )
	{
		$this->asset = $asset;

		return $this;
	}


	/**
	 * Set profileImageUrl
	 * @param string $profileImageUrl
	 * @return User
	 */
	public function setProfileImageUrl($profileImageUrl)
	{
		$this->profileImageUrl = $profileImageUrl;

		return $this;
	}

	/**
	 * Get profileImageUrl
	 * @return string
	 */
	public function getProfileImageUrl()
	{
		return $this->profileImageUrl;
	}

	/**
	 * Get profileImageUrl
	 * @return string
	 */
	public function getProfileImageUrlTag( $width = 24, $height = 24 )
	{
		if ( strlen( $this->profileImageUrl ) > 0 )
		{
			return '<img src="' . $this->getProfileImageUrl() . '" width="' . $width . '", height="' . $height . '">';
		}
	}
}
