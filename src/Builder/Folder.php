<?php
/**
 * @author Sergey Naryshkin
 * Date: 18.03.2018 16:52
 */

namespace SnowSerge\Sql2Orm\Builder;

/**
 * Class Folders
 * @package SnowSerge\Sql2Orm\Builder
 */
class Folder implements \Iterator
{
    /** @var string */
    private $name;
    /** @var string */
    private $baseNamespace;
    /** @var File[] */
    private $files;
    /** @var int Position for Iterator*/
    private $position;

    /**
     * Folders constructor.
     * @param string $name
     * @param string $baseNamespace
     */
    public function __construct(string $name,string $baseNamespace)
    {
        $this->name = $name;
        $this->baseNamespace = $baseNamespace;
        $this->position = 0;
        $this->files = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param File $file
     */
    public function addFile(File $file): void
    {
        $file->setNamespace($this->baseNamespace.'\\'.$this->name);
        $this->files[] = $file;
    }

    /* ---------------------- Implements Iterator*/

    /**
     * Return the current element
     * @return File Can return any type.
     */
    public function current(): File
    {
        return $this->files[$this->position];
    }

    /**
     * Move forward to next element
     * @return void Any returned value is ignored.
     */
    public function next() :void
    {
        ++$this->position;
    }

    /**
     * Return the key of the current element
     * @return int
     */
    public function key() :int
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @return bool The return value will be casted to boolean and then evaluated.
     */
    public function valid() :bool
    {
        return isset($this->files[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @return void Any returned value is ignored.
     */
    public function rewind() :void
    {
        $this->position = 0;
    }
}