<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $instock;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $info;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MainCategory", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mainCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategory", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="products")
     */
    private $brand;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductVariety", mappedBy="product")
     */
    private $productVarieties;

    public function __construct()
    {
        $this->productVarieties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getInStock(): ?bool
    {
        return $this->instock;
    }

    public function setInStock(bool $in_stock): self
    {
        $this->instock = $in_stock;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getMainCategory(): ?MainCategory
    {
        return $this->mainCategory;
    }

    public function setMainCategory(?MainCategory $mainCategory): self
    {
        $this->mainCategory = $mainCategory;

        return $this;
    }

    public function getSubCategory(): ?SubCategory
    {
        return $this->subCategory;
    }

    public function setSubCategory(?SubCategory $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function setAllCategories(?MainCategory $mainCategory, ?SubCategory $subCategory, ?Category $category): self
    {
        $this->mainCategory = $mainCategory;
        $this->subCategory = $subCategory;
        $this->category = $category;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|ProductVariety[]
     */
    public function getProductVarieties(): Collection
    {
        return $this->productVarieties;
    }

    public function addProductVariety(ProductVariety $productVariety): self
    {
        if (!$this->productVarieties->contains($productVariety)) {
            $this->productVarieties[] = $productVariety;
            $productVariety->setProduct($this);
        }

        return $this;
    }

    public function removeProductVariety(ProductVariety $productVariety): self
    {
        if ($this->productVarieties->contains($productVariety)) {
            $this->productVarieties->removeElement($productVariety);
            // set the owning side to null (unless already changed)
            if ($productVariety->getProduct() === $this) {
                $productVariety->setProduct(null);
            }
        }

        return $this;
    }

}
