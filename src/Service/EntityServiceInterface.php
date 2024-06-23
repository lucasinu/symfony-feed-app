<?php

namespace App\Service;

interface EntityServiceInterface
{
    public function findOrCreate(string $name): object;
}