<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use App\Service\BrandService;
use App\Service\CategoryService;
use SimpleXMLElement;

class ProductService
{
    private $entityManager;
    private $brandService;
    private $categoryService;

    public function __construct(
        EntityManagerInterface $entityManager,
        BrandService $brandService,
        CategoryService $categoryService
    ) {
        $this->entityManager = $entityManager;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
    }

    public function processProduct(SimpleXMLElement $node): Product
    {
        // Check if the product exists to avoid duplicates
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['external_id' => (int)$node->entity_id]) ?? new Product();

        // Updating all the product's attributes
        $product->setExternalId((int)$node->entity_id);
        $product->setSku((string)$node->sku);
        $product->setName((string)$node->name);
        $product->setPrice((float)$node->price);
        $product->setLink((string)$node->link);
        $product->setImage((string)$node->image);
        $product->setRating((float)$node->Rating);
        $product->setCount((float)$node->Count);
        $product->setCaffeineType((string)$node->CaffeineType);
        $product->setFlavored((bool)filter_var($node->Flavored, FILTER_VALIDATE_BOOLEAN));
        $product->setSeasonal((bool)filter_var($node->Seasonal, FILTER_VALIDATE_BOOLEAN));
        $product->setInStock((bool)filter_var($node->Instock, FILTER_VALIDATE_BOOLEAN));
        $product->setFacebook((bool)filter_var($node->Facebook, FILTER_VALIDATE_BOOLEAN));
        $product->setKCup((bool)filter_var($node->IsKCup, FILTER_VALIDATE_BOOLEAN));
        $product->setShortDescription((string)$node->shortdesc);
        $product->setDescription((string)$node->description);

        return $product;
    }

    public function processProductNode(SimpleXMLElement $node, &$logData, &$newItems): Product
    {
        $product = $this->processProduct($node);
        $isNew = $product->isNew();

        if ((string)$node->Brand !== '') {
            $brand = $this->brandService->findOrCreate((string)$node->Brand);
            if ($brand->getId()) {
                $product->setBrand($brand);
            } else {
                $logData[] = ['import', 'error', 'brand', $brand->getName(), json_encode($brand->getErrors())];
                print_r('Brand with name "' . $brand->getName() . '" not saved! See the log file for further information.');
            }
        }

        if ((string)$node->CategoryName !== '') {
            $category = $this->categoryService->findOrCreate((string)$node->CategoryName);
            if ($category->getId()) {
                $product->setCategory($category);
            } else {
                $logData[] = ['import', 'error', 'category', $category->getName(), json_encode($category->getErrors())];
                print_r('Category with name "' . $category->getName() . '" not saved! See the log file for further information.');
            }
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();
        $this->entityManager->clear();

        $logData[] = ['import', 'info', 'product', $product->getExternalId(), 'Product ' . ($isNew ? 'added!' : 'updated!')];
        if ($isNew) {
            $newItems++;
        }

        return $product;
    }
}
