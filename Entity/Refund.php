<?php

namespace Betacie\Bundle\MangoPayBundle\Entity;

class Refund
{

    protected $id;
    protected $mangoPayId;
    protected $tag;
    protected $creationDate;
    protected $updateDate;
    protected $userId;
    protected $contributionId;
    protected $isSucceeded;
    protected $isCompleted;
    protected $error;

    public function getId()
    {
        return $this->id;
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

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getContributionId()
    {
        return $this->contributionId;
    }

    public function setContributionId($contributionId)
    {
        $this->contributionId = $contributionId;

        return $this;
    }

    public function isSucceeded()
    {
        return $this->isSucceeded;
    }

    public function setIsSucceeded($isSucceeded)
    {
        $this->isSucceeded = $isSucceeded;

        return $this;
    }

    public function isCompleted()
    {
        return $this->isCompleted;
    }

    public function setIsCompleted($isCompleted)
    {
        $this->isCompleted = $isCompleted;

        return $this;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

}
