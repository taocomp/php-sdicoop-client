<?php
use PHPUnit\Framework\TestCase;
use Taocomp\Einvoicing\Sdicoop\FileSdIBase;

class FileSdIBaseTest extends TestCase
{
    public function testCanCreateEmpty()
    {
        $obj = new FileSdIBase();

        $this->assertInstanceOf(FileSdIBase::class, $obj);
    }

    public function testCannotCreateWithInvalidArg()
    {
        $this->expectException(\Exception::class);

        $obj = new FileSdIBase('BAD');
    }

    public function testCannotCreateWithoutANomefile()
    {
        $this->expectException(\Exception::class);

        $params = new \StdClass();
        $params->File = '';
        $obj = new FileSdIBase($params);
    }

    public function testCannotCreateWithoutAFile()
    {
        $this->expectException(\Exception::class);

        $params = new \StdClass();
        $params->NomeFile = '';
        $obj = new FileSdIBase($params);
    }

    public function testToString()
    {
        $params = new \StdClass();
        $params->NomeFile = 'test.xml';
        $params->File = '';
        $obj = new FileSdIBase($params);

        $this->assertEquals('NomeFile:test.xml', (string)$obj);
    }

    public function testCanLoadAFile()
    {
        $obj = new FileSdIBase();
        $obj->load(__DIR__ . '/files/invoice.xml');

        $this->assertFalse(empty($obj->File));
    }
}
