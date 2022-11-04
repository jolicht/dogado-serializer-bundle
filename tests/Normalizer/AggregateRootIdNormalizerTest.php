<?php

namespace Jolicht\DogadoSerializerBundle\Tests\Normalizer;

use Jolicht\DogadoSerializerBundle\Normalizer\AggregateRootIdNormalizer;
use Jolicht\DogadoSerializerBundle\Tests\Normalizer\_files\TestAggregateRootId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicht\DogadoSerializerBundle\Normalizer\AggregateRootIdNormalizer
 */
class AggregateRootIdNormalizerTest extends TestCase
{
    private AggregateRootIdNormalizer $normalizer;

    protected function setUp(): void
    {
        $this->normalizer = new AggregateRootIdNormalizer();
    }

    public function testNormalize(): void
    {
        $aggregaterRootId = new TestAggregateRootId('testId');
        $this->assertSame('testId', $this->normalizer->normalize($aggregaterRootId));
    }

    public function testSupportsNormalizationDataIsInstanceOfAggregateRootIdReturnsTrue(): void
    {
        $aggregateRootId = new TestAggregateRootId('testId');
        $this->assertTrue($this->normalizer->supportsNormalization($aggregateRootId));
    }

    public function testSupportsNormalizationDataIsNotInstanceOfAggregateRootIdReturnsFalse(): void
    {
        $this->assertFalse($this->normalizer->supportsNormalization('some string'));
    }

    public function testDenormalize(): void
    {
        $expected = new TestAggregateRootId('testId');
        $this->assertEquals($expected, $this->normalizer->denormalize('testId', TestAggregateRootId::class));
    }

    public function testSupportsDenormalizationTypeIsAggregateRootIdReturnsTrue(): void
    {
        $this->assertTrue($this->normalizer->supportsDenormalization([], TestAggregateRootId::class));
    }

    public function testSupportsDenormalizationTypeIsNotAggregateRootIdReturnsFalse(): void
    {
        $this->assertFalse($this->normalizer->supportsDenormalization([], 'some type'));
    }
}
