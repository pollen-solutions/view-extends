<?php

declare(strict_types=1);

namespace Pollen\Support\Concerns;

use Pollen\Support\MessagesBag;

interface MessagesBagAwareTraitInterface
{
    /**
     * MessagesBag instance|Set a new message.
     *
     * @param string|null $message
     * @param string|int $level
     * @param mixed $datas
     *
     * @return array|MessagesBag
     */
    public function messages(?string $message = null, $level = MessagesBag::ERROR, array $datas = []);

    /**
     * Set the MessagesBag instance.
     *
     * @param MessagesBag $messagesBag
     *
     * @return void
     */
    public function setMessagesBag(MessagesBag $messagesBag): void;
}