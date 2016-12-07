<?php

namespace Swd\SecuredBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieItemGenre
 *
 * @ORM\Table(name="movie_item_genre", indexes={@ORM\Index(name="item_id", columns={"item_id"}), @ORM\Index(name="genre_id", columns={"genre_id"}), @ORM\Index(name="item_genre", columns={"item_id", "genre_id"})})
 * @ORM\Entity
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


}

