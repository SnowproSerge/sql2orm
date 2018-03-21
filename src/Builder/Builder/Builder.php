<?php
/**
 * @author: Sergey Naryshkin
 * @date: 21.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use SnowSerge\Sql2Orm\Builder\File;
use SnowSerge\Sql2Orm\Database\Database;

interface Builder
{
    public function build(Database $database, string $tableName): File;
}