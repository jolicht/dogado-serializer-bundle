<?php

namespace Jolicht\DogadoSerializerBundle\Normalizer;

use EventSauce\EventSourcing\AggregateRootId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Webmozart\Assert\Assert;

final class AggregateRootIdNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize(mixed $object, string $format = null, array $context = []): string
    {
        Assert::isInstanceOf($object, AggregateRootId::class);

        return $object->toString();
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof AggregateRootId;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): AggregateRootId
    {
        Assert::isAOf($type, AggregateRootId::class);
        Assert::string($data);

        return $type::fromString($data);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return is_a($type, AggregateRootId::class, true);
    }
}
