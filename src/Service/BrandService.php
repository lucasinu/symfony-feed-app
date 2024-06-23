<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Brand;

class BrandService implements EntityServiceInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOrCreate(string $name): Brand
    {
        $brand = $this->entityManager->getRepository(Brand::class)->findOneBy(['name' => $name]);

        if (!$brand) {
            $brand = new Brand();
            $brand->setName($name);
            $this->entityManager->persist($brand);
            $this->entityManager->flush();
        }

        return $brand;
    }
}
