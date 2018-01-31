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

    public function testGetListTables()
    {
        $my = new MysqlDbStructure('sovet','mysql_c','sovet', 'sovet');
        $arr = $my->getListTables();
        var_dump($arr);
        $this->assertArraySubset(['instr','meeting','member'],$arr);
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
