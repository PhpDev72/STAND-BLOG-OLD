<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('active', [$this, 'active']),
            new TwigFunction('pluralize', [$this, 'pluralize']),
            new TwigFunction('col_12', [$this, 'col_12'])
        ];
    }

    public function active(string $route, string $value)
    {
        echo $route === $value ? "active" : "";
    }

    //fonction appelée et exécutée par la fonction pluralize
    public function pluralize(int $count, string $singular)
    {

        $plural = $singular . 's';

        $str = $count === 1 ? $singular : $plural;
        return "$count $str";
    }

    public function col_12(string $route, string $value)
    {

        echo $route === $value ? "col-12" : "col-lg-8";
    }
}
