<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Helper;

use Budkovsky\OpenSslWrapper\Csr;
use Budkovsky\OpenSslWrapper\Keystore;
use Budkovsky\OpenSslWrapper\PrivateKey;
use Budkovsky\OpenSslWrapper\Entity\CsrSubject;

class ExampleKey
{
    public static function getKeystore(?PrivateKey $key = null): Keystore
    {
        $key = $key ?? new PrivateKey();
        $rootKey = new PrivateKey();
        $interKey = new PrivateKey();

        $rootCert = Csr::create(
            $rootKey,
            CsrSubject::create()
                ->setCommonName('Root issuer')
                ->setOrganizationName('Root organization')
            )->sign($rootKey);

        $interCert = Csr::create(
            $interKey,
            CsrSubject::create()
                ->setCommonName('Intermediate issuer')
                ->setOrganizationName('Intermediate organization')
            )->sign($rootKey);

        $cert = Csr::create(
            $key,
            CsrSubject::create()
                ->setCommonName('Some subject')
                ->setOrganizationName('Some organization')
        )->sign($interKey);

        return Keystore::create()
            ->setPrivateKey($key)
            ->setCertificate($cert)
            ->addExtraCert($interCert)
            ->addExtraCert($rootCert)
        ;
    }

}

