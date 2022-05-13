<?php

namespace App;

use Symfony\Component\Console\Application as SymfonyApplication;

final class Application extends SymfonyApplication
{
    public function __construct(iterable $commands)
    {
        $this->addCommands(\iterator_to_array($commands));

        parent::__construct(__NAMESPACE__, '1.0.0');
    }
}
