<?php
/**
 * @author: Sergey Naryshkin
 * @date: 21.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use SnowSerge\Sql2Orm\Builder\Folder;
use SnowSerge\Sql2Orm\Database\Database;

abstract class Builder
{
    /** @var Database */
    protected $database;
    /** @var string */
    protected $namespace;
    /** @var string */
    protected $suffix;

    /**
     * Builder constructor.
     * @param Database $database
     * @param string $namespace
     * @param string $suffix
     */
    public function __construct(Database $database, string $namespace, string $suffix)
    {
        $this->database = $database;
        $this->namespace = $namespace;
        $this->suffix = $suffix;
    }

    abstract public function build(string $tableName): Folder;
}