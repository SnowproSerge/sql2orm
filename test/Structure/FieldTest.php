<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Database\Test\Structure;


use PHPUnit\Framework\TestCase;
use SnowSerge\Sql2Orm\Database\Structure\Field;

class FieldTest extends TestCase
{

    public function providerSnakeToCamel(): array
    {
        return [
          'simple' => ['camel','camel'],
          'snake-' => ['camel-case-will-work','camelCaseWillWork'],
          'snake_' => ['camel_case_will_work','camelCaseWillWork'],
          'snake-_' => ['camel_case-will_work','camelCaseWillWork'],
          'Snake-' => ['Camel_case-will_work','camelCaseWillWork'],
          'SNAKE_' => ['CAMEL_case-will_work','camelCaseWillWork'],
          'SNAKE_S' => ['CAMEL_CASE-WILL_WORK','camelCaseWillWork']
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
