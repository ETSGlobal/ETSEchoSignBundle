<?php
/**
 * Created by JetBrains PhpStorm.
 * User: passkey
 * Date: 6/14/13
 * Time: 3:02 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ETS\EchoSignBundle\Tests;


use ETS\EchoSignBundle\Api\DocumentCreationInfo;
use ETS\EchoSignBundle\Api\RecipientInfo;
use ETS\EchoSignBundle\Test\ContainerAwareWebTestCase;

class ClientTest extends ContainerAwareWebTestCase
{
    public function testSendDocument()
    {
        $documentCreationInfo = new DocumentCreationInfo(array(
            new RecipientInfo('passkey1510@gmail.com', RecipientInfo::RECIPIENT_ROLE_SIGNER)
        ), 'Test document', )
        $client = $this->get('ets.echo.sign.client');
        $client->sendDocument();
    }
}