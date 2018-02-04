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

    /**
     * @throws \Exception
     */
    public function testGetListTables()
    {

        $arr = $this->obj->getListTables();
        $this->assertContains('columns_priv',$arr);
    }

    /**
     * @throws \Exception
     */
    public function testGetListFields()
    {
        $fields = $this->obj->getListFields('db');
        $this->assertContains(['COLUMN_NAME'=>'Host','COLUMN_TYPE'=>'char(60)','COLUMN_KEY'=>'PRI'],$fields);
    }

    /**
     * @throws \Exception
     */
    public function testGetRelations()
    {
        $fields = $this->obj->getRelations('db');
        $this->assertEmpty($fields);
    }
}
