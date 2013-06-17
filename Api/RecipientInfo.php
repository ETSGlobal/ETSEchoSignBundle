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

class RecipientInfo implements ParameterInterface
{
    const RECIPIENT_ROLE_SIGNER = 'SIGNER';
    const RECIPIENT_ROLE_APPROVER = 'APPROVER';

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $role;

    /**
     * Constructor
     *
     * @param $email
     * @param string $role
     */
    public function __construct($email, $role = RecipientInfo::RECIPIENT_ROLE_SIGNER)
    {
        $this->email = $email;
        $this->role = $role;
    }

    /**
     * Indicate if the arguments are valid
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->email && $this->role;
    }

    /**
     * Build the params array
     *
     * @return array
     */
    public function build()
    {
        return array(
            'email' => $this->email,
            'role' => $this->role
        );
    }
}