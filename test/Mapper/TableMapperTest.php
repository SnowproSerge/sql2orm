<?php
/**
 * Created by PhpStorm.
 * User: uzhass
 * Date: 04.02.18
 * Time: 20:01
 */

namespace SnowSerge\Sql2Orm\Test\Mapper;


use PHPUnit\Framework\TestCase;
use SnowSerge\Sql2Orm\Db\MysqlDbStructure;
use SnowSerge\Sql2Orm\Mapper\TableMapper;
use SnowSerge\Sql2Orm\Structure\Field;

class TableMapperTest extends TestCase
{


    public function providerGetFieldList(): array
    {
        return [
            'one' => [
                [
                    'COLUMN_NAME' => 'Host',
                    'COLUMN_TYPE' => 'char(60)',
                    'COLUMN_KEY' => 'PRI',
                    'IS_NULLABLE' => 'Yes'
                ],
                ['host', 'char(60)', true, false]
            ],
            'two' => [
                [
                    'COLUMN_NAME' => 'Host_outweaR',
                    'COLUMN_TYPE' => 'char(60)',
                    'COLUMN_KEY' => 'UNI',
                    'IS_NULLABLE' => 'no'
                ],
                ['hostOutwear', 'char(60)', false, true]
            ]
        ];
    }

    /**
     * @dataProvider providerGetFieldList
     * @throws \Exception
     */
    public function testGetFieldList($in, $out): void
    {
        $mapper = new TableMapper();
        /** @var Field $fil */
        $fil = $this->callMethod($mapper, 'getFieldList', [[$in]])[$in['COLUMN_NAME']];
//        $fil = $mapper->getFieldList([$in])[$in['COLUMN_NAME']];
        $this->assertArraySubset($out, [$fil->getOrmName(), $fil->getType(), $fil->isNullable(), $fil->isUnique()]);
    }


    public function callMethod($obj, $name, array $args)
    {
        try {
            $class = new \ReflectionClass($obj);
        } catch (\ReflectionException $e) {
        }
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }
}
