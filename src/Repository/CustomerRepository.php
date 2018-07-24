<?php
declare(strict_types=1);

namespace Hotel\Repository;

use Hotel\Booking\Entity\Customer;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Repository Class CustomerRepository
 * @package Hotel\Repository
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
class CustomerRepository extends AbstractRepository
{
    /**
     * CustomerRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Customer::class);
    }
}
