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

namespace ETS\EchoSignBundle\Api;

use ETS\EchoSignBundle\Exception\DocumentNotFoundException;

class Client
{
    /**
     * @var string API key
     */
    private $key;

    /**
     * @var string API gateway
     */
    private $gateway;

    /**
     * @var string API wsdl url
     */
    private $wsdl;

    /**
     * @var \SoapClient
     */
    private $soapClient;

    /**
     * @var string debug prefix
     */
    private $debugPrefix;

    public function __construct($key, $gateway, $wsdl, $debugPrefix = null)
    {
        $this->key = $key;
        $this->gateway = $gateway;
        $this->wsdl = $wsdl;
        $this->debugPrefix = $debugPrefix;
    }

    /**
     * Initialize and return the SoapClient
     *
     * @return \SoapClient
     */
    protected function getSoapClient()
    {
        if (!$this->soapClient) {
            $this->soapClient = new \SoapClient($this->wsdl);
        }

        return $this->soapClient;
    }

    /**
     * @param DocumentCreationInfo $documentInfo
     * @return string document_key
     */
    public function sendDocument(DocumentCreationInfo $documentInfo)
    {
        if ($this->debugPrefix) {
            $documentInfo->setDebugPrefix($this->debugPrefix);
        }

        $result = $this->apiCall('sendDocument', array(
            'apiKey' => $this->key,
            'documentCreationInfo' => $documentInfo->build()
        ));

        return $result->documentKeys->DocumentKey->documentKey;
    }

    /**
     * Get document info
     *
     * @param string $documentKey
     *
     * @return stdClass document info
     */
    public function getDocumentInfo($documentKey)
    {
        try {
            return $this->apiCall('getDocumentInfo', array(
                'apiKey' => $this->key,
                'documentKey' => $documentKey
            ));
        } catch (\SoapFault $e) {
            return null;
        }

    }

    /**
     * Remove document
     *
     * @param string $documentKey
     *
     * @return boolean status of the remove process
     *
     * @throws \Exception
     */
    public function removeDocument($documentKey)
    {
        $result = $this->apiCall('removeDocument', array(
            'apiKey' => $this->key,
            'documentKey' => $documentKey
        ));

        if ($result->removeDocumentResult->errorMessage || !$result->removeDocumentResult->success) {

            throw new DocumentNotFoundException($documentKey, $result->removeDocumentResult->errorMessage, $result->removeDocumentResult->errorCode);
        }

        return $result->removeDocumentResult->success;
    }

    /**
     * Get my documents
     *
     * @return stdClass
     */
    public function getMyDocuments()
    {
        $result = $this->apiCall('getMyDocuments', array(
            'apiKey' => $this->key
        ));

        return $result->getMyDocumentsResult->documentListForUser->DocumentListItem;
    }

    /**
     * Get combined documents pdf url
     *
     * @param $documentKey
     *
     * @return string
     */
    public function getDocumentUrls($documentKey)
    {
        $result = $this->apiCall('getDocumentUrls', array(
            'apiKey' => $this->key,
            'documentKey' => $documentKey,
            'options' => array(
                'combine' => true
            )
        ));

        return $result->getDocumentUrlsResult->urls->DocumentUrl->url;
    }

    /**
     * Make an api call
     *
     * @param string $method
     * @param array $params
     *
     * @return stdClass result of the api call
     */
    protected function apiCall($method, array $params)
    {
        return call_user_func(array($this->getSoapClient(), $method), $params);
    }
}