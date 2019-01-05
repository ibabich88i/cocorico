<?php
/**
 * Created by PhpStorm.
 * User: bingo
 * Date: 05.01.19
 * Time: 16:36
 */

namespace Cocorico\CoreBundle\DataFixtures\ORM;

use Cocorico\CoreBundle\Entity\Holiday;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadHolidayData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $newYear{$i} = new Holiday();
            $newYear{$i}->setTitle($faker->name);
            $newYear{$i}->setDescription($faker->text);
            $newYear{$i}->setDate($faker->dateTime);

            $manager->persist($newYear{$i});
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}