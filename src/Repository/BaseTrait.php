<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;

trait BaseTrait
{
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('q');
    }
}
