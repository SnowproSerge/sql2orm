<?php
/**
 * @author: Sergey Naryshkin
 * @date: 21.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use SnowSerge\Sql2Orm\Builder\File;
use SnowSerge\Sql2Orm\Database\Database;
use SnowSerge\Sql2Orm\Database\Structure\Table;

class BuilderDto implements Builder
{
    /** @var Table */
    private $table;

    public function build(Database $database, string $tableName): File
    {
        // TODO: Implement build() method.
        return null;
    }

    private function makeVariable($name)
    {
        $field = $this->table->getField($name);

    }
}