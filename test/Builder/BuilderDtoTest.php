<?php
/**
 * @author: Sergey Naryshkin
 * @date: 22.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use PHPUnit\Framework\TestCase;
use SnowSerge\Sql2Orm\Database\Database;
use SnowSerge\Sql2Orm\Database\Db\MysqlDbStructure;
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

    /**
     * @throws \Exception
     */
    public function testBuild(): void
    {
        $structure = new MysqlDbStructure('sovet','mysql_c','root', 'root');
        $database = new Database($structure);
        $build = new BuilderDto($database,'SnowSerge\\Testing','Dto');
        $folder = $build->build();
        $str='';
        foreach ($folder as $file) {
            if($file->getName() === 'Types.php') {
                $str = $file->getFile();
            }
        }
        $this->assertContains('/** @var $fEnum string */',$str);
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

    
    public function providerConvertType(): array
    {
        return [
            Field::BYTE      => [Field::BYTE,'int'],
            Field::STRING    => [Field::STRING,'string'],
            Field::DATE      => [Field::DATE,'date'],
            Field::INTEGER   => [Field::INTEGER,'int'],
            Field::LONG      => [Field::LONG,'int'],
            Field::FLOAT     => [Field::FLOAT,'float'],
            Field::DOUBLE    => [Field::DOUBLE,'double'],
            Field::TIMESTAMP => [Field::TIMESTAMP,'int'],
            Field::DATETIME  => [Field::DATETIME,'date'],
            Field::TIME      => [Field::TIME,'date'],
            Field::ENUM      => [Field::ENUM.'(\'1\',2,\'test\')','string']
        ];    
    }

    /**
     * @dataProvider providerConvertType
     * @param $in
     * @param $out
     * @throws \Exception
     */
    public function testConvertType(string $in,string $out) :void
    {
        $vari = $this->callMethod($this->obj,'convertType',[$in]);
        $this->assertEquals($out,$vari);
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
