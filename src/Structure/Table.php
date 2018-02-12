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
    /** @var Field */
    private $primary;

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
     * @param $name
     * @return Field|null
     */
    public function getField($name): ?Field
    {
        return $this->fields[$name]?? null;
    }

    /**
     * @return Field
     */
    public function getPrimary(): Field
    {
        return $this->primary;
    }

    /**
     * @param Field[] $fields
     * @return Table
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param Field $primary
     */
    public function setPrimary($primary): void
    {
        $this->primary = $primary;
    }

    public static function getTable($name): Table
    {
        return new self($name);
    }
}