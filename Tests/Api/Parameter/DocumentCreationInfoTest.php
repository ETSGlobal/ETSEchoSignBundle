<?php
/*
 * Copyright 2012 ETSGlobal <ecs@etsglobal.org>
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

namespace ETS\EchoSignBundle\Tests\Api\Parameter;

use ETS\EchoSignBundle\Api\Parameter\DocumentCreationInfo;
use ETS\EchoSignBundle\Api\Parameter\FileInfo;
use ETS\EchoSignBundle\Api\Parameter\FileInfoCollection;
use ETS\EchoSignBundle\Api\Parameter\RecipientInfoCollection;

/**
 * Class DocumentCreationInfoTest
 *
 * @package ETS\EchoSignBundle\Tests\Api\Parameter
 */
class DocumentCreationInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test build method
     */
    public function testBuild()
    {
        $recipients = new RecipientInfoCollection(array(
            'passkey1510@gmail.com'
        ));

        $fileCollections = new FileInfoCollection();
        $fileCollections->addFileInfo(new FileInfo('fixture.txt', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixture.txt'));
        $documentCreationInfo = new DocumentCreationInfo($recipients, 'Test document', $fileCollections, DocumentCreationInfo::SIGNATURE_TYPE_ESIGN, DocumentCreationInfo::SIGNATURE_FLOW_SENDER_SIGNATURE_NOT_REQUIRED);
        $documentCreationInfoParams = $documentCreationInfo->build();
        $this->assertEquals('This is a fixture file used for unit testing', $documentCreationInfoParams['fileInfos'][0]['file']);
        $this->assertEquals('fixture.txt', $documentCreationInfoParams['fileInfos'][0]['fileName']);
        $this->assertEquals('Test document', $documentCreationInfoParams['name']);
        $this->assertEquals('SENDER_SIGNATURE_NOT_REQUIRED', $documentCreationInfoParams['signatureFlow']);
        $this->assertEquals('ESIGN', $documentCreationInfoParams['signatureType']);
        $this->assertEquals('passkey1510@gmail.com', $documentCreationInfoParams['recipients'][0]['email']);
    }
}
