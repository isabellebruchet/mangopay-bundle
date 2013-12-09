<?php

namespace Betacie\Bundle\MangoPayBundle\Model;

use Betacie\Bundle\MangoPayBundle\Entity\Withdrawal;
use Betacie\Bundle\MangoPayBundle\ResponseBag;
use Betacie\MangoPay\Message\WithdrawalRequest;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Response;

class WithdrawalManager
{

    /**
     * @var WithdrawalRequest
     */
    protected $withdrawalRequest;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(WithdrawalRequest $withdrawalRequest, EntityManager $em)
    {
        $this->withdrawalRequest = $withdrawalRequest;
        $this->em                = $em;
    }

    public function create(array $parameters)
    {
        $response = $this->withdrawalRequest->create($parameters);

        $withdrawal = $this->denormalize($response);

        return $withdrawal;
    }
    
    public function get($id)
    {
        $response = $this->withdrawalRequest->fetch($id);
        $withdrawal = $this->denormalize($response);

        return $withdrawal;
    }
    

    public function denormalize(Response $response)
    {
        $bag = new ResponseBag($response->json());

        $withdrawal = new Withdrawal();
        $withdrawal
            ->setAmount($bag->get('Amount'))
            ->setAmountWithoutFees($bag->get('AmountWithoutFees'))
            ->setBeneficiaryId($bag->get('BeneficiaryID'))
            ->setClientFeeAmount($bag->get('ClientFeeAmount'))
            ->setCreationDate($bag->get('CreationDate'))
            ->setError($bag->get('Error'))
            ->setIsCompleted($bag->get('IsCompleted'))
            ->setIsSucceeded($bag->get('IsSucceeded'))
            ->setMangoPayId($bag->get('ID'))
            ->setTag($bag->get('Tag'))
            ->setUpdateDate($bag->get('UpdateDate'))
            ->setUserId($bag->get('UserID'))
            ->setWalletId($bag->get('WalletID'))
        ;

        return $withdrawal;
    }

}
