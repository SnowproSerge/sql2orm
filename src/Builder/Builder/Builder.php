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

    /**
     * Returning string with declaration variable
     *
     * @param string $name Name of variable
     * @param string $type Type of variable
     * @return string String with declaration
     */
    protected function printVariable(string $name,string $type) :string
    {
        return <<<VARBODY
       
    /** @var \${$name} {$type} */
    private \${$name};
    
VARBODY;
    }

    /**
     * Returning string with declaration Setter
     *
     * @param string $functionName Name of function without first 'get'
     * @param string $var Name of variable
     * @param string $type Type of variable
     * @return string String with declaration
     */
    protected function printSetter(string $functionName,string $var,string $type) :string
    {
        return <<<FUNCBODY
        
    /**
    * Setter for \${$var}
    * @param \${$var} {$type}   
    */
    public function set{$functionName}(\${$var}) :void
    {
        \$this->{$var} = \${$var};
    }
    
FUNCBODY;
    }

    /**
     * Returning string with declaration Setter
     *
     * @param string $functionName Name of function without first 'get'
     * @param string $var Name of variable
     * @param string $type Type of variable
     * @return string String with declaration
     */
    protected function printGetter(string $functionName, string $var, string $type) :string
    {
        return <<<FUNCBODY
        
    /**
    * Getter for \${$var}
    * @return {$type}   
    */
    public function get{$functionName}(\${$var}) :{$type}
    {
        return \$this->{$var};
    }

FUNCBODY;
    }
}