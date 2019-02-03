<?php
/**
 * Created by PhpStorm.
 * User: STOYO
 * Date: 24.12.2018 г.
 * Time: 21:54 ч.
 */

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

abstract class BaseFixture extends Fixture
{
    /**
     * @var ObjectManager $manager
     */
    private $manager;

    abstract protected function loadData(ObjectManager $manager);

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->loadData($manager);
    }

    protected function createMany($className, int $count, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $factory($entity, $i);

            $this->manager->persist($entity);
        }
    }

    protected function createManyAssociative($className, $arr, callable $factory)
    {
        foreach ($arr as $value) {
            $entity = new $className();
            $factory($entity, $value);

            $this->manager->persist($entity);
        }
    }

    protected function createManyAssociativeCustom($class1, $class2, $class1_key, $arr, callable $factory)
    {
        foreach ($arr as $class2_key) {

            $reference1 = $this->getReference($class1.'_'.$class1_key);
            $reference2 = $this->getReference($class2.'_'.$class2_key);

            $factory($reference1, $reference2);
            $this->manager->persist($reference1);
        }
    }

}