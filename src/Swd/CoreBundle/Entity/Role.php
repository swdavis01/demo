<?php

namespace Swd\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role", indexes={@ORM\Index(name="role", columns={"role"})})
 * @ORM\Entity
 */
class Role
{
    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     */
    private $role;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
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
	 * @ORM\ManyToMany(targetEntity="User")
	 * @ORM\JoinTable(name="user_role",
	 *         joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
	 *         inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
	 * )
	 * @var User[]
	 */
	protected $users;

	public function __construct() {
		$this->users = new \Doctrine\Common\Collections\ArrayCollection();
	}
}
