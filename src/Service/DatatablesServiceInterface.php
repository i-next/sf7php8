<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface DatatablesServiceInterface
{
    public function getData(string $repositoryName, Request $request, array $join): array;

    public function formatData(array $data, Request $request): array;
}
