<?php

namespace Swd\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieItem
 *
 * @ORM\Table(name="movie_item", indexes={@ORM\Index(name="year", columns={"year"}), @ORM\Index(name="format_id", columns={"format_id"}), @ORM\Index(name="title", columns={"title"})})
 * @ORM\Entity
 */
class MovieItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="smallint", nullable=true)
     */
    private $year;

    /**
     * @var integer
     *
     * @ORM\Column(name="format_id", type="smallint", nullable=false)
     */
    private $formatId;

    /**
     * @var integer
     *
     * @ORM\Column(name="imdb_number", type="bigint", nullable=true)
     */
    private $imdbNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return MovieItem
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
     * Set year
     *
     * @param integer $year
     *
     * @return MovieItem
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set formatId
     *
     * @param integer $formatId
     *
     * @return MovieItem
     */
    public function setFormatId($formatId)
    {
        $this->formatId = $formatId;

        return $this;
    }

    /**
     * Get formatId
     *
     * @return integer
     */
    public function getFormatId()
    {
        return $this->formatId;
    }

    /**
     * Set imdbNumber
     *
     * @param integer $imdbNumber
     *
     * @return MovieItem
     */
    public function setImdbNumber($imdbNumber)
    {
        $this->imdbNumber = $imdbNumber;

        return $this;
    }

    /**
     * Get imdbNumber
     *
     * @return integer
     */
    public function getImdbNumber()
    {
        return $this->imdbNumber;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return MovieItem
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return MovieItem
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return MovieItem
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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return MovieItem
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
}
