<?php

namespace Swd\SecuredBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieDirector
 *
 * @ORM\Table(name="movie_director", indexes={@ORM\Index(name="director", columns={"director"})})
 * @ORM\Entity
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


}

