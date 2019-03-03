<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Common\Persistence\ObjectManager;

class BrandFixtures extends BaseFixture
{
    private static $brands = ['Royal Canin', 'Brit', 'Purina Pro Plan', 'Pedigree', 'Orijen', 'Ferplast', 'Trixie', 'Versele', 'Padovan', 'Ebi-vet', 'Sera', 'Croci', 'JBL', 'My Dog', 'Tetra'];
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Brand::class, count(self::$brands), function (Brand $brand, $i) {
           $brand->setName(self::$brands[$i]);

           $this->addReference(Brand::class.'_'.self::$brands[$i], $brand);
        });
        $manager->flush();
    }
}
