<?php

namespace App\DataFixtures;

use App\Entity\MainCategory;
use App\Entity\SubCategory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SubCategoryFixtures extends BaseFixture implements DependentFixtureInterface
{
    //private static $subcategories = ['Марки', 'Храни', 'Аксесоари', 'Козметика и грижа', 'Акваристика'];
    private static $subCategories = [
        'Кучета' => ['Храни', 'Аксесоари', 'Козметика и грижа'],
        'Котки' => ['Храни', 'Аксесоари', 'Козметика и грижа'],
        'Риби' => ['Храни', 'Аксесоари', 'Акваристика'],
        'Птици' => ['Храни', 'Аксесоари'],
    ];

    public function loadData(ObjectManager $manager)
    {
        foreach (self::$subCategories as $main => $sub) {
            $this->createManyAssociative(SubCategory::class, $sub, function($class, $value) use ($main) {
                /**
                 * @var MainCategory $mainCat
                 */
                $mainCat = $this->getReference(MainCategory::class.'_'.$main);

                /**
                 * @var SubCategory $class
                 */
                $class->setMainCategory($mainCat);
                $class->setName($value);
                $this->addReference(SubCategory::class.'_'.$main.'_'.$value, $class);
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
        ];
    }
}
