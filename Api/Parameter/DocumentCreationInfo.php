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

namespace ETS\EchoSignBundle\Api\Parameter;

/**
 * Class DocumentCreationInfo contains information to create a document
 *
 * @package ETS\EchoSignBundle\Api\Parameter
 */
class DocumentCreationInfo implements ParameterInterface
{
    const SIGNATURE_TYPE_ESIGN = 'ESIGN';
    const SIGNATURE_TYPE_WRITTEN = 'WRITTEN';
    const SIGNATURE_FLOW_SENDER_SIGNATURE_NOT_REQUIRED = 'SENDER_SIGNATURE_NOT_REQUIRED';
    const SIGNATURE_FLOW_SENDER_SIGNS_LAST = 'SENDER_SIGNS_LAST';
    const SIGNATURE_FLOW_SENDER_SIGNS_FIRST = 'SENDER_SIGNS_FIRST';

    /**
     * @var RecipientInfoCollection
     */
    private $recipients;

    /**
     * @var string
     */
    private $name;

    /**
     * @var FileInfoCollection
     */
    private $fileInfos;

    /**
     * @var string
     */
    private $signatureType;

    /**
     * @var string
     */
    private $signatureFlow;

    /**
     * @var array
     */
    private $optionalParams = array();

    /**
     * @var string
     */
    private $debugPrefix;

    /**
     * Constructor
     *
     * @param RecipientInfoCollection $recipients
     * @param $name
     * @param FileInfoCollection $fileInfos
     * @param $signatureType
     * @param $signatureFlow
     * @param array $optionalParams
     */
    public function __construct(RecipientInfoCollection $recipients, $name, FileInfoCollection $fileInfos, $signatureType = DocumentCreationInfo::SIGNATURE_TYPE_ESIGN, $signatureFlow = DocumentCreationInfo::SIGNATURE_FLOW_SENDER_SIGNATURE_NOT_REQUIRED, array $optionalParams = array())
    {
        $this->recipients = $recipients;
        $this->name = $name;
        $this->fileInfos = $fileInfos;
        $this->signatureType = $signatureType;
        $this->signatureFlow = $signatureFlow;
        $this->optionalParams = $optionalParams;
    }

    /**
     * Build the param array
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public function build()
    {
        return array_merge(array(
            'fileInfos' => $this->fileInfos->build(),
            'name' => $this->getDebugPrefix() ? $this->getDebugPrefix() . $this->name : $this->name,
            'signatureFlow' => $this->signatureFlow,
            'signatureType' => $this->signatureType,
            'recipients' => $this->recipients->build()
        ), $this->optionalParams);
    }

    /**
     * @return string
     */
    public function getDebugPrefix()
    {
        return $this->debugPrefix;
    }

    /**
     * @param string $debugPrefix
     */
    public function setDebugPrefix($debugPrefix)
    {
        $this->debugPrefix = $debugPrefix;
    }
}