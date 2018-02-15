<?php
/**
 * @author: Sergey Naryshkin
 * @date: 15.02.2018
 */

namespace SnowSerge\Sql2Orm\Dto;

use SnowSerge\Sql2Orm\Structure\Field;


abstract class FieldDto
{
    /** @var Field */
    protected $field;

    /**
     * FieldDto constructor.
     * @param Field $field
     */
    public function __construct(Field $field)
    {
        $this->field = $field;
    }

    abstract public function printDeclaration(): string;
    abstract public function printGetter(): string;
    abstract public function printSetter(): string;
}