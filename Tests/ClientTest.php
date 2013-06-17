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

namespace ETS\EchoSignBundle\Tests;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test send document
     */
    public function testSendDocument()
    {
        $documentCreationInfo = $this->getMockBuilder('ETS\EchoSignBundle\Api\DocumentCreationInfo')
                                     ->disableOriginalConstructor()
                                     ->getMock();

        $returnValue = (object) array(
            'documentKeys' => (object) array(
                'DocumentKey' => (object) array(
                    'documentKey' => 'mock_document_key',
                    'recipientEmail' => 'mock_email@test.com'
                )
            )
        );

        $returnValue = (object) $returnValue;
        $mockClient = $this->getMockClient($returnValue);

        $documentKey = $mockClient->sendDocument($documentCreationInfo);
        $this->assertEquals('mock_document_key', $documentKey);
    }

    /**
     * Test get document info
     */
    public function testGetDocumentInfo()
    {
        $returnValue = (object) array(
            'DocumentInfo' => (object) array(
                'status' => 'OUT_FOR_APPROVAL'
            )
        );

        $mockClient = $this->getMockClient($returnValue);
        $result = $mockClient->getDocumentInfo('mock_document_key');
        $this->assertEquals($result->DocumentInfo->status, 'OUT_FOR_APPROVAL');
    }

    /**
     * Test remove document
     */
    public function testRemoveDocument()
    {
        $returnValue = (object) array(
            'removeDocumentResult' => (object) array(
                'errorMessage' => null,
                'errorCode' => null,
                'success' => true
            )
        );

        $mockClient = $this->getMockClient($returnValue);
        $success = $mockClient->removeDocument('mock_document_key');
        $this->assertTrue($success);
    }

    /**
     * @expectedException \Exception
     */
    public function testRemoveDocumentWithError()
    {
        $returnValue = (object) array(
            'removeDocumentResult' => (object) array(
                'errorMessage' => 'Error',
                'errorCode' => 'DOCUMENT_DOES_NOT_EXIST',
                'success' => false
            )
        );

        $mockClient = $this->getMockClient($returnValue);
        $mockClient->removeDocument('mock_document_key');
    }

    /**
     * Test get info on document that does not exist
     */
    public function testGetNotExistDocumentInfo()
    {
        $mockClient = $this->getMock('ETS\EchoSignBundle\Api\Client', array('apiCall'), array('key', 'gateway', 'wsdl'));
        $mockClient->expects($this->any())
            ->method('apiCall')
            ->will($this->throwException(new \SoapFault('0', 'SoapFault')));

        $result = $mockClient->getDocumentInfo('mock_document_key');
        $this->assertNull($result);
    }

    public function testGetMyDocuments()
    {
        $returnValue = (object) array(
            'getMyDocumentsResult' => (object) array(
                'documentListForUser' => (object) array(
                    'DocumentListItem' => array(
                        array(
                            'documentKey' => 'toto'
                        ),
                        array(
                            'documentKey' => 'tata'
                        )
                    )
                ),
                'errorMessage' => 'Error',
                'errorCode' => 'DOCUMENT_DOES_NOT_EXIST',
                'success' => true
            )
        );

        $mockClient = $this->getMockClient($returnValue);
        $documentList = $mockClient->getMyDocuments();
        $this->assertEquals(2, count($documentList));
        $this->assertEquals('toto', $documentList[0]['documentKey']);
        $this->assertEquals('tata', $documentList[1]['documentKey']);
    }

    /**
     * @param $returnValue
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockClient($returnValue)
    {
        $mockClient = $this->getMock('ETS\EchoSignBundle\Api\Client', array('apiCall'), array('key', 'gateway', 'wsdl'));
        $mockClient->expects($this->any())
            ->method('apiCall')
            ->will($this->returnValue($returnValue));

        return $mockClient;
    }
}