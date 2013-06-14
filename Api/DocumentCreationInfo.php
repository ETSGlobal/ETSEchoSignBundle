<?php
namespace ETS\EchoSignBundle\Api;

class DocumentCreationInfo implements ParameterInterface
{
    private $recipients;
    private $name;
    private $fileInfos;
    private $signatureType;
    private $signatureFlow;

    private $optionalParams;

    public function __construct(array $recipients, $name, FileInfo $fileInfos, $signatureType, $signatureFlow, array $optionalParams = array())
    {
        $this->recipients = $recipients;
        $this->name = $name;
        $this->fileInfos = $fileInfos;
        $this->signatureType = $signatureType;
        $this->signatureFlow = $signatureFlow;
    }

    public function build()
    {
        if (!$this->isValid()) {
            throw new \InvalidArgumentException('Parameters are not valid, please check the required parameters as in Echo Sign API doc');
        }

        return array_merge(array(
            'fileInfos' => $this->fileInfos->build(),
            'name' => $this->name,
            'signatureFlow' => $this->signatureFlow,
            'signatureType' => $this->signatureType,
            'tos' => $this->recipients
        ), $this->optionalParams);
    }

    public function isValid()
    {
        return $this->recipients && $this->name && $this->fileInfos && $this->signatureType && $this->signatureFlow;
    }
//
//    /**
//     * @return mixed
//     */
//    public function getRecipients()
//    {
//        return $this->recipients;
//    }
//
//    /**
//     * @param mixed $recipients
//     */
//    public function setRecipients($recipients)
//    {
//        $this->recipients = $recipients;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @param mixed $name
//     */
//    public function setName($name)
//    {
//        $this->name = $name;
//    }
//
//    /**
//     * @return FileInfo
//     */
//    public function getFileInfos()
//    {
//        return $this->fileInfos;
//    }
//
//    /**
//     * @param FileInfo $fileInfos
//     */
//    public function setFileInfos(FileInfo $fileInfos)
//    {
//        $this->fileInfos = $fileInfos;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getSignatureType()
//    {
//        return $this->signatureType;
//    }
//
//    /**
//     * @param mixed $signatureType
//     */
//    public function setSignatureType($signatureType)
//    {
//        $this->signatureType = $signatureType;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getSignatureFlow()
//    {
//        return $this->signatureFlow;
//    }
//
//    /**
//     * @param mixed $signatureFlow
//     */
//    public function setSignatureFlow($signatureFlow)
//    {
//        $this->signatureFlow = $signatureFlow;
//    }
}