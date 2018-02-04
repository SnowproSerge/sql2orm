<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Db;
use PDO;

/**
 * Generated for MySQL
 * Class MysqlDbStructure
 * @package SnowSerge\Sql2Orm\Db
 */
class MysqlDbStructure extends DbStructure
{
    public function setConnection($nameDb, $host, $user, $password, $port): DbConnection
    {
        if(empty($port)) {
            $port = '3306';
        }
        return new DbConnection($host,$port,$user,$password,$nameDb,'mysql');
    }

    public function getListTables(): array
    {
        $stat = $this->dbConnector->getPdo()->query('SHOW TABLES');
        return $stat->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getListFields($table): array
    {
        // TODO: Implement getListFields() method.
        return [];
    }

    public function getRelations($table): array
    {
        // TODO: Implement getRelations() method.
        return [];
    }

    public function closeConnection(): void
    {
    }


}