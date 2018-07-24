<?php
declare(strict_types=1);

namespace Hotel\Service\Handler;

use Hotel\Booking\Entity\Customer;
use Hotel\Booking\Entity\Room;
use Hotel\Exception\RoomNotFoundException;
use Hotel\Exception\CustomerNotFoundException;
use Hotel\Booking\Entity\Booking;
use Hotel\Repository\BookingRepository;
use Hotel\Repository\RoomRepository;
use Hotel\Repository\CustomerRepository;
use Hotel\Service\RegisterNewBooking;

/**
 * Service Handler RegisterNewBookingHandler
 * @package Hotel\Service
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
final class RegisterNewBookingHandler implements HandlerInterface
{
    /** @var bookingRepository */
    private $bookingRepository;

    /** @var CustomerRepository */
    private $customerRepository;

    /** @var RoomRepository */
    private $roomRepository;

    /**
     * RegisterNewBookingHandler constructor.
     *
     * @param BookingRepository $bookingRepository
     * @param CustomerRepository $customerRepository
     * @param RoomRepository $roomRepository
     */
    public function __construct(
        BookingRepository $bookingRepository,
        CustomerRepository $customerRepository,
        RoomRepository $roomRepository
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->customerRepository = $customerRepository;
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param RegisterNewBooking $command
     *
     * @return Booking
     * @throws \Exception
     */
    public function handle(RegisterNewBooking $command)
    {
        /** @var $customer Customer */
        if (!$customer = $this->customerRepository->find($command->getCustomerId())) {
            throw new CustomerNotFoundException();
        }

        /** @var $room Room */
        if (!$room = $this->roomRepository->find($command->getRoomId())) {
            throw new RoomNotFoundException();
        }

        $booking = new Booking($customer, $room, $command->getCheckin(), $command->getCheckout());
        $this->bookingRepository->store($booking);

        return $booking;
    }
}
