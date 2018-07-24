<?php
declare(strict_types=1);

namespace Hotel\Repository;

use Hotel\Booking\Entity\Booking;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Repository Class BookingRepository
 * @package Hotel\Repository
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
class BookingRepository extends AbstractRepository
{
    /**
     * BookingRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Booking::class);
    }
}
