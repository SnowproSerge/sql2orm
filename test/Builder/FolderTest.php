<?php
/**
 * @author: Sergey Naryshkin
 * @date: 21.03.2018
 */

namespace SnowSerge\Sql2Orm\Builder;


use PHPUnit\Framework\TestCase;

class FolderTest extends TestCase
{
    /** @var Folder */
    private $obj;

    public function setUp()
    {
        $this->obj = new Folder('classes','namespace');
    }

    /**
     * @throws \Exception
     */
    public function testGetName(): void
    {
        $this->assertEquals($this->obj->getName(),'classes');
    }

    /**
     * @throws \Exception
     */
    public function testAddFile(): void
    {
        $this->obj->addFile(new File('ClassOne'));
        foreach($this->obj as $file) {
            $this->assertEquals($file->getName(),'ClassOne.php');
        }
    }
    /**
     * @throws \Exception
     */
    public function testSetNamespace(): void
    {
        $this->obj->addFile(new File('ClassOne'));
        foreach($this->obj as $file) {
            $code =  $file->getFile();
            echo $code;
            $this->assertContains('namespace\\classes;',$code);
        }
    }

}
