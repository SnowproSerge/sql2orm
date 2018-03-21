<?php
/**
 * @author: Sergey Naryshkin
 * @date: 20.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder;

/**
 * Генерирует класс в заданном namespace
 * Class File
 * @package SnowSerge\Sql2Orm\Builder
 */
class File
{
/** @var string */
    private $name;
    /** @var string */
    private $buffer;
    /** @var string */
    private $namespace = '';

    /**
     * File constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->buffer = '';
    }

    /**
     * Print header of file
     * @return string
     */
    private function printHeader(): string
    {
         $head = <<<CLASSBODY
<?php

{$this->getNamespace()}
        
class {$this->name}
{    
   
CLASSBODY;
         return $head;
    }

    /**
     * @return string
     */
    private function printFooter(): string
    {
        return "}\n";
    }

    /**
     * @param $string
     */
    public function addToFile($string): void
    {
        $this->buffer .= $string;
     }
    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name.'.php';
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->printHeader()
                 .$this->buffer
                 .$this->printFooter();
    }

    /**
     * @return string
     */
    private function getNamespace(): string
    {
        if(empty($this->namespace)) {
            return '';
        }
        return 'namespace '.$this->namespace.";\n";
    }
}