<?php

namespace App\Service;

interface AutoCompleteServiceInterface
{
    public function getStrainsQuery(array $data):array;
}
