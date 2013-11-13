<?php

namespace Betacie\Bundle\MangoPayBundle\Model;

use Betacie\Bundle\MangoPayBundle\Entity\Contribution;
use Betacie\Bundle\MangoPayBundle\ResponseBag;
use Betacie\MangoPay\Message\ContributionRequest;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Response;

class ContributionManager
{

    /**
     * @var ContributionRequest
     */
    protected $contributionRequest;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(ContributionRequest $contributionRequest, EntityManager $em)
    {
        $this->contributionRequest = $contributionRequest;
        $this->em                  = $em;
    }

    public function create(array $parameters)
    {
        $response = $this->contributionRequest->create($parameters);

        $contribution = $this->denormalize($response);

        return $contribution;
    }
    
    public function get($id)
    {
        $response = $this->contributionRequest->fetch($id);
        $contribution = $this->denormalize($response);

        return $contribution;
    }

    public function denormalize(Response $response)
    {
        $bag = new ResponseBag($response->json());

        $contribution = new Contribution();
        $contribution
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
            ->setPaymentUrl($bag->get('PaymentURL'))
            ->setTemplateUrl($bag->get('TemplateURL'))
            ->setReturnUrl($bag->get('ReturnURL'))
        ;

        return $contribution;
    }

    private function getRepository()
    {
        return $this->em->getRepository('Betacie\\Bundle\\MangoPayBundle\\Entity\\Contribution');
    }

}
