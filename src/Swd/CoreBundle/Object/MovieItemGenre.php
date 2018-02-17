<?php

namespace Swd\CoreBundle\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieItemGenre
 *
 */
class MovieItemGenre
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
     * @ORM\Column(name="genre_id", type="bigint", nullable=false)
     */
    private $genreId;

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
     * @return MovieItemGenre
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
     * Set genreId
     *
     * @param integer $genreId
     *
     * @return MovieItemGenre
     */
    public function setGenreId($genreId)
    {
        $this->genreId = $genreId;

        return $this;
    }

    /**
     * Get genreId
     *
     * @return integer
     */
    public function getGenreId()
    {
        return $this->genreId;
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
