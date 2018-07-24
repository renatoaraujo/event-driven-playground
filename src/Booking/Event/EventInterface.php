<?php
declare(strict_types=1);

namespace Hotel\Booking\Event;

/**
 * Interface EventInterface
 * @package Hotel\Booking\Event
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
interface EventInterface
{
    /**
     * @return string
     */
    public static function getName(): string;
}
