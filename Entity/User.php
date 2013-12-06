<?php

namespace Betacie\Bundle\MangoPayBundle\Entity;

use Betacie\MangoPay\Message\UserRequest;

class User
{

    protected $id;
    protected $email;
    protected $firstName;
    protected $lastName;
    protected $ip;
    protected $birthday;
    protected $nationality;
    protected $personType;
    protected $tag;
    protected $canRegisterMeanOfPayment;
    protected $hasRegisteredMeansOfPayment;
    protected $mangoPayId;
    protected $personalWalletAmount;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getPersonType()
    {
        return $this->personType;
    }

    public function setPersonType($personType)
    {
        $this->personType = $personType;

        return $this;
    }

    public function setNaturalPersonType()
    {
        $this->personType = UserRequest::NATURAL_PERSON;

        return $this;
    }

    public function setLegalPersonalityType()
    {
        $this->personType = UserRequest::LEGAL_PERSONALITY;

        return $this;
    }

    public static function getAvailablePersonTypes()
    {
        return array(
            UserRequest::LEGAL_PERSONALITY,
            UserRequest::NATURAL_PERSON,
        );
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

    public function getCanRegisterMeanOfPayment()
    {
        return $this->canRegisterMeanOfPayment;
    }

    public function setCanRegisterMeanOfPayment($canRegisterMeanOfPayment)
    {
        $this->canRegisterMeanOfPayment = $canRegisterMeanOfPayment;

        return $this;
    }

    public function getHasRegisteredMeansOfPayment()
    {
        return $this->hasRegisteredMeansOfPayment;
    }

    public function setHasRegisteredMeansOfPayment($hasRegisteredMeansOfPayment)
    {
        $this->hasRegisteredMeansOfPayment = $hasRegisteredMeansOfPayment;

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
    
    public function getPersonalWalletAmount() {
        return $this->personalWalletAmount;
    }

    public function setPersonalWalletAmount($personalWalletAmount) {
        $this->personalWalletAmount = $personalWalletAmount;
        
        return $this;
    }
}
