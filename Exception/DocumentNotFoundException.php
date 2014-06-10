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
namespace ETS\EchoSignBundle\Exception;

class DocumentNotFoundException extends \Exception
{
    /**
     * Constructor
     *
     * @param string     $documentKey
     * @param string     $errorMessage
     * @param string     $errorCode
     * @param \Exception $previous
     */
    public function __construct($documentKey, $errorMessage = null, $errorCode = null, \Exception $previous = null)
    {
        parent::__construct(
            sprintf('Error while removing document with key: %s. Error message: %s. Error code: %s', $documentKey, $errorMessage, $errorCode),
            0,
            $previous
        );
    }
}
