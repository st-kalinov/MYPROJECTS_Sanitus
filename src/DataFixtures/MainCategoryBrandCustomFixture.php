<?php
/**
 * Created by PhpStorm.
 * User: STOYO
 * Date: 28.1.2019 г.
 * Time: 15:41 ч.
 */

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\MainCategory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MainCategoryBrandCustomFixture extends BaseFixture implements DependentFixtureInterface
{

    private static $brands = [
        'Кучета' => ['Royal Canin', 'Brit', 'Purina Pro Plan', 'Pedigree', 'Ferplast', 'My Dog'],
        'Котки' => ['Royal Canin', 'Brit', 'Purina Pro Plan', 'Orijen', 'Ferplast', 'Croci', 'Ebi-vet', 'Trixie'],
        'Риби' => ['Tetra', 'Sera', 'JBL', 'Croci'],
        'Птици' => ['Versele', 'Padovan', 'Trixie', 'Ferplast']
    ];

    protected function loadData(ObjectManager $manager)
    {

        foreach (self::$brands as $mainCat => $brands) {
            $this->createManyAssociativeCustom(MainCategory::class, Brand::class, $mainCat, $brands, function (MainCategory $mainCategory, Brand $brand) {
                $mainCategory->addBrand($brand);
            });
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            MainCategoryFixtures::class,
            BrandFixtures::class
        ];
    }
}