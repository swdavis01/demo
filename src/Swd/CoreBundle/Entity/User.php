<?php

namespace Swd\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swd\CoreBundle\Services\CommonService;
use Swd\CoreBundle\Services\DateService;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=true)
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
	 * @Assert\NotBlank()
	 * @Assert\Email(
	 *     message = "not a valid email address",
	 *     checkMX = true
	 * )
     */
    private $username;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=255, nullable=false)
	 * @Assert\NotBlank()
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
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
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
	 * Get created
	 *
	 * @return string
	 */
	public function getCreatedDateTime()
	{
		return DateService::getDateTime( $this->created );
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
	 * @param int $id
	 *
	 * @return User
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @ORM\OneToMany(targetEntity="UserRole", mappedBy="user", cascade={"persist", "remove"})
	 */
	protected $userRoles;

	public function __construct()
	{
		$this->isActive = true;
		$this->userRoles = new \Doctrine\Common\Collections\ArrayCollection();
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

		foreach( $this->userRoles as $role )
		{
			$result[] = $role;
			//echo $role->getUserId() . "<br />";
		}

		return $result;
		//return $this->userRoles;
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
		$userRole->setUser($this);

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
}
