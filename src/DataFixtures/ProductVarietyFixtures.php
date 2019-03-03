<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductVariety;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProductVarietyFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $products = [
        'Royal Canin MAXI Joint and Coat Care' => [[12, 'кг.', 5, 114]],
        'Royal Canin Special Club Pro Energy HE' => [[20, 'кг.', 0, 124]],
        'Royal Canin Special Club Performance Adult' => [[15, 'кг.', 10, 89]],
        'Brit Mono Protein Lamb' => [[0.400, 'кг.', 0, 3.90]],
        'Brit Mono Protein Turkey' => [[0.400, 'кг.', 1, 3.90]],
        'Brit Pate and Meat Rabbit' => [[0.400, 'кг.', 0, 3.90], [1, 'кг.', 0, 8.50]],
        'Purina Pro Plan Duo Delice' => [[2.5, 'кг.', 5, 22.50]],
        'Purina Pro Plan Small and Mini Adult Optidigiest' => [[2.5, 'кг.', 0, 15.50], [4, 'кг.', 0, 22.50]],
        'Purina Pro Plan Dog Large Puppy Athletic' => [[12, 'кг.', 0, 96.10]], // Kucheta
        'Royal Canin Urinary Care' => [[10, 'кг.', 0, 147.20], [4, 'кг.', 0, 77], [2, 'кг.', 0, 42.60], [0.400, 'кг.', 0, 9.20]],
        'Royal Canin Oral Care' => [[8, 'кг.', 0, 123], [1.5, 'кг.', 0, 25.20], [0.400, 'кг.', 0, 9.20]],
        'Royal Canin Indoor 7' => [[3.5, 'кг.', 3, 45], [1.5, 'кг.', 0, 25]],
        'Orijen Cat Regional Red' => [[5.4, 'кг.', 0, 109.90]],
        'Orijen Six Fish for Cats' => [[5.4, 'кг.', 6, 105.90]],
        'Orijen Cat and Kitten' => [[5.4, 'кг.', 1, 105.90], [9, 'кг.', 0, 180.90]],
        'Brit Care Cat Chicken Breast' => [[0.8, 'кг.', 0, 2.90]],
        'Brit Care Chicken Breast and Cheese' => [[0.8, 'кг.', 0, 2.90], [2, 'кг.', 0, 6]],
        'Brit Care Kitten Chicken' => [[0.8, 'кг.', 0, 2.90], [2, 'кг.', 1, 6]], //Kotki
        'Tetra Natura Algae Block' => [[46, 'гр.', 2, 10.40]],
        'Tetra Pro Energy' => [[500, 'мл.', 1, 23.70]],
        'Tetra Pro Algae' => [[500, 'мл.', 0, 21.20]], //Ribi

        'Royal Canin MAXI Joint and Coat Care -v2' => [[12, 'кг.', 5, 114]],
        'Royal Canin Special Club Pro Energy HE -v2' => [[20, 'кг.', 0, 124]],
        'Royal Canin Special Club Performance Adult -v2' => [[15, 'кг.', 10, 89]],
        'Brit Mono Protein Lamb -v2' => [[0.400, 'кг.', 0, 3.90]],
        'Brit Mono Protein Turkey -v2' => [[0.400, 'кг.', 1, 3.90]],
        'Brit Pate and Meat Rabbit -v2' => [[0.400, 'кг.', 0, 3.90], [1, 'кг.', 0, 8.50]],
        'Purina Pro Plan Duo Delice -v2' => [[2.5, 'кг.', 5, 22.50]],
        'Purina Pro Plan Small and Mini Adult Optidigiest -v2' => [[2.5, 'кг.', 0, 15.50], [4, 'кг.', 0, 22.50]],
        'Purina Pro Plan Dog Large Puppy Athletic -v2' => [[12, 'кг.', 0, 96.10]], // Kucheta
        'Royal Canin Urinary Care -v2' => [[10, 'кг.', 0, 147.20], [4, 'кг.', 0, 77], [2, 'кг.', 0, 42.60], [0.400, 'кг.', 0, 9.20]],
        'Royal Canin Oral Care -v2' => [[8, 'кг.', 0, 123], [1.5, 'кг.', 0, 25.20], [0.400, 'кг.', 0, 9.20]],
        'Royal Canin Indoor 7 -v2' => [[3.5, 'кг.', 3, 45], [1.5, 'кг.', 0, 25]],
        'Orijen Cat Regional Red -v2' => [[5.4, 'кг.', 0, 109.90]],
        'Orijen Six Fish for Cats -v2' => [[5.4, 'кг.', 6, 105.90]],
        'Orijen Cat and Kitten -v2' => [[5.4, 'кг.', 1, 105.90], [9, 'кг.', 0, 180.90]],
        'Brit Care Cat Chicken Breast -v2' => [[0.8, 'кг.', 0, 2.90]],
        'Brit Care Chicken Breast and Cheese -v2' => [[0.8, 'кг.', 0, 2.90], [2, 'кг.', 0, 6]],
        'Brit Care Kitten Chicken -v2' => [[0.8, 'кг.', 0, 2.90], [2, 'кг.', 1, 6]], //Kotki
        'Tetra Natura Algae Block -v2' => [[46, 'гр.', 2, 10.40]],
        'Tetra Pro Energy -v2' => [[500, 'мл.', 1, 23.70]],
        'Tetra Pro Algae -v2' => [[500, 'мл.', 0, 21.20]], //Ribi

        'Royal Canin MAXI Joint and Coat Care -v3' => [[12, 'кг.', 5, 114]],
        'Royal Canin Special Club Pro Energy HE -v3' => [[20, 'кг.', 0, 124]],
        'Royal Canin Special Club Performance Adult -v3' => [[15, 'кг.', 10, 89]],
        'Brit Mono Protein Lamb -v3' => [[0.400, 'кг.', 0, 3.90]],
        'Brit Mono Protein Turkey -v3' => [[0.400, 'кг.', 1, 3.90]],
        'Brit Pate and Meat Rabbit -v3' => [[0.400, 'кг.', 0, 3.90], [1, 'кг.', 0, 8.50]],
        'Purina Pro Plan Duo Delice -v3' => [[2.5, 'кг.', 5, 22.50]],
        'Purina Pro Plan Small and Mini Adult Optidigiest -v3' => [[2.5, 'кг.', 0, 15.50], [4, 'кг.', 0, 22.50]],
        'Purina Pro Plan Dog Large Puppy Athletic -v3' => [[12, 'кг.', 0, 96.10]], // Kucheta
        'Royal Canin Urinary Care -v3' => [[10, 'кг.', 0, 147.20], [4, 'кг.', 0, 77], [2, 'кг.', 0, 42.60], [0.400, 'кг.', 0, 9.20]],
        'Royal Canin Oral Care -v3' => [[8, 'кг.', 0, 123], [1.5, 'кг.', 0, 25.20], [0.400, 'кг.', 0, 9.20]],
        'Royal Canin Indoor 7 -v3' => [[3.5, 'кг.', 3, 45], [1.5, 'кг.', 0, 25]],
        'Orijen Cat Regional Red -v3' => [[5.4, 'кг.', 0, 109.90]],
        'Orijen Six Fish for Cats -v3' => [[5.4, 'кг.', 6, 105.90]],
        'Orijen Cat and Kitten -v3' => [[5.4, 'кг.', 1, 105.90], [9, 'кг.', 0, 180.90]],
        'Brit Care Cat Chicken Breast -v3' => [[0.8, 'кг.', 0, 2.90]],
        'Brit Care Chicken Breast and Cheese -v3' => [[0.8, 'кг.', 0, 2.90], [2, 'кг.', 0, 6]],
        'Brit Care Kitten Chicken -v3' => [[0.8, 'кг.', 0, 2.90], [2, 'кг.', 1, 6]], //Kotki
        'Tetra Natura Algae Block -v3' => [[46, 'гр.', 2, 10.40]],
        'Tetra Pro Energy -v3' => [[500, 'мл.', 1, 23.70]],
        'Tetra Pro Algae -v3' => [[500, 'мл.', 0, 21.20]], //Ribi
        'Pedigree Pouch Value Pack - пилешко и говеждо' => [[0.400, 'кг.', 0, 2.99]],
        'Pedigree Pouch Value Pack - телешко и пуешко' => [[0.100, 'кг.', 0, 0.79]],
        'Pedigree Pouch Junior Value Pack' => [[0.400, 'кг.', 0, 2.99]],
        'Pedigree Pouch Value Pack - пилешко и говеждо -v2' => [[0.400, 'кг.', 0.50, 2.99]],
        'Pedigree Pouch Value Pack - телешко и пуешко -v2' => [[0.100, 'кг.', 0, 0.79]],
        'Pedigree Pouch Junior Value Pack -v2' => [[0.400, 'кг.',  0, 2.99]],
        'Pedigree Pouch Value Pack - пилешко и говеждо -v3' => [[0.400, 'кг.', 0.70, 2.99]],
        'Pedigree Pouch Value Pack - телешко и пуешко -v3' => [[0.100, 'кг.', 0, 0.79]],
        'Pedigree Pouch Junior Value Pack -v3' => [[0.400, 'кг.', 0.30, 2.99]],

        'Ferplast Club G' => [[200, 'см.', 0, 23.90]],
        'Ferplast Easy Colours P Medium' => [[42, 'см', 0, 14.90]],
        'Ferplast Daytona G' => [[120, 'см', 0, 12.70]],
        'Ferplast Club G -v2' => [[200, 'см.', 3, 23.90]],
        'Ferplast Easy Colours P Medium -v2' => [[42, 'см', 1, 14.90]],
        'Ferplast Daytona G -v2' => [[120, 'см', 1, 12.70]],
        'Ferplast Club G -v3' => [[200, 'см.', 0, 23.90]],
        'Ferplast Easy Colours P Medium -v3' => [[42, 'см', 0, 14.90]],
        'Ferplast Daytona G -v3' => [[120, 'см', 0, 12.70]],
        'My Dog' => [['40x100', 'см', 0, 10.90]],
        'My Dog 10х100см' => [['10x100', 'см', 0, 3.90]],
        'My Dog 15х100см' => [['15x100', 'см', 0, 6.90]],
        'My Dog -v2' => [['40x100', 'см', 1, 10.90]],
        'My Dog 10х100см -v2' => [['10x100', 'см', 0.50, 3.90]],
        'My Dog 15х100см -v2' => [['15x100', 'см', 0, 6.90]],
        'My Dog -v3' => [['40x100', 'см', 2, 10.90]],
        'My Dog 10х100см -v3' => [['10x100', 'см', 0, 3.90]],
        'My Dog 15х100см -v3' => [['15x100', 'см', 1, 6.90]],
        'Ferplast Lindo' => [[800, 'мл', 0, 18.30]],
        'Ferplast Giove Bowl' => [[250, 'мл', 0, 7.20]],
        'Ferplast Venere Bowl' => [[150, 'мл', 0, 8.40], [300, 'мл', 0, 12.80], [500, 'мл', 0, 16.90]],
        'Ferplast Lindo -v2' => [[800, 'мл', 2, 18.30]],
        'Ferplast Giove Bowl -v2' => [[250, 'мл', 1, 7.20]],
        'Ferplast Venere Bowl -v2' => [[150, 'мл', 0, 8.40], [300, 'мл', 1, 12.80], [500, 'мл', 1.90, 16.90]],
        'Ferplast Lindo -v3' => [[800, 'мл', 2, 18.30]],
        'Ferplast Giove Bowl -v3' => [[250, 'мл', 1, 7.20]],
        'Ferplast Venere Bowl -v3' => [[150, 'мл', 0, 8.40], [300, 'мл', 1, 12.80], [500, 'мл', 1.90, 16.90]],
        'Trixie King' => [['55x45', 'см', 0, 105]],
        'Trixie Felicia' => [['40x35', 'см', 0, 68.60]],
        'Trixie Mat' => [['77x50', 'см', 0, 43.70]],
        'Trixie King -v2' => [['55x45', 'см', 0, 105]],
        'Trixie Felicia -v2' => [['40x35', 'см', 0, 68.60]],
        'Trixie Mat -v2' => [['77x50', 'см', 0, 43.70]],
        'Trixie King -v3' => [['55x45', 'см', 5, 105]],
        'Trixie Felicia -v3' => [['40x35', 'см', 2.60, 68.60]],
        'Trixie Mat -v3' => [['77x50', 'см', 2.70, 43.70]],
        'Ferplast Muzzle Safe Boxer' => [[10, 'см', 0, 27.90]],
        'Ferplast Muzzle Net XXL' => [[13, 'см', 0, 14.70]],
        'Ferplast Muzzle Net L' => [[7.50, 'см', 0, 13.90]],
        'Ferplast Muzzle Safe Boxer -v2' => [[10, 'см', 0, 27.90]],
        'Ferplast Muzzle Net XXL -v2' => [[13, 'см', 0, 14.70]],
        'Ferplast Muzzle Net L -v2' => [[7.50, 'см', 0, 13.90]],
        'Ferplast Muzzle Safe Boxer -v3' => [[10, 'см', 0, 27.90]],
        'Ferplast Muzzle Net XXL -v3' => [[13, 'см', 0, 14.70]],
        'Ferplast Muzzle Net L -v3' => [[7.50, 'см', 0, 13.90]],
        'Ebi-Vet Kalzium Pro Dog' => [[125, 'гр.', 0, 13.27]],
        'Ebi-Vet Aufbau Кalk' => [[125, 'гр.', 0, 21.90]],
        'Ebi-Vet Feel Vital Sirup Dog' => [[100, 'мл.', 0, 41.90]],
        'Ebi-Vet Kalzium Pro Dog -v2' => [[125, 'гр.', 0, 13.27]],
        'Ebi-Vet Aufbau Кalk -v2' => [[125, 'гр.', 0, 21.90]],
        'Ebi-Vet Feel Vital Sirup Dog -v2' => [[100, 'мл.', 0, 41.90]],
        'Ebi-Vet Kalzium Pro Dog -v3' => [[125, 'гр.', 0, 13.27]],
        'Ebi-Vet Aufbau Кalk -v3' => [[125, 'гр.', 0, 21.90]],
        'Ebi-Vet Feel Vital Sirup Dog -v3' => [[100, 'мл.', 0, 41.90]],

        'Ferplast Venere Medium' => [[300, 'мл.', 0, 12.90]],
        'Ferplast Venere Small' => [[150, 'мл.', 0, 8.40]],
        'Ferplast Cat Fountain Vega' => [[2, 'л.', 0, 83.80]],
        'Ferplast Venere Medium -v2' => [[300, 'мл.', 0, 12.90]],
        'Ferplast Venere Small -v2' => [[150, 'мл.', 1, 8.40]],
        'Ferplast Cat Fountain Vega -v2' => [[2, 'л.', 5.30, 83.80]],
        'Ferplast Venere Medium -v3' => [[300, 'мл.', 0, 12.90]],
        'Ferplast Venere Small -v3' => [[150, 'мл.', 1, 8.40]],
        'Ferplast Cat Fountain Vega -v3' => [[2, 'л.', 5.30, 83.80]],
        'Croci Naturally Tris' => [['20x60', 'см.', 0, 37.40]],
        'Croci' => [['30x60', 'см.', 0, 54.60]],
        'Croci Tiragraffi Sammy' => [['45x70', 'см.', 0, 85.80]],
        'Croci Naturally Tris -v2' => [['20x60', 'см.', 0, 37.40]],
        'Croci -v2' => [['30x60', 'см.', 0, 54.60]],
        'Croci Tiragraffi Sammy -v2' => [['45x70', 'см.', 0, 85.80]],
        'Croci Naturally Tris -v3' => [['20x60', 'см.', 0, 37.40]],
        'Croci -v3' => [['30x60', 'см.', 2.60, 54.60]],
        'Croci Tiragraffi Sammy -v3' => [['45x70', 'см.', 5.80, 85.80]],
        'Ebi-Vet Kalzium Pro Cat' => [[125, 'гр.', 0, 13.27]],
        'Ebi-Vet Feel Vital Sirup Cat' => [[100, 'мл.', 0, 41.90]],
        'Ebi-Vet Kalzium Pro Cat -v2' => [[125, 'гр.', 0, 13.27]],
        'Ebi-Vet Feel Vital Sirup Cat -v2' => [[100, 'мл.', 0, 41.90]],
        'Ebi-Vet Kalzium Pro Cat -v3' => [[125, 'гр.', 0, 13.27]],
        'Ebi-Vet Feel Vital Sirup Cat -v3' => [[100, 'мл.', 0, 41.90]],
        'Trixie Natural Parasite Collar' => [[35, 'см.', 0, 7.10]],
        'Trixie Paw Care Spray' => [[50, 'мл.', 0, 10.30]],
        'Trixie Natural Parasite Collar -v2' => [[35, 'см.', 0, 7.10]],
        'Trixie Paw Care Spray -v2' => [[50, 'мл.', 0, 10.30]],
        'Trixie Natural Parasite Collar -v3' => [[35, 'см.', 0, 7.10]],
        'Trixie Paw Care Spray -v3' => [[50, 'мл.', 0, 10.30]],

        'Sera Goldy' => [[10000, 'мл.', 0, 66.95]],
        'Sera Vipan' => [[12, 'гр.', 0, 1.35]],
        'Tetra Goldfish' => [[250, 'мл.', 0, 5.20]],
        'Tetra Goldfish Crisps' => [[100, 'мл.', 0, 3.50]],
        'Sera Goldy -v2' => [[10000, 'мл.',2, 66.95]],
        'Sera Vipan -v2' => [[12, 'гр.', 0, 1.35]],
        'Tetra Goldfish -v2' => [[250, 'мл.', 0, 5.20]],
        'Tetra Goldfish Crisps -v2' => [[100, 'мл.', 0, 3.50]],
        'Sera Goldy -v3' => [[10000, 'мл.',5, 66.95]],
        'Sera Vipan -v3' => [[12, 'гр.', 0, 1.35]],
        'Tetra Goldfish -v3' => [[250, 'мл.', 0, 5.20]],
        'Tetra Goldfish Crisps -v3' => [[100, 'мл.', 0, 3.50]],
        'JBL NitratEx' => [[250, 'мл.', 0, 32.40]],
        'JBL MicroMed' => [[650, 'гр.', 0, 25]],
        'JBL Punktol Plus' => [[100, 'мл.', 0, 13.40]],
        'JBL NitratEx -v2' => [[250, 'мл.', 2.40, 32.40]],
        'JBL MicroMed -v2' => [[650, 'гр.', 5, 25]],
        'JBL Punktol Plus -v2' => [[100, 'мл.', 0, 13.40]],
        'JBL NitratEx -v3' => [[250, 'мл.', 2.40, 32.40]],
        'JBL MicroMed -v3' => [[650, 'гр.', 2.50, 25]],
        'JBL Punktol Plus -v3' => [[100, 'мл.', 0, 13.40]],
        'Croci Spessore' => [[20, 'л.', 0, 67.90]],
        'Croci Star' => [[570, 'л.', 0, 3900.90]],
        'Croci Spessore -v2' => [[20, 'л.', 7.90, 67.90]],
        'Croci Star -v2' => [[570, 'л.', 100, 3900.90]],
        'Croci Spessore -v3' => [[20, 'л.', 7.90, 67.90]],
        'Croci Star -v3' => [[570, 'л.', 500, 3900.90]],
        'Versele Laga Orlux Lori' => [[3, 'кг.', 0, 76.60], [0.7, 'кг.', 0, 26.90]],
        'Versele Laga NutriBird G14 Original' => [[1, 'кг.', 0, 17.50]],
        'Versele Laga NutriBird G14 Tropical' => [[1, 'кг.', 0, 19]],
        'Versele Laga NutriBird A21' => [[3, 'кг.', 0, 87], [0.8, 'кг.', 0, 29.40]],
        'Versele Laga Orlux Lori -v2' => [[3, 'кг.', 0, 76.60], [0.7, 'кг.', 0, 26.90]],
        'Versele Laga NutriBird G14 Original -v2' => [[1, 'кг.', 0, 17.50]],
        'Versele Laga NutriBird G14 Tropical -v2' => [[1, 'кг.', 0, 19]],
        'Versele Laga NutriBird A21 -v2' => [[3, 'кг.', 0, 87], [0.8, 'кг.', 0, 29.40]],
        'Versele Laga Orlux Lori -v3' => [[3, 'кг.', 0, 76.60], [0.7, 'кг.', 0, 26.90]],
        'Versele Laga NutriBird G14 Original -v3' => [['1', 'кг.', 2.50, 17.50]],
        'Versele Laga NutriBird G14 Tropical -v3' => [['1', 'кг.', 2, 19]],
        'Versele Laga NutriBird A21 -v3' => [['3', 'кг.', 0, 87], [0.8, 'кг.', 0, 29.40]],
        'Versele Laga Orlux Lori2 -v3' => [['3', 'кг.', 0, 76.60], [0.7, 'кг.', 0, 26.90]],
        'Versele Laga NutriBird P15 Original' => [['4', 'кг.', 0, 65.20], [1, 'кг.', 0, 19]],
        'Versele Laga NutriBird A19' => [['3', 'кг.', 0, 96.75], [0.8, 'кг.', 0, 32.65]],
        'Versele Laga Prestige Ara Parrot Mix' => [['15', 'кг.', 0, 125.13], [2.5, 'кг.', 0, 28.50]],
        'Versele Laga NutriBird P15 Original -v2' => [['4', 'кг.', 5.20, 65.20], [1, 'кг.', 0, 19]],
        'Versele Laga NutriBird A19 -v2' => [['3', 'кг.', 4.75, 96.75], [0.8, 'кг.', 2.65, 32.65]],
        'Versele Laga Prestige Ara Parrot Mix -v2' => [['15', 'кг.', 0, 125.13], [2.5, 'кг.', 0, 28.50]],
        'Versele Laga NutriBird P15 Original -v3' => [['4', 'кг.', 3.20, 65.20], [1, 'кг.', 0, 19]],
        'Versele Laga NutriBird A19 -v3' => [['3', 'кг.', 10.75, 96.75], [0.8, 'кг.', 2.65, 32.65]],
        'Versele Laga Prestige Ara Parrot Mix -v3' => [['15', 'кг.', 0, 125.13], [2.5, 'кг.', 0, 28.50]],
        'Padovan Ovomix Yellow Gold' => [['25', 'кг.', 0, 147.80]],
        'Padovan Premium Red' => [['25', 'кг.', 0, 148.40]],
        'Padovan Vegetable Mélange' => [['300', 'г.', 0, 4.40]],
        'Padovan Mélange Fruit ' => [['300', 'г.', 0, 4.40]],
        'Padovan Ovomix Yellow Gold -v2' => [['25', 'кг.', 5.80, 147.80]],
        'Padovan Premium Red -v2' => [['25', 'кг.', 10.40, 148.40]],
        'Padovan Vegetable Mélange -v2' => [['300', 'г.', 2, 4.40]],
        'Padovan Mélange Fruit -v2 ' => [['300', 'г.', 0, 4.40]],
        'Padovan Ovomix Yellow Gold -v3' => [['25', 'кг.', 5.80, 147.80]],
        'Padovan Premium Red -v3' => [['25', 'кг.', 10.40, 148.40]],
        'Padovan Vegetable Mélange -v3' => [['300', 'г.', 2, 4.40]],
        'Padovan Mélange Fruit -v3 ' => [['300', 'г.', 0, 4.40]],
        'Trixie Wooden Nest' => [['30 х 20 х 20', 'см.', 0, 25.50]],
        'Trixie Wooden Nest Dark' => [['21 х 13 х 12', 'см.', 0, 19.70]],
        'Trixie Bath House' => [['15 х 13 х 13', 'см.', 0, 6.70]],
        'Trixie Wooden Nest -v2' => [['30 х 20 х 20', 'см.', 2.50, 25.50]],
        'Trixie Wooden Nest Dark -v2' => [['21 х 13 х 12', 'см.', 2.70, 19.70]],
        'Trixie Bath House -v2' => [['15 х 13 х 13', 'см.', 0, 6.70]],
        'Trixie Wooden Nest -v3' => [['30 х 20 х 20', 'см.', 4.50, 25.50]],
        'Trixie Wooden Nest Dark -v3' => [['21 х 13 х 12', 'см.', 3.70, 19.70]],
        'Trixie Bath House -v3' => [['15 х 13 х 13', 'см.', 0, 6.70]],
        'Ferplast Sirio' => [[500, 'мл.', 0, 10.50]],
        'Ferplast Univer' => [[500, 'мл.', 0, 4.10]],
        'Trixie Outdoor Feeding Lantern' => [[300, 'мл.', 0, 13.60]],
        'Trixie Stainless Steel Bowl with Holder' => [[600, 'мл.', 0, 8],[300, 'мл.', 0, 6.20]],
        'Trixie Outdoor Feeder' => [[400, 'мл.', 0, 11]],
        'Ferplast Sirio -v2' => [[500, 'мл.', 1.50, 10.50]],
        'Ferplast Univer -v2' => [[500, 'мл.', 0, 4.10]],
        'Trixie Outdoor Feeding Lantern -v2' => [[300, 'мл.', 2.50, 13.60]],
        'Trixie Stainless Steel Bowl with Holder -v2' => [[600, 'мл.', 0, 8],[300, 'мл.', 0, 6.20]],
        'Trixie Outdoor Feeder -v2' => [[400, 'мл.', 0, 11]],
        'Ferplast Sirio -v3' => [[500, 'мл.', 2.50, 10.50]],
        'Ferplast Univer -v3' => [[500, 'мл.', 0, 4.10]],
        'Trixie Outdoor Feeding Lantern -v3' => [[300, 'мл.', 3.60, 13.60]],
        'Trixie Stainless Steel Bowl with Holder -v3' => [[600, 'мл.', 0, 8],[300, 'мл.', 0, 6.20]],
        'Trixie Outdoor Feeder -v3' => [[400, 'мл.', 0, 11]],

    ];

    protected function loadData(ObjectManager $manager)
    {
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
