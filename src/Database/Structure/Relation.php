<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Database\Structure;

/**
 * Relation One to Many
 *
 * Class Relation
 * @package SnowSerge\Sql2Orm\Structure
 */
final class Relation
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
     */
    public function __construct()
    {
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

    /**
     * @param Table $tableOne
     * @return Relation
     */
    public function setTableOne(Table $tableOne): Relation
    {
        $this->tableOne = $tableOne;
        return $this;
    }

    /**
     * @param Field $fieldOne
     * @return Relation
     */
    public function setFieldOne(Field $fieldOne): Relation
    {
        $this->fieldOne = $fieldOne;
        return $this;
    }

    /**
     * @param Table $tableMany
     * @return Relation
     */
    public function setTableMany(Table $tableMany): Relation
    {
        $this->tableMany = $tableMany;
        return $this;
    }

    /**
     * @param Field $fieldMany
     * @return Relation
     */
    public function setFieldMany(Field $fieldMany): Relation
    {
        $this->fieldMany = $fieldMany;
        return $this;
    }

    /**
     * Factory method
     * @return Relation
     */
    public static function get(): Relation
    {
        return new self();
    }
}