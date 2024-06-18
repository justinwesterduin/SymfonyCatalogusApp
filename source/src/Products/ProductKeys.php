<?php
declare(strict_types=1);

namespace App\Products;

class ProductKeys
{
    public function __construct(
        public int $id,
        public string $title,
        public float $price,
        public string $img,
        public string $category,
        public string $description
    )
    {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->img;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}