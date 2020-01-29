[> HOME](../../README.md)

# XML Digital Sigature Builder for PHP (dsig-xml-builder)

# Generator

Generator is PHP class built around the convention of facade design pattern.
It allows to generate digital signature in simple way, without detailed knowledge about the digital signature processing.

## The simplest example

First step to generate digital signature of some content is to create `generator` object from `Facade` namespace.

```php
use Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopingSignatureGenerator;

$generator = new RSAEnvelopingSignatureGenerator;
```

Next load private key into the generator:

```php
use Budkovsky\OpenSslWrapper\PrivateKey;
# ...
$pkey = new PrivateKey;
$pkey->load(file_get_contents('/path/to/private/key.pem');
$generator->getKeystore()->setPrivateKey($pkey);
```

and set content to be signed:

```php
$generator->setContent('Lorem ipsum');
```

Finally get the result:

```php
$result = $generator->process()->get();
```

## Generator types

There are three basic generator types according to three types of XMl digital signature:
- enveloping: signed content is placed inside signature, as a child of `<Signature>` element, exaclty in `<Object>` element,
- enveloped: signed content is whole or a fragment of a XML document where signature will be nested),
- detached: signed content is placed in different resource from the signature.

```php
Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopedSignatureGenerator as Generator;
#OR
Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopingSignatureGenerator as Generator;
#OR
Budkovsky\DsigXmlBuilder\Facade\RSADetachedSignatureGenerator as Generator;
# ...
$generator = new Generator;
```

## Generator parameters
Generator parameters are set by collection of setter methods.

### Keystore setter
Keystore is an object from OpenSslWrapper package, stores RSA keys and certificates, is integrated  part of signature generator.
Minimal necessary keystore configuration for generator is to set the private key:

```php
# to set private key only
$generator->getKeystore()->setPrivateKey(
    PrivateKey::create()->load(
        file_get_contents('/path/to/pem/file')
    )
);

# or to set whole keystore object
$generator->setKeystore($keystore);
```

Keystore can contain CA certificates too. In this case generator wil create digital signature with chain of X509 certificates. For more details about keystore, keys, certficates and configuration of these elements, please read [OpenSslWrapper documentation](https://github.com/budkovsky/openssl-wrapper).

### Content setter
Sets content to be signed by generator:

```php
$generator->setContent($content);
```

where `$content` is:
 - exactly the content to be signed for `enveloping` signature generator
 - URI of content to be signed for `detached` signature generator

Content parameter is not necessary for `enveloped` signature generator, because content to sign is set by document setter.

### Document setter
Document property is needed to be set for `enveloped` signature only. It loads the XML document as a string into the generator.

```php
$generator->loadDocument('<document xmlns="http://example.org/envelope"><body>Lorem ipsum</body></document>');
```

### CanonicalizationAlgorithm setter
Optional parameter, sets the method of canonicalization algorithm. In other words canonicalization algortihm is the way how to transforma content to the form acceptable by XML digital signature definition. For example: canonicalization algorithm can removes all XML/HTML comments, or can replace all LF(line feed) characters with CR(carriage return).

```php
use Budkovsky\DsigXmlBuilder\Enum\CanonicalizationAlgorithm;
# ...
$generator->setCanonicalizationAlgorithm(CanonicalizationAlgorithm::XML_1_0_WITH_COMMENTS);
```

Default value of canonicalization method algorithm is `http://www.w3.org/TR/2001/REC-xml-c14n-20010315`. All available values are defined as constants in enumeration class `Budkovsky\DsigXmlBuilder\Enum\CanonicalizationAlgorithm`.


### DigestAlgorithm setter
Optional parameter. DigestAlgorithm is method of generating hash(digest value) from the content.

```php
use Budkovsky\DsigXmlBuilder\Enum\DigestAlgorithm;
# ...
$generator->setDigestAlgorithm(DigestAlgorithm::SHA512);
```

Default value of digest value algorithm is `http://www.w3.org/2001/04/xmlenc#sha256`. All available values are defined as constans in enumeration class `Budkovsky\DsigXmlBuilder\Enum\DigestAlgorithm`.

### SignatureAlgorithm setter
Optional parameter. SignatureAlgorithm is method of generating digital signature.

```php
use Budkovsky\DsigXmlBuilder\Enum\SignatureAlgorithm;
# ...
$generator->setSignatureAlgorithm(SignatureAlgorithm::RSA_SHA512);
```

Default value of signature algorithm is `http://www.w3.org/2001/04/xmldsig-more#rsa-sha256`. All available values are defined as constants in enumeration class `Budkovsky\DsigXmlBuilder\Enum\SignatureAlgorithm`.

### SignatureId setter
Optional. Sets ID attribute for root XML element.

```php
$generator->setSignatureId('my-signature');
```

### ContentId setter

### DigestValueId setter

### SignatureId setter

### KeyInfoMode setter

### process() method
The method where signture is calculating. Must be called after all setter and before `get()` or `getDOMDocument()` method.

```php
$generator->process();
```

### get() method
Returns calculated signature as a string. Must be called after `process()` method.

```php
$signatureString = $generator->get();
```

### getDOMDocument() method
Returns calculated signature as DOMDocument object. Must be called after `process()` method.
