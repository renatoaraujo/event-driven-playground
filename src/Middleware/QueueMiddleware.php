<?php
declare(strict_types=1);

namespace Hotel\Middleware;

use Hotel\Service\QueueAbleCommandInterface;
use League\Tactician\Middleware;

/**
 * Middleware QueueMiddleware
 * @package Hotel\Middleware
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
class QueueMiddleware implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     * @throws \Throwable
     */
    public function execute($command, callable $next)
    {
        try {

            if (!$command instanceof QueueAbleCommandInterface) {
                return $next($command);
            }

            // @todo publish to queue server

        } catch (\Exception | \Throwable $exception) {
            throw $exception;
        }
    }
}
