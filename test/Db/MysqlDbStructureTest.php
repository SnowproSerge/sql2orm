<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Test\Db;

use SnowSerge\Sql2Orm\Db\MysqlDbStructure;
use PHPUnit\Framework\TestCase;

class MysqlDbStructureTest extends TestCase
{
    /** @var MysqlDbStructure */
    protected $obj;

    protected function setUp()
    {
        $this->obj = new MysqlDbStructure('mysql','localhost','root', 'root');
    }

    protected function tearDown()
    {
        $this->obj->closeConnection();
    }
    public function testGetListTables()
    {

        $arr = $this->obj->getListTables();
        $this->assertContains('columns_priv',$arr);
    }

    public function testGetListFields()
    {
        $this->assertEquals('','');
    }

    public function testGetRelations()
    {
        $this->assertEquals('','');
    }
}
