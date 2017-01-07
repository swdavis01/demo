<?php

namespace Swd\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieItemDirector
 *
 * @ORM\Table(name="movie_item_director", indexes={@ORM\Index(name="item_id", columns={"item_id"}), @ORM\Index(name="director_id", columns={"director_id"}), @ORM\Index(name="item_director", columns={"item_id", "director_id"})})
 * @ORM\Entity
 */
class MovieItemDirector
{
    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="bigint", nullable=false)
     */
    private $itemId;

    /**
     * @var integer
     *
     * @ORM\Column(name="director_id", type="bigint", nullable=false)
     */
    private $directorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set itemId
     *
     * @param integer $itemId
     *
     * @return MovieItemDirector
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set directorId
     *
     * @param integer $directorId
     *
     * @return MovieItemDirector
     */
    public function setDirectorId($directorId)
    {
        $this->directorId = $directorId;

        return $this;
    }

    /**
     * Get directorId
     *
     * @return integer
     */
    public function getDirectorId()
    {
        return $this->directorId;
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
