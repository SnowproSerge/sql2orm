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
        $this->obj = new MysqlDbStructure('sovet','mysql_c','root', 'root');
    }

    protected function tearDown()
    {
        $this->obj->closeConnection();
    }

    /**
     * @throws \Exception
     */
    public function testGetListTables()
    {

        $arr = $this->obj->getListTables();
        $this->assertContains('councilman',$arr);
    }

    /**
     * @throws \Exception
     */
    public function testGetListFields()
    {
        $fields = $this->obj->getListFields('instructor');
        $this->assertContains(['COLUMN_NAME'=>'first_name','COLUMN_TYPE'=>'varchar(40)','COLUMN_KEY'=>'','IS_NULLABLE'=>'NO'],$fields);
    }

    /**
     * @throws \Exception
     */
    public function testGetRelations()
    {
        $re = $this->obj->getRelations('councilman');
//        var_dump($re);
        $this->assertEquals(\count($re),2);
    }
}
