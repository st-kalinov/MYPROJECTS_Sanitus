<?php

namespace App\DataFixtures;

use App\Entity\MainCategory;
use Doctrine\Common\Persistence\ObjectManager;

class MainCategoryFixtures extends BaseFixture
{
    private static $categoryNames = ['Кучета', 'Котки', 'Риби', 'Птици', 'Промоции', 'За нас', 'Контакти', 'Въпроси и отговори'];
    private static $categoryInfo =
        [
            "В Sanitus може да откриете всичко необходимо за Вашето куче. Погрижили сме се да има огромно разнообразие от здравословни и подходящи продукти за всеки сладък четириног косматко.",

            "В Sanitus  може да откриете всичко любимо за Вашата котка. Предлагаме здравословни храни, любими глезотии, разнообразни играчки и уютни и меки удобства за Вашата котка !",

            "В Sanitus ще намерите вашата сбъдната мечта. Разнообразие от аксесоари  за поддържане на аквариуми, храна за всеки вид рибка  и всичко останало, което е необходимо да поддържате хубав аквариум със здрави риби.",

            "В Sanitus ще откриете всичко необходимо за птици - от разнообразни вкусове храна според спецификата на тези красиви домашни любимци, поилки и хранилки, клетки с различна големини, до важните за тях витамини и минерали.",
            "",
            "",
            "",
            ""
        ];
    private static $categoryImg = ['dog_img.jpg', 'cat_img.jpg', 'fish_img.jpg', 'bird_img.jpg', 'promo_img.png', "", "", ""];
    private static $categoryPlace = ['nav', 'nav', 'nav', 'nav', 'nav', 'info', 'info', 'info'];


    public function loadData(ObjectManager $manager)
    {
        $itemsCount = count(self::$categoryNames);

        $this->createMany(MainCategory::class, $itemsCount, function (MainCategory $mainCategory, $i) use ($manager) {

            $mainCategory
                ->setName(self::$categoryNames[$i])
                ->setPlace(self::$categoryPlace[$i])
                ->setImg(self::$categoryImg[$i])
                ->setInfo(self::$categoryInfo[$i]);

            $this->addReference(MainCategory::class.'_'.self::$categoryNames[$i], $mainCategory);
        });

        $manager->flush();
    }

}
