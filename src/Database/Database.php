<?php
/**
 * Created by PhpStorm.
 * User: uzhass
 * Date: 04.02.18
 * Time: 17:14
 */

namespace SnowSerge\Sql2Orm\Database;


use SnowSerge\Sql2Orm\Database\Db\DbStructure;
use SnowSerge\Sql2Orm\Database\Mapper\TableMapper;
use SnowSerge\Sql2Orm\Database\Structure\Relation;
use SnowSerge\Sql2Orm\Database\Structure\Table;

class Database
{
    /** @var Table[] */
    private $tables;
    /** @var Relation[][] */
    private $relations;

    /** @var DbStructure */
    private $dbStructure;
    /** @var TableMapper */
    private $mapper;

    /**
     * FillTables constructor.
     * @param DbStructure $dbStructure
     */
    public function __construct(DbStructure $dbStructure)
    {
        $this->dbStructure = $dbStructure;
        $this->tables = [];
        $this->relations = [];
        $this->mapper = new TableMapper($dbStructure);
        $this->setTables();
        $this->setRelation();
    }


    /**
     *
     */
    private function setTables(): void
    {
        $arrTables = $this->dbStructure->getListTables();
        foreach ($arrTables as $table) {
            $fields = $this->dbStructure->getListFields($table);
            $newTable = $this->mapper->getTable($table,$fields);
            $this->tables[$newTable->getName()] = $newTable;
        }
    }

    /**
     */
    private function setRelation(): void
    {
        foreach ($this->tables as $table) {
            $relations = $this->dbStructure->getRelations($table->getName());
            foreach ($relations as $relation) {
                $rel = $this->mapper->getRelations($this->tables,$relation);
                $this->relations[$rel->getTableMany()->getName()][$rel->getTableOne()->getName()] = $rel;
            }
        }
    }

    /**
     * @return Table[]
     */
    public function getTables(): array
    {
        return $this->tables;
    }

    /**
     * @return Structure\Relation[][]
     */
    public function getRelations(): array
    {
        return $this->relations;
    }

}