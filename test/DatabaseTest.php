<?php
/**
 * @author: Sergey Naryshkin
 * @date 14.02.2018
 */

namespace SnowSerge\Sql2Orm\Database\Test;

use PHPUnit\Framework\TestCase;
use SnowSerge\Sql2Orm\Database\Database;
use SnowSerge\Sql2Orm\Database\Db\MysqlDbStructure;

class DatabaseTest extends TestCase
{
    /** @var Database */
    private $obj;

    protected function setUp()
    {
        $this->obj = new Database(new MysqlDbStructure('sovet','mysql_c','root', 'root'));
    }


    public function testGetTables(): void
    {
        $tables = $this->obj->getTables();
//        print_r($tables);
        $this->assertEquals('instructor',$tables['instructor']->getName());
    }

    public function testGetRelations(): void
    {
        $relations = $this->obj->getRelations();
//        print_r($relations);
        $this->assertEquals('instructor',$relations['councilman']['instructor']->getTableOne()->getName());

    }
}
