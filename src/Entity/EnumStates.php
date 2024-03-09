<?php

namespace App\Entity;

enum EnumStates: string
{
    case GERM = 'Germination';
    case CROIS = 'Croissance';
    case PREFLO = 'Prefloraison';
    case FLO = 'Floraison';
    case REC = 'Recolte';

}
