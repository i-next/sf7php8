<?php

namespace App\Service;

use App\Entity\User;


interface DashboardServiceInterface
{
    public function getDashboardData(): array;
}
