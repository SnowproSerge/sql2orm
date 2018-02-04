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
use SnowSerge\Sql2Orm\Structure\Table;

class FillTables
{
    /** @var Table[] */
    private $tables;

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
            $tables[] = $mapper->mapTable($table);
        }
        $this->tables = $tables;
    }

}