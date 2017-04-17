<?php

namespace Swd\CoreBundle\Entity;

/**
 * Role
 */
class Role
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

	/**
	 * @var string
	 */
	private $section;

	/**
	 * @var priority
	 */
	private $priority;

	/**
	 */
	protected $users;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Role
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

	public function __construct() {
		$this->users = new \Doctrine\Common\Collections\ArrayCollection();
	}

    /**
     * Set section
     *
     * @param string $section
     *
     * @return Role
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

	/**
	 * Set priority
	 *
	 * @param smallint $priority
	 *
	 * @return Role
	 */
	public function setPriority($priority)
	{
		$this->priority = $priority;

		return $this;
	}

	/**
	 * Get priority
	 *
	 * @return smallint
	 */
	public function getPriority()
	{
		return $this->priority;
	}



    /**
     * Add user
     *
     * @param \Swd\CoreBundle\Entity\UserRole $user
     *
     * @return Role
     */
    public function addUser(\Swd\CoreBundle\Entity\UserRole $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Swd\CoreBundle\Entity\UserRole $user
     */
    public function removeUser(\Swd\CoreBundle\Entity\UserRole $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
