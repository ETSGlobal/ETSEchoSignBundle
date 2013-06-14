<?php
/**
 * Created by JetBrains PhpStorm.
 * User: passkey
 * Date: 6/14/13
 * Time: 2:34 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ETS\EchoSignBundle\Api;


class RecipientInfo implements ParameterInterface
{
    const RECIPIENT_ROLE_SIGNER = 'SIGNER';
    const RECIPIENT_ROLE_APPROVER = 'AOOROVER';

    private $email;
    private $role;

    public function __construct($email, $role)
    {
        $this->email = $email;
        $this->role = $role;
    }

    public function isValid()
    {
        return $this->email && $this->role;
    }

    public function build()
    {
        return array(
            'email' => $this->email,
            'role' => $this->role
        );
    }
}