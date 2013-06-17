<?php
/*
 * Copyright 2012 ETSGlobal <e4-devteam@etsglobal.org>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace ETS\EchoSignBundle\Tests\Parameters;

use ETS\EchoSignBundle\Api\FileInfo;

class FileInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $fileInfo = new FileInfo('fixture.txt', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixture.txt');
        $result = $fileInfo->build();
        $this->assertEquals('This is a fixture file used for unit testing', $result['file']);
        $this->assertEquals('fixture.txt', $result['fileName']);
    }
}