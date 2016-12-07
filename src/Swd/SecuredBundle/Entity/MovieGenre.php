<?php

namespace Swd\SecuredBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieGenre
 *
 * @ORM\Table(name="movie_genre", indexes={@ORM\Index(name="genre", columns={"genre"})})
 * @ORM\Entity
 */
class MovieGenre
{
    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=50, nullable=false)
     */
    private $genre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

