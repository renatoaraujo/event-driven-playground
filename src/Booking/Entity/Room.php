<?php
declare(strict_types=1);

namespace Hotel\Booking\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="room")
 */
class Room
{
    /**
     * @Groups({"create-booking"})
     *
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", unique=true)
     */
    private $number;

    /**
     * Room constructor.
     *
     * @param int $number
     *
     * @throws \Exception
     */
    public function __construct(int $number)
    {
        $this->id = Uuid::uuid4();
        $this->number = $number;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
