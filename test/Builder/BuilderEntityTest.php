<?php
/**
 * @author: Sergey Naryshkin
 * @date: 29.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use PHPUnit\Framework\TestCase;
use SnowSerge\Sql2Orm\Database\Structure\Table;

class BuilderEntityTest extends TestCase
{

    /** @var BuilderEntity */
    private $obj;


    public function setUp()
    {
        $database = $this->getMockBuilder(Database::class)
            ->disableOriginalConstructor()
            ->setMethods(['getTables'])
            ->getMock();
        $database->expects($this->any())
            ->method('getTables')
            ->will($this->returnValue([new Table('test_data')]));
        $this->obj = new BuilderEntity($database,'SnowSerge\\Testing\\','Entity');
    }

    /**
     * @return array
     */
    public function dataProviderFillFields() :array
    {
        $table = new Table('test_table');
        return [];
    }

    /**
     * @dataProvider dataProviderFillFields
     * @param array $inFields
     * @param array $inRelation
     * @param $out
     */
    public function testFillFieldsPure(array $inFields,array $inRelation, $out) :void
    {
        $vari = $this->callMethod($this->obj,'fillFields',[$inFields,$inRelation]);
        $pure = $this->getProperty($this->obj,'pureFields');
//        $this->assertEquals($out->getName)
    }

    /**
     * @param $obj
     * @param $name
     * @param array $args
     * @return mixed
     */
    public function callMethod($obj, $name, array $args)
    {
        try {
            $class = new \ReflectionClass($obj);
        } catch (\ReflectionException $e) {
            echo $e->getMessage();
            return null;
        }
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }

    /**
     * Get private and protected Property
     *
     * @param $obj Object
     * @param $name string
     * @return mixed
     */
    public function getProperty($obj, $name) :mixed
    {
        try {
            $class = new \ReflectionClass($obj);
        } catch (\ReflectionException $e) {
            echo $e->getMessage();
            return null;
        }
        $properties = $class->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);
        return $properties[$name]?? null;
    }
}
