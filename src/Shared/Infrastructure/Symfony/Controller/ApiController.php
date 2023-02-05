<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Symfony\Controller;

use Shared\Application\Bus\Command\CommandBus;
use Shared\Application\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

abstract class ApiController extends Controller
{
    public function __construct(
        protected QueryBus $queryBus,
        protected CommandBus $commandBus,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler,
        protected SerializerInterface $serializer
    ) {
        parent::__construct($this->queryBus, $this->commandBus);

        foreach ($this->exceptions() as $exceptionClass => $httpCode) {
            $exceptionHandler->register($exceptionClass, $httpCode);
        }
    }

    abstract protected function exceptions(): array;

    protected function createApiResponse(mixed $data, int $status_code = Response::HTTP_OK): Response
    {
        return new Response(
            $this->serialize($data),
            $status_code,
            [
                'Content-Type' => 'application/json',
            ]
        );
    }

    private function serialize(mixed $data): string
    {
        return $this->serializer->serialize($data, JsonEncoder::FORMAT);
    }
}
