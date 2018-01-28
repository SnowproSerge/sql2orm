<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Structure;


class Field
{
    /** @var string */
    private $name;
    /** @var string */
    private $ormName;

    /**
     * Field constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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