<?php
/**
 * Created by PhpStorm.
 * User: uzhass
 * Date: 04.02.18
 * Time: 17:37
 */

namespace SnowSerge\Sql2Orm\Database\Mapper;



use SnowSerge\Sql2Orm\Database\Db\DbStructure;
use SnowSerge\Sql2Orm\Database\Structure\Field;
use SnowSerge\Sql2Orm\Database\Structure\Relation;
use SnowSerge\Sql2Orm\Database\Structure\Table;

class TableMapper
{

    /** @var DbStructure */
    private $dbStructure;

    /**
     * TableMapper constructor.
     * @param $dbStructure
     */
    public function __construct($dbStructure)
    {
        $this->dbStructure = $dbStructure;
    }

    /**
     * @param $tableName
     * @param $fields
     * @return Table
     */
    public function getTable($tableName,array $fields): Table
    {
        $table = new Table($tableName);
        $fieldsArr = [];
        foreach ($fields as $field) {
            $newField = $this->getFieldList($field);
            $fieldsArr[$field['COLUMN_NAME']] = $newField;
            if(strtolower($field['COLUMN_KEY']) === 'pri') {
                $table->addPrimary($newField);
            }
        }
        $table->setFields($fieldsArr);
        return $table;
    }

        /**
         * @param array $field
         * @return Field
         */
    private function getFieldList(array $field): Field
    {
            return Field::getField($field['COLUMN_NAME'])
                ->setType($this->dbStructure->convertType($field['COLUMN_TYPE']))
                ->setNullable(strtolower($field['IS_NULLABLE']) === 'yes')
                ->setUnique(strtolower($field['COLUMN_KEY']) === 'uni');
    }

    /**
     * @param $tables Table[]
     * @param $relation array
     * @return Relation
     */
    public function getRelations(array $tables,array $relation): Relation
    {
            $tableMany = $tables[$relation['TABLE_NAME']];
            $tableOne = $tables[$relation['REFERENCED_TABLE_NAME']];
            return Relation::get()
                ->setTableMany($tableMany)
                ->setFieldMany($tableMany->getField($relation['COLUMN_NAME']))
                ->setTableOne($tableOne)
                ->setFieldOne($tableOne->getField($relation['REFERENCED_COLUMN_NAME']));
    }
}