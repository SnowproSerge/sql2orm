<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Structure;

/**
 * Relation One to Many
 *
 * Class Relation
 * @package SnowSerge\Sql2Orm\Structure
 */
class Relation
{
    /** @var Table */
    private $tableOne;
    /** @var Field */
    private $fieldOne;
    /** @var Table */
    private $tableMany;
    /** @var Field */
    private $fieldMany;

    /**
     * Relation constructor.
     * @param $tableOne
     * @param $fieldOne
     * @param $tableMany
     * @param $fieldMany
     */
    public function __construct($tableOne, $fieldOne, $tableMany, $fieldMany)
    {
        $this->tableOne = $tableOne;
        $this->fieldOne = $fieldOne;
        $this->tableMany = $tableMany;
        $this->fieldMany = $fieldMany;
    }

    /**
     * @return Table
     */
    public function getTableOne(): Table
    {
        return $this->tableOne;
    }

    /**
     * @return Field
     */
    public function getFieldOne(): Field
    {
        return $this->fieldOne;
    }

    /**
     * @return Table
     */
    public function getTableMany(): Table
    {
        return $this->tableMany;
    }

    /**
     * @return Field
     */
    public function getFieldMany(): Field
    {
        return $this->fieldMany;
    }
}