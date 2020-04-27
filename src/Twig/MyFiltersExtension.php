<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MyFiltersExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('addDaysFilter', [$this, 'addDays']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('addDays', [$this, 'addDays']),
        ];
    }

    public function addDays(int $days): string
    {
        $today = new \DateTime(strtotime(time()));
        $today->modify("+$days day");
        return '<h3>' . $today->format('d-m-Y H:i:s') . '<h3>';
    }
}
