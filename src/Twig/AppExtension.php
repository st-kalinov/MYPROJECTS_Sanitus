<?php

namespace App\Twig;

use App\Entity\MainCategory;
use App\Repository\MainCategoryRepository;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends TwigExtension implements \Twig_Extension_GlobalsInterface
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
            new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }

    public function doSomething()
    {

    }

    /**
     * Returns a list of global variables to add to the existing list.
     *
     * @return array An array of global variables
     */
    public function getGlobals()
    {
        return [
          'mainCas' => ['asd', 'basd']
        ];
    }
}
