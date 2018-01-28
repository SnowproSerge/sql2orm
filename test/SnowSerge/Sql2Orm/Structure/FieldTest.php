<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Structure;


use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{

    public function providerSnakeToCamel(): array
    {
        return [
          'simple' => ['camel','camel'],
          'snake-' => ['camel-case-will-work','camelCaseWillWork'],
          'snake_' => ['camel_case_will_work','camelCaseWillWork'],
          'snake-_' => ['camel_case-will_work','camelCaseWillWork']
        ];
    }

    /**
     * @dataProvider providerSnakeToCamel
     */
    public function testSnakeToCamel($input,$output)
    {
        $field = new Field($input);
        $this->assertEquals($field->getOrmName(),$output);
    }
}