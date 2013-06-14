<?php
/**
 * Created by JetBrains PhpStorm.
 * User: passkey
 * Date: 6/14/13
 * Time: 12:00 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ETS\EchoSignBundle\Api;


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

    public function __construct($key, $gateway, $wsdl)
    {
        $this->key = $key;
        $this->gateway = $gateway;
        $this->wsdl = $wsdl;
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

    public function sendDocument(DocumentCreationInfo $documentInfo)
    {
        $result = $this->getSoapClient()->sendDocument(array(
            'apiKey' => $this->key,
            'documentCreationInfo' => $documentInfo->build()
        ));

        return $result;
    }

    public function getDocumentInfo($documentKey)
    {
        throw new \Exception('This method is not implemented yet');
    }

    public function removeDocument($documentKey)
    {
        $this->getSoapClient()->removeDocument(array(
            'apiKey' => $this->key,
            'documentKey' => $documentKey
        ));
    }
}