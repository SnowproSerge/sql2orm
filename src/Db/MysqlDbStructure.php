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
        $sql = "select COLUMN_NAME,COLUMN_TYPE,COLUMN_KEY from `INFORMATION_SCHEMA`.columns where TABLE_SCHEMA = SCHEMA() and TABLE_NAME = '{$table}'";
//        $stat = $this->dbConnector->getPdo()->query('show columns from '.$table);
        $stat = $this->dbConnector->getPdo()->query($sql);
        return $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRelations($table): array
    {
        $sql = 'select `TABLE_NAME`, `COLUMN_NAME`, `REFERENCED_TABLE_NAME`, `REFERENCED_COLUMN_NAME`'
            . ' FROM `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`'
            . "WHERE `TABLE_SCHEMA` = SCHEMA() AND `REFERENCED_TABLE_NAME` IS NOT NULL AND `TABLE_NAME` = '$table'";
        $stat = $this->dbConnector->getPdo()->query($sql);
        return $stat->fetchAll(PDO::FETCH_COLUMN);
    }

    public function closeConnection(): void
    {
        $this->dbConnector->close();
    }


}