<?php
/**
 * @author: Sergey Naryshkin
 * @date: 21.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use SnowSerge\Sql2Orm\Builder\File;
use SnowSerge\Sql2Orm\Builder\Folder;
use SnowSerge\Sql2Orm\Database\Database;
use SnowSerge\Sql2Orm\Database\Structure\Field;
use SnowSerge\Sql2Orm\Database\Structure\Table;

class BuilderDto extends Builder
{

    public function build(string $tableName): Folder
    {
        $folder = new Folder('Dto',$this->namespace.'\\Dto');
        foreach ($this->database->getTables() as $table) {
            $file = $this->getFile($table);
            if($file !== null) {
                $folder->addFile($file);
            }
        }

        return $folder;
    }

    /**
     * @param $field Field
     * @return string
     */
    private function makeVariable(Field $field): string
    {
        return '    /** @var '.$field->getOrmName().''.$field->getType()."\n".'    private $'.$field->getOrmName().';'."\n";
    }

    private function getFile(Table $table): File
    {
        $variable = '';
        return null;
    }

}