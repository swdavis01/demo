<?php

namespace Swd\CoreBundle\Entity;

/**
 * TableField
 */
class TableField
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var integer
     */
    private $type;
    
    public function __construct()
    {
        
    }

    /**
     * @return TableField
     */
    public static function get()
    {
        $object = new self();
        return $object;
    }

    /**
     * Set field
     * @param string $field
     * @return TableField
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * Get field
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set type
     * @param string $type
     * @return TableField
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }
}
