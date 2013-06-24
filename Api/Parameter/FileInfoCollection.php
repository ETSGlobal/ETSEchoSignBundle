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
 * Class FileInfoCollection contains a collection fo files
 *
 * @package ETS\EchoSignBundle\Api\Parameter
 */
class FileInfoCollection implements ParameterInterface
{
    /**
     * @var array
     */
    private $fileInfos = array();

    /**
     * Constructor
     *
     * @param array $fileInfos
     */
    public function __construct($fileInfos = array())
    {
        foreach ($fileInfos as $fileInfo) {
            $this->addFileInfo($fileInfo);
        }
    }

    /**
     * Add FileInfo to the collection
     *
     * @param FileInfo $fileInfo
     */
    public function addFileInfo(FileInfo $fileInfo)
    {
        $this->fileInfos[] = $fileInfo;
    }

    /**
     * Build the params array
     *
     * @return array
     */
    public function build()
    {
        $ret = array();
        foreach ($this->fileInfos as $fileInfo) {
            $ret[] = $fileInfo->build();
        }

        return $ret;
    }
}