<?php

namespace Betacie\Bundle\MangoPayBundle\Model;

use Betacie\Bundle\MangoPayBundle\Entity\ImmediateContribution;
use Betacie\Bundle\MangoPayBundle\ResponseBag;
use Betacie\MangoPay\Message\ImmediateContributionRequest;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Response;

class ImmediateContributionManager
{

    /**
     * @var ImmediateContributionRequest
     */
    protected $immediateContributionRequest;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(ImmediateContributionRequest $immediateContributionRequest, EntityManager $em)
    {
        $this->immediateContributionRequest = $immediateContributionRequest;
        $this->em                           = $em;
    }

    public function create(array $parameters)
    {
        $response = $this->immediateContributionRequest->create($parameters);

        $immediateContribution = $this->denormalize($response);

        return $immediateContribution;
    }

    public function denormalize(Response $response)
    {
        $bag = new ResponseBag($response->json());

        $immediateContribution = new ImmediateContribution();
        $immediateContribution
            ->setAmount($bag->get('Amount'))
            ->setAnswerCode($bag->get('AnswerCode'))
            ->setAnswerMessage($bag->get('AnswerMessage'))
            ->setClientFeeAmount($bag->get('ClientFeeAmount'))
            ->setCreationDate($bag->get('CreationDate'))
            ->setError($bag->get('Error'))
            ->setCompleted($bag->get('IsCompleted'))
            ->setSucceeded($bag->get('IsSucceeded'))
            ->setMangoPayId($bag->get('ID'))
            ->setPaymentCardId($bag->get('PaymentCardID'))
            ->setTag($bag->get('Tag'))
            ->setType($bag->get('Type'))
            ->setUpdateDate($bag->get('UpdateDate'))
            ->setUserId($bag->get('UserID'))
            ->setWalletId($bag->get('WalletID'))
        ;

        return $immediateContribution;
    }

    private function getRepository()
    {
        return $this->em->getRepository('Betacie\\Bundle\\MangoPayBundle\\Entity\\ImmediateContribution');
    }

}
