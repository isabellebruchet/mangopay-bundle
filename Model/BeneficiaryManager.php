<?php

namespace Betacie\Bundle\MangoPayBundle\Model;

use Betacie\Bundle\MangoPayBundle\Entity\Beneficiary;
use Betacie\Bundle\MangoPayBundle\ResponseBag;
use Betacie\MangoPay\Message\BeneficiaryRequest;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Response;

class BeneficiaryManager
{

    /**
     * @var BeneficiaryRequest
     */
    protected $beneficiaryRequest;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(BeneficiaryRequest $beneficiaryRequest, EntityManager $em)
    {
        $this->beneficiaryRequest = $beneficiaryRequest;
        $this->em                 = $em;
    }

    public function create(array $parameters)
    {
        $response    = $this->beneficiaryRequest->create($parameters);
        $beneficiary = $this->denormalize($response);

        return $beneficiary;
    }
    
    public function get($id)
    {
        $response = $this->beneficiaryRequest->fetch($id);
        $beneficiary = $this->denormalize($response);

        return $beneficiary;
    }

    public function denormalize(Response $response)
    {
        $bag = new ResponseBag($response->json());

        $beneficiary = new Beneficiary();
        $beneficiary
            ->setBankAccountBIC($bag->get('BankAccountBIC'))
            ->setBankAccountIBAN($bag->get('BankAccountIBAN'))
            ->setBankAccountOwnerAddress($bag->get('BankAccountOwnerAddress'))
            ->setBankAccountOwnerName($bag->get('BankAccountOwnerName'))
            ->setCreationDate($bag->get('CreationDate'))
            ->setMangoPayId($bag->get('ID'))
            ->setTag($bag->get('Tag'))
            ->setUpdateDate($bag->get('UpdateDate'))
            ->setUserId($bag->get('UserID', 0))
        ;

        return $beneficiary;
    }

}
