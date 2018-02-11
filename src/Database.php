<?php
/**
 * Created by PhpStorm.
 * User: uzhass
 * Date: 04.02.18
 * Time: 17:14
 */

namespace SnowSerge\Sql2Orm;


use SnowSerge\Sql2Orm\Db\DbStructure;
use SnowSerge\Sql2Orm\Mapper\TableMapper;
use SnowSerge\Sql2Orm\Structure\Relation;
use SnowSerge\Sql2Orm\Structure\Table;

class Database
{
    /** @var Table[] */
    private $tables;
    /** @var Relation[] */
    private $relations;

    /** @var DbStructure */
    private $dbStructure;

    /**
     * FillTables constructor.
     * @param DbStructure $dbStructure
     */
    public function __construct(DbStructure $dbStructure)
    {
        $this->dbStructure = $dbStructure;
    }


    /**
     *
     */
    public function setTables(): void
    {
        $arrTables = $this->dbStructure->getListTables();
        $tables = [];
        $mapper = new TableMapper($this->dbStructure);
        foreach ($arrTables as $table) {
            $tables[] = $mapper->getTables($table);
        }
        $this->tables = $tables;
    }

}