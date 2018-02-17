<?php

namespace Swd\CoreBundle\Object;

/**
 * Role
 */
class Role extends \Swd\CoreBundle\Entity\Role
{
	/**
	 */
	protected $users;

	public function __construct() {
		$this->users = new \Doctrine\Common\Collections\ArrayCollection();
	}

    /**
     * Add user
     *
     * @param \Swd\CoreBundle\Object\UserRole $user
     *
     * @return Role
     */
    public function addUser(\Swd\CoreBundle\Object\UserRole $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Swd\CoreBundle\Object\UserRole $user
     */
    public function removeUser(\Swd\CoreBundle\Object\UserRole $user)
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
