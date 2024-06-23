<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $external_id = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $sku = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?float $rating = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $caffeine_type = null;

    #[ORM\Column(nullable: true)]
    private ?bool $flavored = null;

    #[ORM\Column(nullable: true)]
    private ?bool $seasonal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $in_stock = null;

    #[ORM\Column(nullable: true)]
    private ?bool $facebook = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_k_cup = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $short_description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $brand_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $category_id = null;

    #[ORM\ManyToOne]
    private ?Brand $brand = null;

    #[ORM\ManyToOne]
    private ?Category $category = null;

    #[ORM\Column(nullable: true)]
    private ?float $count = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isNew(): bool
    {
        return $this->id === null;
    }

    public function getExternalId(): ?int
    {
        return $this->external_id;
    }

    public function setExternalId(int $external_id): static
    {
        $this->external_id = $external_id;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCaffeineType(): ?string
    {
        return $this->caffeine_type;
    }

    public function setCaffeineType(?string $caffeine_type): static
    {
        $this->caffeine_type = $caffeine_type;

        return $this;
    }

    public function isFlavored(): ?bool
    {
        return $this->flavored;
    }

    public function setFlavored(?bool $flavored): static
    {
        $this->flavored = $flavored;

        return $this;
    }

    public function isSeasonal(): ?bool
    {
        return $this->seasonal;
    }

    public function setSeasonal(?bool $seasonal): static
    {
        $this->seasonal = $seasonal;

        return $this;
    }

    public function isInStock(): ?bool
    {
        return $this->in_stock;
    }

    public function setInStock(?bool $in_stock): static
    {
        $this->in_stock = $in_stock;

        return $this;
    }

    public function isfacebook(): ?bool
    {
        return $this->facebook;
    }

    public function setfacebook(?bool $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function isKCup(): ?bool
    {
        return $this->is_k_cup;
    }

    public function setKCup(?bool $is_k_cup): static
    {
        $this->is_k_cup = $is_k_cup;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): static
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBrandId(): ?int
    {
        return $this->brand_id;
    }

    public function setBrandId(?int $brand_id): static
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCount(): ?float
    {
        return $this->count;
    }

    public function setCount(?float $count): static
    {
        $this->count = $count;

        return $this;
    }
}
