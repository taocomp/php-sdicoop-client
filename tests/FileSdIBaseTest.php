<?php
use PHPUnit\Framework\TestCase;
use Taocomp\Einvoicing\SdicoopClient\FileSdIBase;

class FileSdIBaseTest extends TestCase
{
    public function testCanCreateEmpty()
    {
        $obj = new FileSdIBase();

        $this->assertInstanceOf(FileSdIBase::class, $obj);
    }

    public function testCannotCreateWithInvalidArg()
    {
        $this->expectException(\TypeError::class);

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

    public function testCanLoadContents()
    {
        $obj = new FileSdIBase();
        $contents = file_get_contents(__DIR__ . '/files/invoice.xml');
        $obj->load('myfile.xml', $contents);

        $xml = new SimpleXMLElement($obj->File);
        $CD = $xml->FatturaElettronicaHeader->DatiTrasmissione->CodiceDestinatario;

        // TODO: test XML contents too
        $this->assertEquals('myfile.xml ABC1234', $obj->NomeFile . " $CD");
    }
}
