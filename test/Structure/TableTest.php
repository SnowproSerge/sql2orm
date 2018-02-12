<?php
/**
 * @author: Sergey Naryshkin
 * @date 12.02.2018
 */

namespace SnowSerge\Test\Sql2Orm\Structure;

use SnowSerge\Sql2Orm\Structure\Field;
use SnowSerge\Sql2Orm\Structure\Table;
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{

    public function testGetField(): void
    {
        $fields['id'] = new Field('id',Field::INTEGER);
        $fields['idx'] = new Field('idx',Field::INTEGER);
        $table = Table::getTable('test')
            ->setFields($fields);
        $idx =  $table->getField('idx');
        $this->assertEquals($idx->getName(),'idx');
    }
    public function testGetFieldNull(): void
    {
        $fields['id'] = new Field('id',Field::INTEGER);
        $fields['idx'] = new Field('idx',Field::INTEGER);
        $table = Table::getTable('test')
            ->setFields($fields);
        $idx =  $table->getField('id1');
        $this->assertNull($idx);
    }
}
