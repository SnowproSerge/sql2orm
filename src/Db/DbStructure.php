<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Db;


abstract class DbStructure
{
    /** @var DbConnection */
    public $dbConnector;

    /**
     * DbStructure constructor.
     * @param DbConnection $dbConnector
     */
    public function __construct(DbConnection $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    abstract public function getListTables();
    abstract public function getListFields($table);
    abstract public function getRelations($table);
}