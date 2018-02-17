<?php

namespace Swd\CoreBundle\Object;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieItem
 *
 */
class MovieItem
{
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
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
