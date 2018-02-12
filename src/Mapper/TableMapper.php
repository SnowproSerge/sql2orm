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
     * @param DbStructure $dbStructure
     */
    public function __construct(DbStructure $dbStructure)
    {
        $this->dbStructure = $dbStructure;
    }


    public function getTable($tableName): Table
    {
        $table = new Table($tableName);
        $listFields = $this->getFieldList($this->dbStructure->getListFields($tableName));
        $table->setFields($listFields);


        // todo make method
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
                ->setType($field['COLUMN_TYPE'])
                ->setNullable(strtolower($field['IS_NULLABLE']) === 'yes')
                ->setUnique(strtolower($field['COLUMN_KEY']) === 'uni');
            $fields[$field['COLUMN_NAME']] = $newField;
        }
        return $fields;
    }

    /**
     * @param $tables Table[]
     * @return array
     */
    private function getRelations($tables): array
    {
        $relations = [];
        $arrRelation = $this->dbStructure->getRelations($tables);
        foreach ($arrRelation as $relation) {
            $rel = Relation::get()
                ->setTableMany($relation['TABLE_NAME'])
                ->setFieldMany($relation['COLUMN_NAME'])
                ->setTableOne($relation['REFERENCED_TABLE_NAME'])
                ->setFieldOne($relation['REFERENCED_COLUMN_NAME']);
            $relations[] = $rel;
        }
        return $relations;
    }
}