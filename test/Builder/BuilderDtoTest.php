<?php
/**
 * @author: Sergey Naryshkin
 * @date: 22.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use PHPUnit\Framework\TestCase;
use SnowSerge\Sql2Orm\Database\Database;
use SnowSerge\Sql2Orm\Database\Structure\Field;
use SnowSerge\Sql2Orm\Database\Structure\Table;

class BuilderDtoTest extends TestCase
{

    /** @var BuilderDto */
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
        $this->obj = new BuilderDto($database,'SnowSerge\\Testing\\','Dto');
    }
    public function testBuild(): void
    {
        $var = 'ddd';
        $this->assertEquals('ddd',$var);
    }

    /**
     * @throws \Exception
     */
    public function testMakeVariable(): void
    {
        $field = Field::getField('vasya_pupkin')
            ->setType('int')->setNullable(false);
        $vari = $this->callMethod($this->obj,'makeVariable',[$field]);
        $this->assertContains('var',$vari);
    }

    /**
     * @throws \Exception
     */
    public function testMakeGetter(): void
    {
        $field = Field::getField('vasya_pupkin')
            ->setType('int')->setNullable(false);
        $vari = $this->callMethod($this->obj,'makeGetter',[$field]);
        $this->assertContains(' getVasyaPupkin(',$vari);
    }

    /**
     * @throws \Exception
     */
    public function testMakeSetter(): void
    {
        $field = Field::getField('vasya_pupkin')
            ->setType('int')->setNullable(false);
        $vari = $this->callMethod($this->obj,'makeSetter',[$field]);
        $this->assertContains(' setVasyaPupkin(',$vari);
    }

    public function callMethod($obj, $name, array $args)
    {
        try {
            $class = new \ReflectionClass($obj);
        } catch (\ReflectionException $e) {
            echo $e->getMessage();
        }
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }

}
