<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface DatatablesServiceInterface
{
    public function getData(string $repositoryName,Request $request, array $join): array;
}
