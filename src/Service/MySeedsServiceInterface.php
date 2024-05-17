<?php

namespace App\Service;

use App\Entity\MySeeds;

interface MySeedsServiceInterface
{
    public function create(array $data, MySeeds $mySeeds): MySeeds|bool;

    public function changeqty(array $data): int;
    public function changecomment(array $data): string;
}
