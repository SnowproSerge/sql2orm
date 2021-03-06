<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Database\Structure;


use SnowSerge\Sql2Orm\Helper\ConvertingNamesHelper;

final class Field
{
// TODO make driver type conversation
    public const BYTE = 'byte';
    public const STRING = 'string';
    public const INTEGER = 'int';
    public const DATE = 'date';
    public const LONG = 'long';
    public const FLOAT = 'float';
    public const DOUBLE = 'double';
    public const TIME = 'time';
    public const DATETIME = 'datetime';
    public const TIMESTAMP = 'timestamp';
    public const ENUM = 'ENUM';



    /** @var string */
    private $name;
    /** @var string */
    private $ormName;
    /** @var string */
    private $type;
    /** @var bool */
    private $nullable = true;
    /** @var bool */
    private $unique = false;


    /**
     * Field constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->type = self::STRING;
        $this->snakeToCamel();
    }

    /**
     *
     */
    public function snakeToCamel() :void
    {
        $this->ormName = ConvertingNamesHelper::snakeToCamel($this->name,false);
    }

    /**
     * @return string
     */
    public function getOrmName(): string
    {
        return $this->ormName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Field
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Field
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @param bool $nullable
     * @return Field
     */
    public function setNullable(bool $nullable): self
    {
        $this->nullable = $nullable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUnique(): bool
    {
        return $this->unique;
    }

    /**
     * @param bool $unique
     * @return Field
     */
    public function setUnique(bool $unique): self
    {
        $this->unique = $unique;
        return $this;
    }

    public static function getField($name): self
    {
        return new self($name);
    }

}