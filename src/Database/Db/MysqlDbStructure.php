<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Database\Db;
use PDO;
use SnowSerge\Sql2Orm\Database\Structure\Field;

/**
 * Generated for MySQL
 * Class MysqlDbStructure
 * @package SnowSerge\Sql2Orm\Db
 */
class MysqlDbStructure extends DbStructure
{
    private static $types = [
        '/^bit$|^bit\([1-9][0-9]?\)$/' => Field::BYTE,
        '/^smallint$|^smallint\([1-9][0-9]?\)$/' => Field::BYTE,
        '/^mediumint$|^mediumint\([1-9][0-9]?\)$/' => Field::INTEGER,
        '/^int$|^int\([1-9][0-9]?\)$/' => Field::INTEGER,
        '/^integer$|^integer\([1-9][0-9]?\)$/' => Field::INTEGER,
        '/^bigint$|^bigint\([1-9][0-9]?\)$/' => Field::LONG,
        '/^serial$/' => Field::LONG,
        '/^dec$|^dec\([1-9][0-9]?\)$|^dec\([1-9][0-9]?,[1-9][0-9]?\)$/' => Field::FLOAT,
        '/^decimal$|^decimal\([1-9][0-9]?\)$|^decimal\([1-9][0-9]?,[1-9][0-9]?\)$/' => Field::FLOAT,
        '/^double$|^double\([1-9][0-9]?\)$|^double\([1-9][0-9]?,[1-9][0-9]?\)$/' => Field::DOUBLE,
        '/^float$|^float\([1-9][0-9]?\)$|^float\([1-9][0-9]?,[1-9][0-9]?\)$/' => Field::FLOAT,
        '/^date$/' => Field::DATE,
        '/^datetime$|^datetime\([1-6]\)$/' => Field::DATETIME,
        '/^time$|^time\([1-6]\)$/' => Field::TIME,
        '/^timestamp$|^timestamp\([1-6]\)$/' => Field::TIMESTAMP,
        '/^enum(.*)$/' => Field::ENUM. '$1',

    ];

    public function setConnection($nameDb, $host, $user, $password, $port): DbConnection
    {
        if(empty($port)) {
            $port = '3306';
        }
        return new DbConnection($host,$port,$user,$password,$nameDb,'mysql');
    }

    public function getListTables(): array
    {
        $stat = $this->dbConnector->getPdo()->query('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA= SCHEMA()');
        return $stat->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getListFields($table): array
    {
        $sql = "SELECT COLUMN_NAME,COLUMN_TYPE,COLUMN_KEY,IS_NULLABLE FROM INFORMATION_SCHEMA.columns WHERE TABLE_SCHEMA = SCHEMA() AND TABLE_NAME = '{$table}'";
        $stat = $this->dbConnector->getPdo()->query($sql);
        return $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $table
     * @return array
     */
    public function getRelations($table): array
    {
        $sql = 'SELECT `TABLE_NAME`, `COLUMN_NAME`, `REFERENCED_TABLE_NAME`, `REFERENCED_COLUMN_NAME`'
            . ' FROM `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`'
            . " WHERE `TABLE_SCHEMA` = SCHEMA() AND `REFERENCED_TABLE_NAME` IS NOT NULL AND `TABLE_NAME` = '{$table}'";
        $stat = $this->dbConnector->getPdo()->query($sql);
        return $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function closeConnection(): void
    {
        $this->dbConnector->close();
    }

    public function convertType(string $type): string
    {
        $t = trim($type);
        $count = 0;
        foreach (self::$types as $pattern => $replacement) {
            $out = preg_replace($pattern.'i', $replacement, $t, 1, $count);
            if($count) {
                return $out;
            }
        }
        return 'string';
    }
}