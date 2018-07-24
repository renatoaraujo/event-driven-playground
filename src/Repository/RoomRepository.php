<?php
declare(strict_types=1);

namespace Hotel\Repository;

use Hotel\Booking\Entity\Room;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Repository Class RoomRepository
 * @package Hotel\Repository
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
class RoomRepository extends AbstractRepository
{
    /**
     * CaregiverRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Room::class);
    }
}
