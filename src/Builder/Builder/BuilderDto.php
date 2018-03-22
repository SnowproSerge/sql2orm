<?php
/**
 * @author: Sergey Naryshkin
 * @date: 21.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder\Builder;


use SnowSerge\Sql2Orm\Builder\File;
use SnowSerge\Sql2Orm\Builder\Folder;
use SnowSerge\Sql2Orm\Database\Structure\Field;
use SnowSerge\Sql2Orm\Database\Structure\Table;
use SnowSerge\Sql2Orm\Helper\ConvertingNamesHelper;

class BuilderDto extends Builder
{
    private $sss;
    /**
     * Build Folder object with File objects
     *
     * @return Folder
     */
    public function build(): Folder
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
     * Make variable definition string from Field object
     *
     * @param $field Field
     * @return string
     */
    private function makeVariable(Field $field): string
    {
        return '    /** @var '.$field->getOrmName().' '.self::$convertType[$field->getType()]." */\n".'    private $'.$field->getOrmName().';'."\n";
    }

    /**
     * Make setter to variable from Field object
     *
     * @param $field Field
     * @return string
     */
    private function makeSetter(Field $field): string
    {
        $type = self::$convertType[$field->getType()];
        $functionName = ConvertingNamesHelper::snakeToCamel($field->getName(),true);
        $var = '$'.$field->getOrmName();
        return <<<FUNCBODY
    /**
    * Setter for {$var}
    * @param {$type} {$var}  
    */
    public function set{$functionName}({$var}) :void
    {
        \$this->{$var} = {$var};
    }    
FUNCBODY;
    }

    /**
     * @return mixed
     */
    public function getSss()
    {
        return $this->sss;
    }

    /**
     * @param mixed $sss
     */
    public function setSss($sss): void
    {
        $this->sss = $sss;
    }

    /**
     * Make setter to variable from Field object
     *
     * @param $field Field
     * @return string
     */
    private function makeGetter(Field $field): string
    {
        $type = self::$convertType[$field->getType()];
        $functionName = ConvertingNamesHelper::snakeToCamel($field->getName(),true);
        $var = '$'.$field->getOrmName();
        return <<<FUNCBODY
    /**
    * Getter for {$var}
    * @return {$type}   
    */
    public function get{$functionName}({$var}) :{$type}
    {
        return \$this->{$var};
    }    
FUNCBODY;
    }

    /**
     * Create class DTO source File object from Table object
     *
     * @param Table $table
     * @return File
     */
    private function getFile(Table $table): File
    {
        $variables = '';
        $functions = '';
        $file = new File(ConvertingNamesHelper::snakeToCamel($table->getName(),true));

        $fields = $table->getFields();
        foreach ($fields as $field) {
            $variables .= $this->makeVariable($field);
            $functions .= $this->makeGetter($field);
            $functions .= $this->makeSetter($field);
        }
        $file->addToFile($variables);
        $file->addToFile($functions);
        return $file;
    }
}