<?php

namespace Swd\SecuredBundle\Entity;

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


}

