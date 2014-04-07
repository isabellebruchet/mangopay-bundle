<?php

namespace Betacie\Bundle\MangoPayBundle\Model;

use Betacie\Bundle\MangoPayBundle\Entity\Wallet;
use Betacie\Bundle\MangoPayBundle\ResponseBag;
use Betacie\MangoPay\Message\WalletRequest;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Response;

class WalletManager
{

    /**
     * @var WalletRequest
     */
    protected $walletRequest;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(WalletRequest $walletRequest, EntityManager $em)
    {
        $this->walletRequest = $walletRequest;
        $this->em            = $em;
    }

    /**
     * Create a Wallet
     *
     * @param  array  $parameters
     * @return Wallet
     */
    public function create(array $parameters)
    {
        $response = $this->walletRequest->create($parameters);
        $wallet   = $this->denormalize($response);

        return $wallet;
    }

    public function get($id)
    {
        $response = $this->walletRequest->fetch($id);
        $wallet   = $this->denormalize($response);

        return $wallet;
    }
    
    /**
     * Fetch operations on a wallet
     *
     * @param  integer                       $walletId
     * @return \Guzzle\Http\Message\Response
     */
    public function getOperations($walletId)
    {
        return $this->walletRequest->getOperations($walletId);
    }

    /**
     * Transform Guzzle Response to a Wallet
     *
     * @param \Guzzle\Http\Message\Response $response
     */
    public function denormalize(Response $response, Wallet $wallet = null)
    {
        $bag = new ResponseBag($response->json());

        if (null === $wallet) {
            $wallet = new Wallet();
        }

        $wallet
            ->setAmount($bag->get('Amount'))
            ->setCollectedAmount($bag->get('CollectedAmount'))
            ->setContributionLimitDate($bag->get('ContributionLimitedDate'))
            ->setCreationDate($bag->get('CreationDate'))
            ->setDescription($bag->get('Description'))
            ->setMangoPayId($bag->get('ID'))
            ->setOwners($bag->get('Owners'))
            ->setRaisingGoalAmount($bag->get('RaisingGoalAmount'))
            ->setSpentAmount($bag->get('SpentAmount'))
            ->setTag($bag->get('Tag'))
            ->setUpdateDate($bag->get('UpdateDate'))
            ->setName($bag->get('Name'))
        ;

        return $wallet;
    }

}
