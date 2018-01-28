<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Structure;


class Table
{
    /** @var string */
    private $name;
    /** @var Field[] */
    private $fields;
    /** @var Field[] */
    private $primary;
    /** @var Relation[] */
    private $manys;

    /**
     * Table constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return Field[]
     */
    public function getPrimary(): array
    {
        return $this->primary;
    }

    /**
     * @return Relation[]
     */
    public function getManys(): array
    {
        return $this->manys;
    }

}