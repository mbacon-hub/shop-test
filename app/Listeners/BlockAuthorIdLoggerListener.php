<?php

namespace App\Listeners;

use App\Services\Interfaces\PostBlockAuthorIdLoggerInterface;

class BlockAuthorIdLoggerListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private PostBlockAuthorIdLoggerInterface $blockAuthorIdLoggerService,
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->blockAuthorIdLoggerService->log($event->postId, $event->userId);
    }
}
