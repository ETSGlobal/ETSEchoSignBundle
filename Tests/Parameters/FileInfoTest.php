<?php

namespace ETS\EchoSignBundle\Tests\Parameters;


use ETS\EchoSignBundle\Api\FileInfo;

class FileInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $fileInfo = new FileInfo('fixture.file', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixture.file');
        $result = $fileInfo->build();
        $this->assertEquals('This is a fixture file used for unit testing', $result['file']);
        $this->assertEquals('fixture.file', $result['fileName']);
    }
}