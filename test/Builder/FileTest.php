<?php
/**
 * @author: Sergey Naryshkin
 * @date: 20.03.2018
 */

namespace SSnowSerge\Sql2Orm\Database\Test\Builder;


use PHPUnit\Framework\TestCase;
use SnowSerge\Sql2Orm\Builder\File;

class FileTest extends TestCase
{

    /** @var File */
    private $obj;
    protected function setUp()
    {
        $this->obj = new File('TestFile');
        $this->obj->setNamespace('test\\namespace');
    }

    /**
     * @throws \Exception
     */
    public function testAddToFile(): void
    {
        $this->obj->addToFile('$name = \'vasya\';'."\n");
        $file = $this->obj->getFile();
        $this->assertContains('vasya',$file);
    }

    /**
     * @throws \Exception
     */
    public function testSetNamespace(): void
    {

        $file = $this->obj->getFile();
        $this->assertContains('test\\namespace',$file);
    }

    /**
     * @throws \Exception
     */
    public function testGetName()
    {
        $this->assertEquals('TestFile.php',$this->obj->getName());
    }

    /**
     * @throws \Exception
     */
    public function testGetFile(): void
    {
        $this->obj->addToFile('$name = \'vasya\';'."\n");
        $file = $this->obj->getFile();
        $this->assertContains('class',$file);
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
