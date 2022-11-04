<?php

namespace Jolicht\DogadoSerializerBundle\Normalizer;

use EventSauce\EventSourcing\Serialization\SerializablePayload;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Webmozart\Assert\Assert;

final class SerializablePayloadNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        Assert::isInstanceOf($object, SerializablePayload::class);

        return $object->toPayload();
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof SerializablePayload;
    }

    public function denormalize(
        mixed $data,
        string $type,
        string $format = null,
        array $context = []
    ): SerializablePayload {
        Assert::isAOf($type, SerializablePayload::class);
        Assert::isArray($data);

        return $type::fromPayload($data);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return is_a($type, SerializablePayload::class, true);
    }
}
