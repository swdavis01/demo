<?php

namespace Swd\CoreBundle\Object;

use Swd\CoreBundle\Services\CommonService;
use Swd\CoreBundle\Services\DateService;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 */
class User extends \Swd\CoreBundle\Entity\User implements AdvancedUserInterface, \Serializable
{
	/**
	 */
	protected $userRoles;

	/**
	 * @var array()
	 */
	protected $userRoleIds;

	/**
	 * @var Swd/CoreBundle/Object/Asset;
	 */
	private $asset;

	/**
	 * @var string
	 */
	private $profileImageUrl;

	/**
	 * @var blob
	 */
	private $profileImageData;

	/**
	 * Get created
	 *
	 * @return string
	 */
	public function getCreatedDateTime()
	{
		return DateService::getDateTime( $this->getCreated() );
	}

	/**
	 * Get created
	 *
	 * @return string
	 */
	public function getCreatedDateTimeFormat()
	{
		return DateService::formatDateTimeString( $this->getCreated() );
	}


	/**
	 * Get updated
	 *
	 * @return string
	 */
	public function getUpdatedDateTime()
	{
		return DateService::getDateTime( $this->getUpdated() );
	}

	/**
	 * Get updated
	 *
	 * @return string
	 */
	public function getUpdatedDateTimeFormat()
	{
		return DateService::formatDateTimeString( $this->getUpdated() );
	}

 	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getRecid()
	{
		return $this->getId();
	}

	public function __construct()
	{
		$this->setIsactive( true );
		$this->userRoles = new \Doctrine\Common\Collections\ArrayCollection();
		$this->userRoleIds = array();
		$this->setCreated( new \DateTime() );
		$this->setUpdated( new \DateTime() );
	}

	/** @see \Serializable::serialize() */
	public function serialize()
	{
		return serialize(array(
            $this->getId(),
            $this->getUsername(),
            $this->getPassword(),
		));
	}

	/** @see \Serializable::unserialize() */
	public function unserialize($serialized)
	{
		list (
			$id,
			$username,
			$password,
			) = unserialize($serialized);

        $this->setId( $id );
        $this->setUsername( $username );
        $this->setPassword( $password );
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
		return $this->getIsactive();
	}

	public function debug()
	{
		CommonService::debug( $this->getUsername() );
		CommonService::debug( $this->getRoles() );
	}

    /**
     * Add user role
     *
     * @param \Swd\CoreBundle\Object\UserRole $userRole
     *
     * @return User
     */
    public function addUserRole(\Swd\CoreBundle\Object\UserRole $userRole)
    {
        $this->userRoles[] = $userRole;
		//$userRole->setUser($this);

        return $this;
    }

    /**
     * Remove user role
     *
     * @param \Swd\CoreBundle\Object\UserRole $userRole
     */
    public function removeUserRole(\Swd\CoreBundle\Object\UserRole $userRole)
    {
        $this->userRoles->removeElement($userRole);
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
	 * @return Swd/CoreBundle/Object/Asset
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
	 * Set profileImageData
	 * @param string $profileImageData
	 * @return User
	 */
	public function setProfileImageData($profileImageData)
	{
		$this->profileImageData = $profileImageData;

		return $this;
	}

	/**
	 * Get profileImageData
	 * @return string
	 */
	public function getProfileImageData()
	{
		return $this->profileImageData;
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
