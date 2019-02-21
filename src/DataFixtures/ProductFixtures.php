<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\MainCategory;
use App\Entity\Product;
use App\Entity\SubCategory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $allCategories = [
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Консервирана',
        'Котки_Храни_Консервирана',
        'Котки_Храни_Консервирана',
        'Риби_Храни_Универсална храна за риби',
        'Риби_Храни_Универсална храна за риби',
        'Риби_Храни_Универсална храна за риби',

        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Консервирана',
        'Котки_Храни_Консервирана',
        'Котки_Храни_Консервирана',
        'Риби_Храни_Универсална храна за риби',
        'Риби_Храни_Универсална храна за риби',
        'Риби_Храни_Универсална храна за риби',

        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Консервирана',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Кучета_Храни_Суха храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Органична храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Суха храна',
        'Котки_Храни_Консервирана',
        'Котки_Храни_Консервирана',
        'Котки_Храни_Консервирана',
        'Риби_Храни_Универсална храна за риби',
        'Риби_Храни_Универсална храна за риби',
        'Риби_Храни_Универсална храна за риби',
    ];
    private static $names = [
        'Royal Canin MAXI Joint and Coat Care',
        'Royal Canin Special Club Pro Energy HE',
        'Royal Canin Special Club Performance Adult',
        'Brit Mono Protein Lamb',
        'Brit Mono Protein Turkey',
        'Brit Pate and Meat Rabbit',
        'Purina Pro Plan Duo Delice',
        'Purina Pro Plan Small and Mini Adult Optidigiest',
        'Purina Pro Plan Dog Large Puppy Athletic', // Kucheta
        'Royal Canin Urinary Care',
        'Royal Canin Oral Care',
        'Royal Canin Indoor 7',
        'Orijen Cat Regional Red',
        'Orijen Six Fish for Cats',
        'Orijen Cat and Kitten',
        'Brit Care Cat Chicken Breast',
        'Brit Care Chicken Breast and Cheese',
        'Brit Care Kitten Chicken', //Kotki
        'Tetra Natura Algae Block',
        'Tetra Pro Energy',
        'Tetra Pro Algae', //Ribi

        'Royal Canin MAXI Joint and Coat Care -v2',
        'Royal Canin Special Club Pro Energy HE -v2',
        'Royal Canin Special Club Performance Adult -v2',
        'Brit Mono Protein Lamb -v2',
        'Brit Mono Protein Turkey -v2',
        'Brit Pate and Meat Rabbit -v2',
        'Purina Pro Plan Duo Delice -v2',
        'Purina Pro Plan Small and Mini Adult Optidigiest -v2',
        'Purina Pro Plan Dog Large Puppy Athletic -v2', // Kucheta
        'Royal Canin Urinary Care -v2',
        'Royal Canin Oral Care -v2',
        'Royal Canin Indoor 7 -v2',
        'Orijen Cat Regional Red -v2',
        'Orijen Six Fish for Cats -v2',
        'Orijen Cat and Kitten -v2',
        'Brit Care Cat Chicken Breast -v2',
        'Brit Care Chicken Breast and Cheese -v2',
        'Brit Care Kitten Chicken -v2', //Kotki
        'Tetra Natura Algae Block -v2',
        'Tetra Pro Energy -v2',
        'Tetra Pro Algae -v2', //Ribi

        'Royal Canin MAXI Joint and Coat Care -v3',
        'Royal Canin Special Club Pro Energy HE -v3',
        'Royal Canin Special Club Performance Adult -v3',
        'Brit Mono Protein Lamb -v3',
        'Brit Mono Protein Turkey -v3',
        'Brit Pate and Meat Rabbit -v3',
        'Purina Pro Plan Duo Delice -v3',
        'Purina Pro Plan Small and Mini Adult Optidigiest -v3',
        'Purina Pro Plan Dog Large Puppy Athletic -v3', // Kucheta
        'Royal Canin Urinary Care -v3',
        'Royal Canin Oral Care -v3',
        'Royal Canin Indoor 7 -v3',
        'Orijen Cat Regional Red -v3',
        'Orijen Six Fish for Cats -v3',
        'Orijen Cat and Kitten -v3',
        'Brit Care Cat Chicken Breast -v3',
        'Brit Care Chicken Breast and Cheese -v3',
        'Brit Care Kitten Chicken -v3', //Kotki
        'Tetra Natura Algae Block -v3',
        'Tetra Pro Energy -v3',
        'Tetra Pro Algae -v3', //Ribi
        ];
    private static $info = [
        'Πopaди тeмпepaмeнтa и гoлямaтa cи тeлecнa мaca ĸyчeтaтa oт eдpи пopoди c тeглo 26 – 44 ĸг ca пoдлoжeни нa изĸлючитeлнo cилнo нaтoвapвaнe нa cтaвитe.',
        'Високо енергийна, пълноценна суха храна под формата на гранули, предназначена предимно за много активни, пораснали кучета.',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Хрускането на специалните гранули действа като четка за зъби, което спомага намаляването на зъбния камък.',
        'Суха храна за кучета в зряла възраст от дробни и мини породи специално подбрана за чувствително храносмилане с вкус на пиле.',
        'Суха храна за малки /2-18 месеца/ кученца от едри и гигантски породи с вкус на пиле.',
        'Основна храна за пораснали котки, за здравето на уринарния тракт, срещу камъни в пикочния мехур и други заболявания',
        'Royal Canin Oral Care - храна за котки за поддържане на хигиена на зъбите.',
        'Пълноценна и балансирана храна за котки в напреднала възраст /над 7 години/ .',
        'Orijen Cat Regional Red e здравословна храна за котки без съдържание на зърнени култури.',
        'Храна за котки, с по-голямо съдържание на протеини, с по-малко съдържание на въглехидрати, без зърнено-житни култури.',
        'Суха храна за малки котета и котки в напреднала възраст, с вкус на пиле, пуешко и риба, с високо съдържание на протеини, без зърнено-житни култури.',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Натурална храна за декоративни тропически рибки без консерванти и оцветители',
        'Премиум храна за декоративни тропически рибки',
        'Висококачествена премиум храна за всякакви декоративни рибки',

        'Πopaди тeмпepaмeнтa и гoлямaтa cи тeлecнa мaca ĸyчeтaтa oт eдpи пopoди c тeглo 26 – 44 ĸг ca пoдлoжeни нa изĸлючитeлнo cилнo нaтoвapвaнe нa cтaвитe.',
        'Високо енергийна, пълноценна суха храна под формата на гранули, предназначена предимно за много активни, пораснали кучета.',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Хрускането на специалните гранули действа като четка за зъби, което спомага намаляването на зъбния камък.',
        'Суха храна за кучета в зряла възраст от дробни и мини породи специално подбрана за чувствително храносмилане с вкус на пиле.',
        'Суха храна за малки /2-18 месеца/ кученца от едри и гигантски породи с вкус на пиле.',
        'Основна храна за пораснали котки, за здравето на уринарния тракт, срещу камъни в пикочния мехур и други заболявания',
        'Royal Canin Oral Care - храна за котки за поддържане на хигиена на зъбите.',
        'Пълноценна и балансирана храна за котки в напреднала възраст /над 7 години/ .',
        'Orijen Cat Regional Red e здравословна храна за котки без съдържание на зърнени култури.',
        'Храна за котки, с по-голямо съдържание на протеини, с по-малко съдържание на въглехидрати, без зърнено-житни култури.',
        'Суха храна за малки котета и котки в напреднала възраст, с вкус на пиле, пуешко и риба, с високо съдържание на протеини, без зърнено-житни култури.',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Натурална храна за декоративни тропически рибки без консерванти и оцветители',
        'Премиум храна за декоративни тропически рибки',
        'Висококачествена премиум храна за всякакви декоративни рибки',

        'Πopaди тeмпepaмeнтa и гoлямaтa cи тeлecнa мaca ĸyчeтaтa oт eдpи пopoди c тeглo 26 – 44 ĸг ca пoдлoжeни нa изĸлючитeлнo cилнo нaтoвapвaнe нa cтaвитe.',
        'Високо енергийна, пълноценна суха храна под формата на гранули, предназначена предимно за много активни, пораснали кучета.',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Хрускането на специалните гранули действа като четка за зъби, което спомага намаляването на зъбния камък.',
        'Суха храна за кучета в зряла възраст от дробни и мини породи специално подбрана за чувствително храносмилане с вкус на пиле.',
        'Суха храна за малки /2-18 месеца/ кученца от едри и гигантски породи с вкус на пиле.',
        'Основна храна за пораснали котки, за здравето на уринарния тракт, срещу камъни в пикочния мехур и други заболявания',
        'Royal Canin Oral Care - храна за котки за поддържане на хигиена на зъбите.',
        'Пълноценна и балансирана храна за котки в напреднала възраст /над 7 години/ .',
        'Orijen Cat Regional Red e здравословна храна за котки без съдържание на зърнени култури.',
        'Храна за котки, с по-голямо съдържание на протеини, с по-малко съдържание на въглехидрати, без зърнено-житни култури.',
        'Суха храна за малки котета и котки в напреднала възраст, с вкус на пиле, пуешко и риба, с високо съдържание на протеини, без зърнено-житни култури.',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Балансиран състав и оптимална енергийна стойност',
        'Натурална храна за декоративни тропически рибки без консерванти и оцветители',
        'Премиум храна за декоративни тропически рибки',
        'Висококачествена премиум храна за всякакви декоративни рибки',
        ];
    private static $instock = [
        1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,
        1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,
        1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,
        ];
    private static $img = [
        'RoyalCanin_MaxiJointCate.jpg',
        'RoyalCanin_SpecialClubProEnergyHE.jpg',
        'RoyalCanin_SpecialClubPerformanceAdult.jpg',
        'Brit_MonoProteinLamb.png',
        'Brit_MonoProteinTurkey.jpg',
        'Brit_PateAndMeatRabbit.jpg',
        'PurinaProPlan_DuoDelice.jpg',
        'PurinaProPlan_SmallAndMiniAdultOptidigiest.jpg',
        'PurinaProPlan_DogLargePuppyAthletic.jpg',
        'RoyalCanin_UrinaryCare.jpg',
        'RoyalCanin_OralCare.jpg',
        'RoyalCanin_Indoor7.jpeg',
        'Orijen_CatRegionalRed.jpg',
        'Orijen_SixFishForCats.jpg',
        'Orijen_CatAndKitten.jpg',
        'Brit_CareCatChickenBreast.png',
        'Brit_CareChickenBreastAndCheese.jpg',
        'Brit_CareKittenChicken.png',
        'Tetra_NaturaAlgaeBlock.jpg',
        'Tetra_ProEnergy.jpg',
        'Tetra_ProAlgae.jpg',

        'RoyalCanin_MaxiJointCate.jpg',
        'RoyalCanin_SpecialClubProEnergyHE.jpg',
        'RoyalCanin_SpecialClubPerformanceAdult.jpg',
        'Brit_MonoProteinLamb.png',
        'Brit_MonoProteinTurkey.jpg',
        'Brit_PateAndMeatRabbit.jpg',
        'PurinaProPlan_DuoDelice.jpg',
        'PurinaProPlan_SmallAndMiniAdultOptidigiest.jpg',
        'PurinaProPlan_DogLargePuppyAthletic.jpg',
        'RoyalCanin_UrinaryCare.jpg',
        'RoyalCanin_OralCare.jpg',
        'RoyalCanin_Indoor7.jpeg',
        'Orijen_CatRegionalRed.jpg',
        'Orijen_SixFishForCats.jpg',
        'Orijen_CatAndKitten.jpg',
        'Brit_CareCatChickenBreast.png',
        'Brit_CareChickenBreastAndCheese.jpg',
        'Brit_CareKittenChicken.png',
        'Tetra_NaturaAlgaeBlock.jpg',
        'Tetra_ProEnergy.jpg',
        'Tetra_ProAlgae.jpg',

        'RoyalCanin_MaxiJointCate.jpg',
        'RoyalCanin_SpecialClubProEnergyHE.jpg',
        'RoyalCanin_SpecialClubPerformanceAdult.jpg',
        'Brit_MonoProteinLamb.png',
        'Brit_MonoProteinTurkey.jpg',
        'Brit_PateAndMeatRabbit.jpg',
        'PurinaProPlan_DuoDelice.jpg',
        'PurinaProPlan_SmallAndMiniAdultOptidigiest.jpg',
        'PurinaProPlan_DogLargePuppyAthletic.jpg',
        'RoyalCanin_UrinaryCare.jpg',
        'RoyalCanin_OralCare.jpg',
        'RoyalCanin_Indoor7.jpeg',
        'Orijen_CatRegionalRed.jpg',
        'Orijen_SixFishForCats.jpg',
        'Orijen_CatAndKitten.jpg',
        'Brit_CareCatChickenBreast.png',
        'Brit_CareChickenBreastAndCheese.jpg',
        'Brit_CareKittenChicken.png',
        'Tetra_NaturaAlgaeBlock.jpg',
        'Tetra_ProEnergy.jpg',
        'Tetra_ProAlgae.jpg',
        ];
    private static $brands = [
        'Royal Canin',
        'Royal Canin',
        'Royal Canin',
        'Brit',
        'Brit',
        'Brit',
        'Purina Pro Plan',
        'Purina Pro Plan',
        'Purina Pro Plan',
        'Royal Canin',
        'Royal Canin',
        'Royal Canin',
        'Orijen',
        'Orijen',
        'Orijen',
        'Brit',
        'Brit',
        'Brit',
        'Tetra',
        'Tetra',
        'Tetra',

        'Royal Canin',
        'Royal Canin',
        'Royal Canin',
        'Brit',
        'Brit',
        'Brit',
        'Purina Pro Plan',
        'Purina Pro Plan',
        'Purina Pro Plan',
        'Royal Canin',
        'Royal Canin',
        'Royal Canin',
        'Orijen',
        'Orijen',
        'Orijen',
        'Brit',
        'Brit',
        'Brit',
        'Tetra',
        'Tetra',
        'Tetra',

        'Royal Canin',
        'Royal Canin',
        'Royal Canin',
        'Brit',
        'Brit',
        'Brit',
        'Purina Pro Plan',
        'Purina Pro Plan',
        'Purina Pro Plan',
        'Royal Canin',
        'Royal Canin',
        'Royal Canin',
        'Orijen',
        'Orijen',
        'Orijen',
        'Brit',
        'Brit',
        'Brit',
        'Tetra',
        'Tetra',
        'Tetra',
        ];

    protected function loadData(ObjectManager $manager)
    {
        $itemsCount = count(self::$allCategories);
        $this->createMany(Product::class, $itemsCount, function (Product $product, $i) use ($manager) {
           $allCategories = explode('_', self::$allCategories[$i]);

            /**
             * @var MainCategory $mainCategory
             */
           $mainCategory = $this->getReference(MainCategory::class.'_'.$allCategories[0]);
            /**
             * @var SubCategory $subCategory
             */
           $subCategory = $this->getReference(SubCategory::class.'_'.$allCategories[0].'_'.$allCategories[1]);
            /**
             * @var Category $category
             */
           $category = $this->getReference(Category::class.'_'.$allCategories[0].'_'.$allCategories[1].'_'.$allCategories[2]);
            /**
             * @var Brand $brand
             */
           $brand = $this->getReference(Brand::class.'_'.self::$brands[$i]);

           $product->setAllCategories($mainCategory, $subCategory, $category);
           $product->setName(self::$names[$i])
               ->setInStock(self::$instock[$i])
               ->setInfo(self::$info[$i])
               ->setImg(self::$img[$i])
               ->setBrand($brand);

           $this->addReference(Product::class.'_'.self::$names[$i], $product);
        });

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
          CategoryFixtures::class,
            BrandFixtures::class,
        ];
    }
}
