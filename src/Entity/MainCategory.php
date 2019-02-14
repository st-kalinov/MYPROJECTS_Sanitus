<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MainCategoryRepository")
 */
class MainCategory
{
    CONST MAIN_IMAGES_PATH = 'images/main_categories/';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $info;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $img;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $place;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubCategory", mappedBy="mainCategory")
     */
    private $subcategory;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="mainCategory")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="mainCategory")
     */
    private $products;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Brand", inversedBy="mainCategories")
     */
    private $brand;

    public function __construct()
    {
        $this->subcategory = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->brand = new ArrayCollection();
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

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getImagePath()
    {
        return self::MAIN_IMAGES_PATH.$this->getImg();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }


    /**
     * @return Collection|SubCategory[]
     */
    public function getSubcategory(): Collection
    {
        return $this->subcategory;
    }

    public function addSubcategory(SubCategory $subcategory): self
    {
        if (!$this->subcategory->contains($subcategory)) {
            $this->subcategory[] = $subcategory;
            $subcategory->setMainCategory($this);
        }

        return $this;
    }

    public function removeSubcategory(SubCategory $subcategory): self
    {
        if ($this->subcategory->contains($subcategory)) {
            $this->subcategory->removeElement($subcategory);
            // set the owning side to null (unless already changed)
            if ($subcategory->getMainCategory() === $this) {
                $subcategory->setMainCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
            $category->setMainCategory($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getMainCategory() === $this) {
                $category->setMainCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setMainCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getMainCategory() === $this) {
                $product->setMainCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Brand[]
     */
    public function getBrand(): Collection
    {
        return $this->brand;
    }

    public function addBrand(Brand $brand): self
    {
        if (!$this->brand->contains($brand)) {
            $this->brand[] = $brand;
        }

        return $this;
    }

    public function removeBrand(Brand $brand): self
    {
        if ($this->brand->contains($brand)) {
            $this->brand->removeElement($brand);
        }

        return $this;
    }

}
