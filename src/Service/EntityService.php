<?php
namespace Budkovsky\DsigXmlBuilder\Service;

use Budkovsky\DsigXmlBuilder\Entity\SignatureType;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;
use Budkovsky\DsigXmlBuilder\Entity\DigestMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureValueType;

class EntityService
{
    /** @var SignatureType */
    protected $entity;

    protected function createSkeleton(): void
    {
        $this->entity = SignatureType::create()
            ->setSignedInfo(
                    SignedInfoType::create()
                        ->setCanonicalizationMethod(new CanonicalizationMethodType())
                        ->setSignatureMethod(new SignatureMethodType())
                        ->addReference(
                                ReferenceType::create()
                                    ->setDigestMethod(new DigestMethodType())
                            )
                )
            ->setSignatureValue(new SignatureValueType())
        ;

    }

    public function getEntity(): SignatureType
    {
        return $this->entity;
    }
}

