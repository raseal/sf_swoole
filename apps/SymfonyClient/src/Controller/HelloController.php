<?php

declare(strict_types=1);

namespace SymfonyClient\Controller;
use Symfony\Component\HttpFoundation\Response;

final class HelloController
{
    public function __invoke(): Response
    {
        return new Response('Hello darkness my old friend');
    }
}
