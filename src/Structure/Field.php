<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Structure;


class Field
{
    const STRING = 'string';
    const INTEGER = 'int';
    const DATE = 'date';
    const LONG = 'long';
    const FLOAT = 'float';


    /** @var string */
    private $name;
    /** @var string */
    private $ormName;
    /** @var string */
    private $type;

    /**
     * Field constructor.
     * @param string $name
     * @param string $type
     */
    public function __construct(string $name,string $type = self::STRING)
    {
        $this->name = $name;
        $this->type = $type;
        $this->snakeToCamel();
    }


    public function snakeToCamel() {
        $this->ormName = preg_replace_callback(
            '/[-_]([^-_]+)/',
            function ($world) { return ucwords($world[1]);},
            $this->name
        );
    }

    /**
     * @return string
     */
    public function getOrmName(): string
    {
        return $this->ormName;
    }


}