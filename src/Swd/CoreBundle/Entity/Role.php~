<?php

namespace Swd\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role", indexes={
 *     @ORM\Index(name="name", columns={"name"}),
 *     @ORM\Index(name="section", columns={"section"}),
 *     @ORM\Index(name="priority", columns={"priority"})
 * })
 * @ORM\Entity
 */
class Role
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="section", type="string", length=255, nullable=true)
	 */
	private $section;

	/**
	 * @var priority
	 *
	 * @ORM\Column(name="priority", type="smallint", nullable=false)
	 */
	private $priority;

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

	/**
	 * @ORM\OneToMany(targetEntity="UserRole", mappedBy="role")
	 */
	protected $users;

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


}
