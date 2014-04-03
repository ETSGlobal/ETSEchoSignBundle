ETSEchoSignBundle
=================

ETSEchoSignBundle provides a wrapper to EchoSign APIs: https://secure.echosign.com/public/docs/EchoSignDocumentService16

[![Build Status](https://api.travis-ci.org/ETSGlobal/ETSEchoSignBundle.png)](https://travis-ci.org/ETSGlobal/ETSEchoSignBundle)

Installation
=================
You can install the bundle by using composer.
```
composer.phar require ets/echo-signbundle
```
Use dev-master when it demands for which version to install.

##Enabling the bundle

Enable the bundle in the kernel:
``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new ETS\EchoSignBundle\ETSEchoSignBundle()
    );
}
```

Configuration
=================
The bundle requires 3 mandatory parameters, in your config.yml:
```
ets_echo_sign:
    api:
        key:  YOUR_API_KEY
        gateway:  ECHOSIGN_API_GATEWAY #e.g: https://secure.echosign.com/services/EchoSignDocumentService16
        wsdl:  ECHOSIGN_API_WSDL_URL #e.g: https://secure.echosign.com/services/EchoSignDocumentService16?wsdl
```
You could also activate the debug option:
```
ets_echo_sign:
    debug:
        prefix:  YOUR_PREFIX
```
It does nothing more than adding the prefix to the filename when uploading. Since EchoSign offers no way to organize your files, the prefix should help you classify uploaded files in a "cleaner" way. For example, you could have a prefix "DEV_" for local development, "PREPROD_" for preprod environment.

Available APIs
=================
Client service offer three wrappers to the most used methods:
- sendDocument
- getDocumentInfo
- removeDocument
- getMyDocuments

**To send a document:**
```
$recipients = new RecipientInfoCollection('recipient@test.com');
$fileCollections = new FileInfoCollection();
$fileCollections->addFileInfo(new FileInfo('file.pdf', 'file.pdf'));
$documentCreationInfo = new DocumentCreationInfo($recipients, 'Test document', $fileCollections);
$this->getContainer()->get('ets.echo.sign.client')->sendDocument($documentCreationInfo);
```
The method return a document key of the newly uploaded file

**To get info on a document**
```
$this->getContainer()->get('ets.echo.sign.client')->getDocumentInfo($documentKey);
```
If the document doesn't exist, it will return null instead of a SoapFault exception as implemented by the original API.

**To remove a document**
```
$this->getContainer()->get('ets.echo.sign.client')->removeDocument($documentKey);
```

**To retrieve all documents**
```
$this->getContainer()->get('ets.echo.sign.client')->getMyDocuments();
```

Code License:
=================
[Resources/meta/LICENSE](https://github.com/ETSGlobal/ETSEchoSignBundle/blob/master/Resources/meta/LICENSE)
