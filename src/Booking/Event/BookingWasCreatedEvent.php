<?php
declare(strict_types=1);

namespace Hotel\Booking\Event;

/**
 * Class BookingWasCreatedEvent
 * @package Hotel\Booking\Event
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
class BookingWasCreatedEvent implements EventInterface
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'booking.wasCreated';
    }
}
