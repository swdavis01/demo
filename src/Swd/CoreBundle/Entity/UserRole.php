<?php

namespace Swd\CoreBundle\Entity;

/**
 * UserRole
 */
class UserRole
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $roleId;

    /**
     * @var integer
     */
    private $id;

	/**
	 */
	private $role;

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserRole
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return UserRole
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->roleId;
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
	 * Get role
	 *
	 * @return Swd\CoreBundle\Entity\Role
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
