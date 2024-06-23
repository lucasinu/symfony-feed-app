<?php

namespace App\Service;

interface ProductServiceInterface
{
    public function processProduct(SimpleXMLElement $node): Product;
    public function processProductNode(SimpleXMLElement $node, &$logData, &$newItems): Product;
}