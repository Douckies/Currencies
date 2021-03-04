<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoryRepository::class)
 */
class History
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $exchange;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $boughtCurrency;

    /**
     * @ORM\Column(type="integer")
     */
    private $boughtCurrencyQtt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $soldCurrency;

    /**
     * @ORM\Column(type="integer")
     */
    private $soldCurrencyQtt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getExchange(): ?string
    {
        return $this->exchange;
    }

    public function setExchange(string $exchange): self
    {
        $this->exchange = $exchange;

        return $this;
    }

    public function getBoughtCurrency(): ?string
    {
        return $this->boughtCurrency;
    }

    public function setBoughtCurrency(string $boughtCurrency): self
    {
        $this->boughtCurrency = $boughtCurrency;

        return $this;
    }

    public function getBoughtCurrencyQtt(): ?int
    {
        return $this->boughtCurrencyQtt;
    }

    public function setBoughtCurrencyQtt(int $boughtCurrencyQtt): self
    {
        $this->boughtCurrencyQtt = $boughtCurrencyQtt;

        return $this;
    }

    public function getSoldCurrency(): ?string
    {
        return $this->soldCurrency;
    }

    public function setSoldCurrency(string $soldCurrency): self
    {
        $this->soldCurrency = $soldCurrency;

        return $this;
    }

    public function getSoldCurrencyQtt(): ?int
    {
        return $this->soldCurrencyQtt;
    }

    public function setSoldCurrencyQtt(int $soldCurrencyQtt): self
    {
        $this->soldCurrencyQtt = $soldCurrencyQtt;

        return $this;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(string $operation): self
    {
        $this->operation = $operation;

        return $this;
    }
}
