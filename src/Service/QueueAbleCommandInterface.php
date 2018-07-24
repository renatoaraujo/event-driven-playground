<?php
declare(strict_types=1);

namespace Hotel\Service;

/**
 * Interface QueueAbleCommandInterface
 * @package Hotel\Service
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
interface QueueAbleCommandInterface
{
    /**
     * @return string
     */
    public function toMessage(): string;
}
