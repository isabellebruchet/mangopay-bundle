<?php

namespace Betacie\Bundle\MangoPayBundle\Model;

use Betacie\Bundle\MangoPayBundle\Entity\PaymentCard;
use Betacie\MangoPay\Message\PaymentCardRequest;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Response;
use Betacie\Bundle\MangoPayBundle\ResponseBag;

class PaymentCardManager
{

    /**
     * @var PaymentCardRequest
     */
    protected $paymentCardRequest;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(PaymentCardRequest $paymentCardRequest, EntityManager $em)
    {
        $this->paymentCardRequest = $paymentCardRequest;
        $this->em                 = $em;
    }
    
    public function create(array $parameters)
    {
        $response = $this->paymentCardRequest->create($parameters);
        $paymentCard = $this->denormalize($response);

        return $paymentCard;
    }
    
    public function denormalize(Response $response, PaymentCard $paymentCard = null)
    {
        $bag = new ResponseBag($response->json());

        if ($paymentCard === null) {
            $paymentCard = new PaymentCard();
        }

        $paymentCard
            ->setMangoPayId($bag->get('ID'))
            ->setOwnerId($bag->get('OwnerID'))
            ->setRedirectUrl($bag->get('RedirectURL'))
            ->setTag($bag->get('Tag'))
            ->setCardNumber($bag->get('CardNumber'))
        ;

        return $paymentCard;
    }

    public function get($id)
    {
        $response = $this->paymentCardRequest->fetch($id);
        $paymentCard     = $this->denormalize($response);

        return $paymentCard;
    }

    public function delete(PaymentCard $paymentCard)
    {
        $this->paymentCardRequest->delete($paymentCard->getMangoPayId());

        $this->em->remove($paymentCard);
        $this->em->flush();
    }

    private function getRepository()
    {
        return $this->em->getRepository('Betacie\\Bundle\\MangoPayBundle\\Entity\\PaymentCard');
    }

}
