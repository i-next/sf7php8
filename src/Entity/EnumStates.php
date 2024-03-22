<?php

namespace App\Entity;

enum EnumStates: string
{
    case GERM = 'Germination';
    case CROIS = 'Croissance';
    case PREFLO = 'Prefloraison';
    case FLO = 'Floraison';
    case REC = 'Recolte';

    public static function toArray(): array
    {
        $res = [];
        foreach(self::cases() as $type){
            $res[$type->name] = $type->value;
        }
        return $res;
    }
}
