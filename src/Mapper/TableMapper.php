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


    public function mapTable($tableName): Table
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
    public function getFieldList(array $arrFields): array
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


}