<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Structure;


class Field
{
// TODO make driver type conversation
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
    /** @var bool */
    private $nullable = true;
    /** @var bool */
    private $unique = false;


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

    /**
     *
     */
    public function snakeToCamel() :void
    {
        $tmp = preg_replace_callback(
            '/^([^-_]+)/',
            function ($world) {
                return strtolower($world[1]);
                },
            $this->name
        );
        $this->ormName = preg_replace_callback(
            '/[-_]([^-_]+)/',
            function ($world) {
                return ucwords(strtolower($world[1]));
                },
            $tmp
        );
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