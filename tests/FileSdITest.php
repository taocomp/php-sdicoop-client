<?php
use PHPUnit\Framework\TestCase;
use Taocomp\Einvoicing\SdicoopClient\FileSdI;

class FileSdITest extends TestCase
{
    public function testCanLoadContents()
    {
        $obj = new FileSdI();
        $contents = file_get_contents(__DIR__ . '/files/notice.xml');
        $obj->load('mynotice.xml', $contents);

        $xml = new SimpleXMLElement($obj->File);
        $id = $xml->IdentificativoSdI;

        // TODO: test XML contents too
        $this->assertEquals('mynotice.xml 1234567', $obj->NomeFile . " $id");
    }
}
