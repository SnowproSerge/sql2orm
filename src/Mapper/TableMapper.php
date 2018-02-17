<?php
/**
 * Created by PhpStorm.
 * User: uzhass
 * Date: 04.02.18
 * Time: 17:37
 */

namespace SnowSerge\Sql2Orm\Mapper;



use SnowSerge\Sql2Orm\Db\DbStructure;
use SnowSerge\Sql2Orm\Structure\Field;
use SnowSerge\Sql2Orm\Structure\Relation;
use SnowSerge\Sql2Orm\Structure\Table;

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


    public function getTable($tableName,$fields): Table
    {
        $table = new Table($tableName);
        $listFields = $this->getFieldList($fields,$this->dbStructure);
        $table->setFields($listFields);
        return $table;
    }

    /**
     * @param array $arrFields
     * @return Field[]
     */
    private function getFieldList(array $arrFields): array
    {
        $fields = [];
        foreach ($arrFields as $field) {
            $newField = Field::getField($field['COLUMN_NAME'])
                ->setType($this->dbStructure->convertType($field['COLUMN_TYPE']))
                ->setNullable(strtolower($field['IS_NULLABLE']) === 'yes')
                ->setUnique(strtolower($field['COLUMN_KEY']) === 'uni');
            $fields[$field['COLUMN_NAME']] = $newField;
        }
        return $fields;
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