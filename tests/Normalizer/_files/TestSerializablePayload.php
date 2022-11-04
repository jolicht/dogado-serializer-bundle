<?php

namespace Jolicht\DogadoSerializerBundle\Tests\Normalizer\_files;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class TestSerializablePayload implements SerializablePayload
{
    public function __construct(
        private readonly string $id,
        private readonly string $name
    ) {
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['id'],
            $payload['name']
        );
    }
}
