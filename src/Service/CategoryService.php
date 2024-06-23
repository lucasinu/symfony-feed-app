<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;

class CategoryService implements EntityServiceInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOrCreate(string $name): Category
    {
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => $name]);

        if (!$category) {
            $category = new Category();
            $category->setName($name);
            $this->entityManager->persist($category);
            $this->entityManager->flush();
        }

        return $category;
    }
}
