<?php
declare(strict_types=1);

namespace Hotel\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Hotel\Booking\Entity\Room;

/**
 * Fixture Room
 * @package Hotel\DataFixtures
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
class RoomFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $roomsByFoor = 10;
        $floors = 10;

        for ($roomNumber = 1; $roomNumber <= $roomsByFoor; $roomNumber++) {
            for ($floorNumber = 0; $floorNumber <= $floors; $floorNumber++) {
                $room = new Room((int) ($floorNumber . sprintf("%02d", $roomNumber)));
                $manager->persist($room);
            }
        }

        $manager->flush();
    }
}
