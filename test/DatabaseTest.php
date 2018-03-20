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

    /**
     * @throws \Exception
     */
    public function testGetTables(): void
    {
        $tables = $this->obj->getTables();
//        print_r($tables);
        $this->assertEquals('types',$tables['types']->getName());
    }

    /**
     * @throws \Exception
     */
    public function testGetRelations(): void
    {
        $relations = $this->obj->getRelations();
//        print_r($relations);
        $this->assertEquals('one_to_many_one',$relations['one_to_many_many']['one_to_many_one']->getTableOne()->getName());

    }
}
