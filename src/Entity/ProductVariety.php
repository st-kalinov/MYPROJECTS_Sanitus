<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductVarietyRepository")
 */
class ProductVariety
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productVarieties")
     */
    private $product;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=4)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $weightUnit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $promotionCut;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $finalPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeightUnit(): ?string
    {
        return $this->weightUnit;
    }

    public function setWeightUnit(string $weightUnit): self
    {
        $this->weightUnit = $weightUnit;

        return $this;
    }

    public function getPromotionCut()
    {
        return $this->promotionCut;
    }

    public function setPromotionCut($promotionCut): self
    {
        $this->promotionCut = $promotionCut;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFinalPrice()
    {
        return $this->finalPrice;
    }

    public function setFinalPrice($finalPrice): self
    {
        $this->finalPrice = $finalPrice;

        return $this;
    }
}
