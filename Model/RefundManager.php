<?php

namespace Betacie\Bundle\MangoPayBundle\Model;

use Betacie\Bundle\MangoPayBundle\Entity\Refund;
use Betacie\Bundle\MangoPayBundle\ResponseBag;
use Betacie\MangoPay\Message\RefundRequest;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Response;

class RefundManager
{

    /**
     * @var RefundRequest
     */
    protected $refundRequest;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(RefundRequest $refundRequest, EntityManager $em)
    {
        $this->refundRequest = $refundRequest;
        $this->em            = $em;
    }

    public function create(array $parameters)
    {
        $response = $this->refundRequest->create($parameters);
        $refund   = $this->denormalize($response);

        return $refund;
    }

    public function denormalize(Response $response)
    {
        $bag = new ResponseBag($response->json());

        $refund = new Refund();
        $refund
            ->setContributionId($bag->get('ContributionID'))
            ->setCreationDate($bag->get('CreationDate'))
            ->setError($bag->get('Error'))
            ->setIsCompleted($bag->get('IsCompleted'))
            ->setIsSucceeded($bag->get('IsSucceeded'))
            ->setMangoPayId($bag->get('ID'))
            ->setUpdateDate($bag->get('UpdateDate'))
            ->setUserId($bag->get('UserID'))
        ;

        return $refund;
    }

}
