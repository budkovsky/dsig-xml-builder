<?php
namespace Budkovsky\DsigXmlBuilder\Enum;

/**
 * Enumeration of KeyInfo mode
 */
class KeyInfoMode
{
    const RSA_KEY_VALUE = 1;
    const RSA_X509DATA_CERTIFICATE = 2;
    const RSA_X509DATA_EXTRA_CERTS = 4;
}
