<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Db;


abstract class DbStructure
{
    /** @var DbConnection */
    protected $dbConnector;

    /**
     * DbStructure constructor.
     */
    public function __construct($nameDb,$host,$user,$password,$port=0)
    {
        $this->dbConnector = $this->setConnection($nameDb,$host,$user,$password,$port);
    }

    abstract public function setConnection($nameDb,$host,$user,$password,$port): DbConnection;
    abstract public function getListTables(): array;
    abstract public function getListFields($table): array;
    abstract public function getRelations($table): array;
}