<?php

namespace App\Entity;

enum EnumStates: string
{
    case GERM = 'Germination';
    case CROIS = 'Growths';
    case PREFLO = 'Preblooms';
    case FLO = 'Blooms';
    case REC = 'Harvests';

    public static function toArray(): array
    {
        $res = [];
        foreach(self::cases() as $type) {
            $res[$type->name] = $type->value;
        }
        return $res;
    }
}
