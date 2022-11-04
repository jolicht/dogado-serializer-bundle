<?php

namespace Jolicht\DogadoSerializerBundle\Tests\Normalizer\_files;

use EventSauce\EventSourcing\AggregateRootId;

final class TestAggregateRootId implements AggregateRootId
{
    public function __construct(
        private readonly string $id
    ) {
    }

    public function toString(): string
    {
        return $this->id;
    }

    public static function fromString(string $aggregateRootId): static
    {
        return new self($aggregateRootId);
    }
}
