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

namespace ETS\EchoSignBundle\Api\Parameter;

/**
 * Class RecipientInfoCollection contains a collection of recipients
 *
 * @package ETS\EchoSignBundle\Api\Parameter
 */
class RecipientInfoCollection implements ParameterInterface
{
    /**
     * @var array
     */
    private $recipientInfos = array();

    /**
     * Constructor
     *
     * @param array $recipients
     */
    public function __construct($recipients = array())
    {
        foreach ($recipients as $recipient) {
            $this->addRecipientInfo(new RecipientInfo($recipient));
        }
    }

    /**
     * Add RecipientInfo to the collection
     *
     * @param RecipientInfo $recipientInfo
     */
    public function addRecipientInfo(RecipientInfo $recipientInfo)
    {
        $this->recipientInfos[] = $recipientInfo;
    }

    /**
     * Build the params array
     *
     * @return array
     */
    public function build()
    {
        $ret = array();
        foreach ($this->recipientInfos as $recipientInfo) {
            $ret[] = $recipientInfo->build();
        }

        return $ret;
    }
}
