<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductVariety;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProductVarietyFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $products = [
        'Royal Canin MAXI Joint and Coat Care' => [[12, 'кг.', 0, 114]],
        'Royal Canin Special Club Pro Energy HE' => [[20, 'кг.', 0, 124]],
        'Royal Canin Special Club Performance Adult' => [[15, 'кг.', 10, 89]],
        'Brit Mono Protein Lamb' => [[0.400, 'кг.', 0, 3.90]],
        'Brit Mono Protein Turkey' => [[0.400, 'кг.', 0, 3.90]],
        'Brit Pate and Meat Rabbit' => [[0.400, 'кг.', 0, 3.90], [1, 'кг.', 0, 8.50]],
        'Purina Pro Plan Duo Delice' => [[2.5, 'кг.', 5, 22.50]],
        'Purina Pro Plan Small and Mini Adult Optidigiest' => [[2.5, 'кг.', 0, 15.50], [4, 'кг.', 0, 22.50]],
        'Purina Pro Plan Dog Large Puppy Athletic' => [[12, 'кг.', 0, 96.10]], // Kucheta
        'Royal Canin Urinary Care' => [[10, 'кг.', 0, 147.20], [4, 'кг.', 0, 77], [2, 'кг.', 0, 42.60], [0.400, 'кг.', 0, 9.20]],
        'Royal Canin Oral Care' => [[8, 'кг.', 0, 123], [1.5, 'кг.', 0, 25.20], [0.400, 'кг.', 0, 9.20]],
        'Royal Canin Indoor 7' => [[3.5, 'кг.', 0, 45], [1.5, 'кг.', 0, 25]],
        'Orijen Cat Regional Red' => [[5.4, 'кг.', 0, 109.90]],
        'Orijen Six Fish for Cats' => [[5.4, 'кг.', 0, 105.90]],
        'Orijen Cat and Kitten' => [[5.4, 'кг.', 0, 105.90], [9, 'кг.', 0, 180.90]],
        'Brit Care Cat Chicken Breast' => [[0.8, 'кг.', 0, 2.90]],
        'Brit Care Chicken Breast and Cheese' => [[0.8, 'кг.', 0, 2.90], [2, 'кг.', 0, 6]],
        'Brit Care Kitten Chicken' => [[0.8, 'кг.', 0, 2.90], [2, 'кг.', 1, 6]], //Kotki
        'Tetra Natura Algae Block' => [[46, 'гр.', 0, 10.40]],
        'Tetra Pro Energy' => [[500, 'мл.', 0, 23.70]],
        'Tetra Pro Algae' => [[500, 'мл.', 0, 21.20]], //Ribi
    ];

    protected function loadData(ObjectManager $manager)
    {
        // TODO: Implement loadData() method.

        foreach (self::$products as $product => $varieties) {
            $this->createManyAssociative(ProductVariety::class, $varieties, function (ProductVariety $productVariety, $variety) use ($product) {
                /**
                 * @var Product $productObj
                 */
                $productObj = $this->getReference(Product::class . '_' . $product);

                $productVariety
                    ->setProduct($productObj)
                    ->setWeight($variety[0])
                    ->setWeightUnit($variety[1])
                    ->setPromotionCut($variety[2])
                    ->setPrice($variety[3]);
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
          ProductFixtures::class,
        ];
    }
}
