<?php

namespace Swd\CoreBundle\Entity;

use Swd\CoreBundle\Entity\TableField;

/**
 * Table
 */
class Table
{
    /**
     * @var string
     */
    private $name;

	/**
     * @var array TableField
	 */
	protected $fields;

    /**
     * Table constructor
     */
    public function __construct()
    {
        
    }

    /**
     * @return Table
     */
    public static function get()
    {
        $object = new self();
        return $object;
    }

    /**
     * Set name
     * @param string $name
     * @return Table
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add field
     * @param TableField $field
     * @return Table
     */
    public function addField(TableField $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Remove field
     * @param TableField $field
     */
    public function removeField(TableField $field)
    {
        foreach( $this->fields as $k => $f )
        {
            if ( $f->getId() == $field->getId() )
            {
                unset( $this->fields[$k] );
            }
        }
    }

    /**
     * Get fields
     * @return array TableField
     */
    public function getFields()
    {
        return $this->fields;
    }
}
