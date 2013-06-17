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

class FileInfo implements ParameterInterface
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $file;

    /**
     * Constructor
     *
     * @param $filename
     * @param $file
     */
    public function __construct($filename, $file)
    {
        $this->filename = $filename;
        $this->file = $file;
    }

    /**
     * Build the params array
     *
     * @return array
     */
    public function build()
    {
        return array(
            'file' => file_get_contents($this->file),
            'fileName' => $this->filename
        );
    }

    /**
     * Indicate if the arguments are valid
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->filename && $this->file;
    }
}