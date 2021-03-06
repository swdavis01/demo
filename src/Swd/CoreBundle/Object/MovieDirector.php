<?php

namespace Swd\CoreBundle\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieDirector
 *
 */
class MovieDirector
{
    /**
     * @var string
     *
     * @ORM\Column(name="director", type="string", length=50, nullable=false)
     */
    private $director;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set director
     *
     * @param string $director
     *
     * @return MovieDirector
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
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
}
