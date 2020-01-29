# XML Digital Sigature Builder for PHP (dsig-xml-builder)

DSig XML Builder is a package for PHP to simplify and automatize process of building XML digital signature. The package uses [PHP OpenSSL extension functions](https://www.php.net/manual/en/ref.openssl.php) to implement [W3C Recommendation of XML Signature Syntax and Processing](https://www.w3.org/TR/xmldsig-core1/).

## Requirements
* PHP 7.1 or higher
* ext-dom PHP extension
* ext-openssl PHP extension
* budkovsky/aid PHP library
* budkovsky/openssl-wrapper PHP library


## Capabilities
This package gives different ways in processing digital signature.
It is possible to create custom signature in case of specific requirements,
or to use one of the provided generator classes to generate the most common signature types.

## Generators

Generator is PHP class built around the convention of facade design pattern.
It allows to generate digital signature in simple way, without detailed knowledge about the digital signature processing.

[read more](./docs/md/generator.README.md)







