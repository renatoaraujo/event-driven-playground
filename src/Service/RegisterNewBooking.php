<?php
declare(strict_types=1);

namespace Hotel\Service;

/**
 * Command RegisterNewBooking
 * @package Hotel\Service
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
final class RegisterNewBooking implements QueueAbleCommandInterface
{
    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $roomId;

    /**
     * @var \DateTimeInterface
     */
    private $checkin;

    /**
     * @var \DateTimeInterface
     */
    private $checkout;

    /**
     * RegisterNewBooking constructor.
     *
     * @param string $customerId
     * @param string $roomId
     * @param \DateTimeInterface $checkin
     * @param \DateTimeInterface $checkout
     */
    public function __construct(
        string $customerId,
        string $roomId,
        \DateTimeInterface $checkin,
        \DateTimeInterface $checkout
    ) {
        $this->customerId = $customerId;
        $this->roomId = $roomId;
        $this->checkin = $checkin;
        $this->checkout = $checkout;
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @return string
     */
    public function getRoomId(): string
    {
        return $this->roomId;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCheckin(): \DateTimeInterface
    {
        return $this->checkin;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCheckout(): \DateTimeInterface
    {
        return $this->checkout;
    }
    /**
     * @return string
     */
    public function toMessage(): string
    {
        return serialize($this);
    }
}
