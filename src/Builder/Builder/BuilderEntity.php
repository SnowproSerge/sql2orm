<?php
/**
 * @author: Sergey Naryshkin
 * @date: 28.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use SnowSerge\Sql2Orm\Builder\File;
use SnowSerge\Sql2Orm\Builder\Folder;
use SnowSerge\Sql2Orm\Database\Structure\Field;
use SnowSerge\Sql2Orm\Database\Structure\Relation;
use SnowSerge\Sql2Orm\Database\Structure\Table;

class BuilderEntity extends Builder
{

    /** @var Field[] */
    private $fieldsOne = [];

    /** @var Field[] */
    private $fieldsMany = [];

    /** @var Field[]  */
    private $pureFields = [];

    public function build(): Folder
    {
        $folder = new Folder('Entity',$this->namespace);
        foreach ($this->database->getTables() as $table) {
            $file = $this->getFile($table);
            if($file !== null) {
                $folder->addFile($file);
            }
        }

        return $folder;
    }

    private function getFile(Table $table) :File
    {

    }

    /**
     * @param Field[] $fields
     * @param Relation[] $relations
     */
    private function setFields(array $fields, array $relations) :void
    {

    }

    private function makeVariable(Field $field) :string
    {

    }


}