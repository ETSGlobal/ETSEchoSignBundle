<?php
/**
 * Created by JetBrains PhpStorm.
 * User: passkey
 * Date: 6/14/13
 * Time: 12:26 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ETS\EchoSignBundle\Api;


interface ParameterInterface
{
    public function isValid();

    public function build();
}