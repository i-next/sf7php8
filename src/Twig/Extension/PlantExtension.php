<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\PlantExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PlantExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_remain', [ PlantExtensionRuntime::class, 'remainDuration' ]),
            new TwigFunction('function_count', [ PlantExtensionRuntime::class, 'countPlant']),
            new TwigFunction('function_step', [ PlantExtensionRuntime::class, 'stepPlant']),
            new twigFunction('function_days_remained',[ PlantExtensionRuntime::class, 'getDaysRemained']),
        ];
    }
}
