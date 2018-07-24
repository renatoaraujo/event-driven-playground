<?php
declare(strict_types=1);

namespace Hotel\Booking\Entity;

use Hotel\Booking\Event\BookingWasCreatedEvent;
use Hotel\Booking\Event\EventInterface;
use Hotel\Booking\Exception\DateNotAllowedForBookingException;
use Hotel\Booking\Exception\ReschedulePeriodExpiredException;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="booking")
 */
class Booking
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
     * @Groups({"create-booking"})
     *
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @Groups({"create-booking"})
     *
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    private $room;

    /**
     * @Groups({"create-booking"})
     *
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     */
    private $checkinAt;

    /**
     * @Groups({"create-booking"})
     *
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     */
    private $checkoutAt;

    /**
     * @var array
     */
    private $raisedEvents = [];

    /**
     * Booking constructor.
     *
     * @param Customer $customer
     * @param Room $room
     * @param \DateTimeInterface $checkinDate
     * @param \DateTimeInterface $checkoutDate
     *
     * @throws DateNotAllowedForBookingException
     */
    public function __construct(
        Customer $customer,
        Room $room,
        \DateTimeInterface $checkinDate,
        \DateTimeInterface $checkoutDate
    ) {
        if (new \DateTime() > $checkinDate || $checkoutDate < $checkoutDate) {
            throw new DateNotAllowedForBookingException();
        }

        $this->id = Uuid::uuid4();
        $this->customer = $customer;
        $this->room = $room;
        $this->checkinAt = $checkinDate;
        $this->checkoutAt = $checkoutDate;

        $this->raisedEvents[] = new BookingWasCreatedEvent();
    }

    /**
     * @param \DateTimeInterface $newCheckinDate
     * @param \DateTimeInterface $newCheckoutDate
     *
     * @return EventInterface
     * @throws DateNotAllowedForBookingException
     * @throws ReschedulePeriodExpiredException
     */
    public function rescheduleBooking(
        \DateTimeInterface $newCheckinDate,
        \DateTimeInterface $newCheckoutDate
    ): EventInterface {
        $todayDate = new \DateTime();
        if ($todayDate->diff($this->checkinAt)->h <= 24) {
            throw new ReschedulePeriodExpiredException();
        }

        if ($newCheckoutDate < $newCheckinDate) {
            throw new DateNotAllowedForBookingException();
        }

        $this->checkinAt = $newCheckinDate;
        $this->checkoutAt = $newCheckoutDate;

        return new BookingWasCreatedEvent();
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCheckinAt(): \DateTimeInterface
    {
        return $this->checkinAt;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCheckoutAt(): \DateTimeInterface
    {
        return $this->checkoutAt;
    }

    /**
     * @return array
     */
    public function getRaisedEvents(): array
    {
        return $this->raisedEvents;
    }

    public function eraseRaisedEvents(): void
    {
        $this->raisedEvents = [];
    }
}
