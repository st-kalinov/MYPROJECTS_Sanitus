<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\MainCategory;
use App\Entity\SubCategory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $categories = [
        'Кучета_Храни'=> ['Суха храна', 'Консервирана', 'Паучове и пастети'],
        'Кучета_Аксесоари' => ['Поводи и нагръдници', 'Купички и поставки', 'Легла', 'Намордници'],
        'Кучета_Козметика и грижа' => ['Витамини и добавки'],

        'Котки_Храни' => ['Суха храна', 'Консервирана', 'Органична храна'],
        'Котки_Аксесоари' => ['Купички и поставки', 'Драскалки и катерушки'],
        'Котки_Козметика и грижа' => ['Витамини и добавки', 'Противопаразитна защита'],

        'Риби_Храни' => ['Универсална храна за риби', 'Храна на люспи за риби'],
        'Риби_Аксесоари' => ['Препарати и стабилизатори за аквариуми'],
        'Риби_Акваристика' => ['Аквариуми', 'Поставки и шкафове за аквариуми'],

        'Птици_Храни' => ['Храна за средни папагали', 'Храна за големи папагали', 'Храна за вълнисти папагали'],
        'Птици_Аксесоари' => ['Волиери и клетки за папагали и птици', 'Хранили и Поилки за папагали и гълъби'],
    ];
    protected function loadData(ObjectManager $manager)
    {
       //$this->createManyAssociative(Category::class, self::$categoryNames, function (Category $category, $key, $associativeArr) use ($manager) {
       //    $category->setName($value);
       //    foreach ($associativeArr as $value) {

       //        $category->setSubcategory($this->getReference(SubCategory::class.'_'.$key));

       //    }
       //});
        foreach (self::$categories as $key => $arr) {
            $this->createManyAssociative(Category::class, $arr, function ($class, $value) use ($key) {
                $main_sub = explode('_', $key);
                $main = $this->getReference(MainCategory::class.'_'.$main_sub[0]);
                $sub = $this->getReference(SubCategory::class.'_'.$main_sub[0].'_'.$main_sub[1]);
                /**
                 * @var Category $class
                 */
                $class->setMainCategory($main);
                $class->setSubcategory($sub);
                $class->setName($value);
                $this->addReference(Category::class.'_'.$main_sub[0].'_'.$main_sub[1].'_'.$value, $class);
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
            SubCategoryFixtures::class,
        ];
    }
}
