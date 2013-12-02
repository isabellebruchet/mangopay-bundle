<?php

namespace Betacie\Bundle\MangoPayBundle\Entity;

class PaymentCard
{

    protected $id;
    protected $ownerId;
    protected $cardNumber;
    protected $mangoPayId;
    protected $redirectUrl;
    protected $tag;

    public function getId()
    {
        return $this->id;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getMangoPayId()
    {
        return $this->mangoPayId;
    }

    public function setMangoPayId($mangoPayId)
    {
        $this->mangoPayId = $mangoPayId;

        return $this;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    public function getRedirectUrl() {
        return $this->redirectUrl;
    }

    public function setRedirectUrl($redirectUrl) {
        $this->redirectUrl = $redirectUrl;
        
        return $this;
    }
}
