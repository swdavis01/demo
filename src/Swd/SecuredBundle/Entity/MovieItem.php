<?php

namespace Swd\SecuredBundle\Entity;

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


}

