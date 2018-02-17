<?php

namespace Swd\CoreBundle\Object;

/**
 * UserRole
 */
class UserRole extends \Swd\CoreBundle\Entity\UserRole
{
	/**
	 */
	private $role;

	/**
	 * Get role
	 *
	 * @return Swd\CoreBundle\Object\Role
	 */
	public function getRole()
	{
		return $this->role;
	}

	/**
	 * @param $role
	 * @return $this
	 */
	public function setRole($role)
	{
		$this->role = $role;

		return $this;
	}
}
