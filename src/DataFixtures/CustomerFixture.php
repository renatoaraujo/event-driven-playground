<?php
declare(strict_types=1);

namespace Hotel\DataFixtures;

use Hotel\Booking\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Fixture Customer
 * @package Hotel\DataFixtures
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
class CustomerFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
            $faker = Factory::create();
            $caregiver = new Customer($faker->name);
            $manager->persist($caregiver);
        }

        $manager->flush();
    }
}
