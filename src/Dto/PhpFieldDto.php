<?php
/**
 * @author: Sergey Naryshkin
 * @date: 15.02.2018
 */

namespace SnowSerge\Sql2Orm\Dto;


use SnowSerge\Sql2Orm\Structure\Field;

class PhpFieldDto extends FieldDto
{

    /** @var array */
    private static $convertType = [
        'int' => 'int',
        'date' => 'date',
        'varchar' => 'string'
    ];



    public function printDeclaration(): string
    {

        return "\t/** @var ".self::$convertType[$this->field->getType()]."*/\n\tprivate \$".$this->field->getOrmName()."\n\n";
    }

    public function printGetter(): string
    {
        // TODO: Implement printGetter() method.
    }

    public function printSetter(): string
    {
        // TODO: Implement printSetter() method.
    }
}