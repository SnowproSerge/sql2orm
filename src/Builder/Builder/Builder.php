<?php
/**
 * @author: Sergey Naryshkin
 * @date: 21.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use SnowSerge\Sql2Orm\Builder\Folder;
use SnowSerge\Sql2Orm\Database\Database;
use SnowSerge\Sql2Orm\Database\Structure\Field;

abstract class Builder
{
    /** @var Database */
    protected $database;
    /** @var string */
    protected $namespace;
    /** @var string */
    protected $suffix;

    /** @var array */
    public static $convertType = [
        '/^'.Field::BYTE.'/'        => 'int',
        '/^'.Field::TIMESTAMP.'/'   => 'int',
        '/^'.Field::INTEGER.'/'     => 'int',
        '/^'.Field::LONG.'/'        => 'int',
        '/^'.Field::DATE.'/'        => 'date',
        '/^'.Field::DATETIME.'/'    => 'date',
        '/^'.Field::TIME.'/'        => 'date',
        '/^'.Field::FLOAT.'/'       => 'float',
        '/^'.Field::DOUBLE.'/'      => 'double',
        '/^'.Field::STRING.'/'      => 'string',
        '/^'.Field::ENUM.'\(.*\)/'  => 'string'
    ];

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

    /**
     * Convert the type of OPM to the type of PHP
     *
     * @param string $type
     * @return string
     */
    protected function convertType(string $type): string
    {
        return preg_replace(array_keys(self::$convertType),array_values(self::$convertType),$type);
    }

    abstract public function build(): Folder;



}