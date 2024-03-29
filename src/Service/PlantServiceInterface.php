<?php

namespace App\Service;

use App\Entity\Plant;
use App\Entity\User;

interface PlantServiceInterface
{
    public function getCountByState();

    public function setDateFlo(Plant $plant): Plant;
}
