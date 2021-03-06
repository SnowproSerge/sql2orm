<?php
/**
 * @author: Sergey Naryshkin
 * @date 28.01.2018
 */

namespace SnowSerge\Sql2Orm\Database\Test\Db;

use SnowSerge\Sql2Orm\Database\Db\MysqlDbStructure;
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
    public function testGetListTables(): void
    {

        $arr = $this->obj->getListTables();
        $this->assertContains('types',$arr);
    }

    /**
     * @throws \Exception
     */
    public function testGetListFields(): void
    {
        $fields = $this->obj->getListFields('one_to_one1');
//        print_r($fields);
        $this->assertContains(['COLUMN_NAME'=>'id','COLUMN_TYPE'=>'int(10)','COLUMN_KEY'=>'PRI','IS_NULLABLE'=>'NO'],$fields);
    }

    /**
     * @throws \Exception
     */
    public function testGetRelations(): void
    {
        $re = $this->obj->getRelations('one_to_one1');
        $this->assertEquals(\count($re),1);
    }

    public function convertTypeDataProvider(): array
    {
        return[
            'bit' => [ 'bit','byte'],
            'bit(01)' => [ 'bit(01)','string'],
            'BIT(10)' => [ 'BIT(10) ','byte'],
            'smallint(10)' => [ ' smallint(10) ','byte'],
            'smallint(100)' => [ ' smallint(100) ','string'],
            'MEDIUMINT(10)' => [ 'MEDIUMINT(10) ','int'],
            'MEDIUMINT' => [ 'MEDIUMINT','int'],
            'INT(10)' => [ 'INT(10) ','int'],
            'INT' => [ 'INT','int'],
            'INTEGER(10)' => [ 'INTEGER(10) ','int'],
            'INTEGER' => [ 'INTEGER','int'],
            'BIGINT(10)' => [ 'BIGINT(10) ','long'],
            'BIGINT' => [ 'BIGINT','long'],
            'SERIAL(10)' => [ 'SERIAL(10) ','string'],
            'SERIAL' => [ 'SERIAL','long'],
            'DECIMAL(10)' => [ 'DECIMAL(10) ','float'],
            'DECIMAL' => [ 'DECIMAL','float'],
            'DEC' => [ 'DEC','float'],
            'DEC(10)' => [ 'DECIMAL(10) ','float'],
            'DEC(10,1)' => [ 'DECIMAL(10,1) ','float'],
            'DECIMAL(10,1)' => [ 'DECIMAL(10,1) ','float'],
            'DECIMAL(10,11)' => [ 'DECIMAL(10,11) ','float'],
            'FLOAT(10)' => [ 'FLOAT(10) ','float'],
            'FLOAT' => [ 'FLOAT','float'],
            'FLOAT(10,1)' => [ 'FLOAT(10,1) ','float'],
            'FLOAT(10,11)' => [ 'FLOAT(10,11) ','float'],
            'DOUBLE(10)' => [ 'DOUBLE(10) ','double'],
            'DOUBLE' => [ 'DOUBLE','double'],
            'DOUBLE(10,1)' => [ 'DOUBLE(10,1) ','double'],
            'DOUBLE(10,11)' => [ 'DOUBLE(10,11) ','double'],
            'DATETIME' => [ 'dateTime','datetime'],
            'DATETIME(6)' => [ 'dateTime(6) ','datetime'],
            'DATETIME(7)' => [ 'DATETIME(7) ','string'],
            'DATE' => [ 'date','date'],
            'DATE(6)' => [ 'date(6) ','string'],
            'TIME' => [ 'TIME','time'],
            'TIME(6)' => [ 'time(6) ','time'],
            'TIMESTAMP' => [ 'TIMESTAMP','timestamp'],
            'TIMESTAMP(6)' => [ 'TIMESTAMP(6) ','timestamp'],
            "EnuM('a','b','c')" => [ "EnuM('a','b','c')","ENUM('a','b','c')"],
        ];
    }

    /**
     * @dataProvider convertTypeDataProvider
     * @param $in
     * @param $out
     * @throws \Exception
     */
    public function testConvertType($in,$out): void
    {
        self::assertEquals($out,$this->obj->convertType($in));
    }
}
