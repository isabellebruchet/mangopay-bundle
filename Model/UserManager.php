<?php

namespace Betacie\Bundle\MangoPayBundle\Model;

use Betacie\Bundle\MangoPayBundle\Entity\User;
use Betacie\Bundle\MangoPayBundle\ResponseBag;
use Betacie\MangoPay\Message\UserRequest;
use Doctrine\ORM\EntityManager;
use Guzzle\Http\Message\Response;

class UserManager
{

    /**
     * @var UserRequest
     */
    protected $userRequest;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(UserRequest $userRequest, EntityManager $em)
    {
        $this->userRequest = $userRequest;
        $this->em          = $em;
    }

    public function create(array $parameters)
    {
        $response = $this->userRequest->create($parameters);
        $user     = $this->denormalize($response);

        return $user;
    }
    
    public function get($id)
    {
        $response = $this->userRequest->fetch($id);
        $user     = $this->denormalize($response);

        return $user;
    }

    public function update(User $user)
    {
        $response = $this->userRequest->update($user->getMangoPayId(), $this->normalize($user));

        $user = $this->denormalize($response, $user);

        return $user;
    }

    public function denormalize(Response $response, User $user = null)
    {
        $bag = new ResponseBag($response->json());

        if ($user === null) {
            $user = new User();
        }

        $user
            ->setBirthday($bag->get('Birthday'))
            ->setCanRegisterMeanOfPayment($bag->get('CanRegisterMeanOfPayment'))
            ->setEmail($bag->get('Email'))
            ->setFirstName($bag->get('FirstName'))
            ->setHasRegisteredMeansOfPayment($bag->get('HasRegisteredMeansOfPayment'))
            ->setIp($bag->get('IP'))
            ->setLastName($bag->get('LastName'))
            ->setMangoPayId($bag->get('ID'))
            ->setNationality($bag->get('Nationality'))
            ->setPersonType($bag->get('PersonType'))
            ->setTag($bag->get('Tag'))
            ->setPersonalWalletAmount($bag->get('PersonalWalletAmount'))
        ;

        return $user;
    }

    public function normalize(User $user)
    {
        return array(
            'Tag'                      => $user->getTag(),
            'Email'                    => $user->getEmail(),
            'FirstName'                => $user->getFirstName(),
            'LastName'                 => $user->getLastName(),
            'CanRegisterMeanOfPayment' => $user->getCanRegisterMeanOfPayment(),
            'Birthday'                 => $user->getBirthday(),
            'Nationality'              => $user->getNationality(),
        );
    }

}
