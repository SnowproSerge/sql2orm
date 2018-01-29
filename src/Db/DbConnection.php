<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Db;


class DbConnection
{
    /** @var \PDO */
    private $pdo;

    /** @var string|null */
    private $schema;
    /**
     * DbConnection constructor.
     * @param string $host
     * @param string $port
     * @param string $user
     * @param string $password
     * @param string $nameDb
     * @param string $driver
     * @param string|null $schema
     */
    public function __construct($host, $port, $user, $password, $nameDb,$driver='mysql',$schema = null)
    {
        $dsn = $driver . ':' . 'host=' . $host . ';dbname='.$nameDb . ';port='. $port.';charset=UTF8';
        echo $dsn;
        $this->pdo = new \PDO($dsn,$user,$password);
    }

    /**
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    /**
     * @return null|string
     */
    public function getSchema(): ?string
    {
        return $this->schema;
    }



}