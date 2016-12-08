<?php

namespace Swd\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieCategory
 *
 * @ORM\Table(name="movie_category", indexes={@ORM\Index(name="category", columns={"category"})})
 * @ORM\Entity
 */
class MovieCategory
{
    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=50, nullable=false)
     */
    private $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set category
     *
     * @param string $category
     *
     * @return MovieCategory
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
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
