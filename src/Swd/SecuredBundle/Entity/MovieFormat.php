<?php

namespace Swd\SecuredBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieFormat
 *
 * @ORM\Table(name="movie_format", indexes={@ORM\Index(name="format", columns={"format"})})
 * @ORM\Entity
 */
class MovieFormat
{
    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=50, nullable=false)
     */
    private $format;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

