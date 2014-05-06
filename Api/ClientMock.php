<?php

namespace ETS\EchoSignBundle\Api;

class ClientMock extends Client
{
    /**
     * Fake api call
     *
     * @param string $method
     * @param array $params
     *
     * @return stdClass result of the api call
     */
    protected function call($method, array $params)
    {
        return (object) array(
            'documentKeys' => (object) array(
                'DocumentKey' => (object) array(
                    'documentKey' => 'mock_document_key',
                    'recipientEmail' => 'mock_email@test.com'
                )
            ),
            'DocumentInfo' => (object) array(
                'status' => 'OUT_FOR_APPROVAL'
            ),
            'removeDocumentResult' => (object) array(
                'errorMessage' => null,
                'errorCode' => null,
                'success' => true
            ),
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
                'errorMessage' => null,
                'errorCode' => null,
                'success' => true
            ),
            'getDocumentUrlsResult' => (object) array(
                'urls' => (object) array(
                    'DocumentUrl' => (object) array(
                        'url' => 'http://stlab.adobe.com/wiki/images/d/d3/Test.pdf'
                    )
                ),
                'errorMessage' => null,
                'errorCode' => null,
                'success' => true
            ),
        );
    }
}
