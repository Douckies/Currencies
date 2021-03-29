<?php

namespace App\Entity;

use App\Repository\CryptoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CryptoRepository::class)
 */
class Crypto
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
    private $plateforme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=4, nullable=true)
     */
    private $qtt;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=4, nullable=true)
     */
    private $investissement;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=4, nullable=true)
     */
    private $current_price;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=4, nullable=true)
     */
    private $market_cap;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=4, nullable=true)
     */
    private $actualValue;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=4, nullable=true)
     */
    private $actualBenefits;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlateforme(): ?string
    {
        return $this->plateforme;
    }

    public function setPlateforme(string $plateforme): self
    {
        $this->plateforme = $plateforme;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getQtt(): ?string
    {
        return $this->qtt;
    }

    public function setQtt(string $qtt): self
    {
        $this->qtt = $qtt;

        return $this;
    }

    public function getInvestissement(): ?string
    {
        return $this->investissement;
    }

    public function setInvestissement(string $investissement): self
    {
        $this->investissement = $investissement;

        return $this;
    }

    public function getCurrentPrice(): ?string
    {
        return $this->current_price;
    }

    public function setCurrentPrice(?string $current_price): self
    {
        $this->current_price = $current_price;

        return $this;
    }

    public function getMarketCap(): ?string
    {
        return $this->market_cap;
    }

    public function setMarketCap(?string $market_cap): self
    {
        $this->market_cap = $market_cap;

        return $this;
    }

    public function getActualValue(): ?string
    {
        return $this->actualValue;
    }

    public function setActualValue(?string $actualValue): self
    {
        $this->actualValue = $actualValue;

        return $this;
    }

    public function getActualBenefits(): ?string
    {
        return $this->actualBenefits;
    }

    public function setActualBenefits(?string $actualBenefits): self
    {
        $this->actualBenefits = $actualBenefits;

        return $this;
    }

    public function getIcone(): ?string
    {
        return $this->icone;
    }

    public function setIcone(?string $icone): self
    {
        $this->icone = $icone;

        return $this;
    }
}
