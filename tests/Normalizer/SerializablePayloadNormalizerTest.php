<?php

namespace Jolicht\DogadoSerializerBundle\Tests\Normalizer;

use Jolicht\DogadoSerializerBundle\Normalizer\SerializablePayloadNormalizer;
use Jolicht\DogadoSerializerBundle\Tests\Normalizer\_files\TestSerializablePayload;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicht\DogadoSerializerBundle\Normalizer\SerializablePayloadNormalizer
 */
class SerializablePayloadNormalizerTest extends TestCase
{
    private SerializablePayloadNormalizer $normalizer;

    protected function setUp(): void
    {
        $this->normalizer = new SerializablePayloadNormalizer();
    }

    public function testNormalize(): void
    {
        $serializablePayload = new TestSerializablePayload('testId', 'testName');
        $expected = [
            'id' => 'testId',
            'name' => 'testName',
        ];
        $this->assertSame($expected, $this->normalizer->normalize($serializablePayload));
    }

    public function testSupportsNormalizationDataIsInstanceOfSerializablePayloadReturnsTrue(): void
    {
        $serializablePayload = new TestSerializablePayload('testId', 'testName');
        $this->assertTrue($this->normalizer->supportsNormalization($serializablePayload));
    }

    public function testSupportsNormalizationDataIsNotInstanceOfSerializablePayloadReturnsFalse(): void
    {
        $this->assertFalse($this->normalizer->supportsNormalization('some data'));
    }

    public function testSupportsDenormalizationTypeIsSerializablePayloadReturnsTrue(): void
    {
        $this->assertTrue($this->normalizer->supportsDenormalization([], TestSerializablePayload::class));
    }

    public function testSupportsDenormalizationTypeIsSNoterializablePayloadReturnsFalse(): void
    {
        $this->assertFalse($this->normalizer->supportsDenormalization([], 'some type'));
    }

    public function testDenormalize(): void
    {
        $payload = [
            'id' => 'testId',
            'name' => 'testName',
        ];

        $expected = new TestSerializablePayload('testId', 'testName');

        $this->assertEquals($expected, $this->normalizer->denormalize($payload, TestSerializablePayload::class));
    }
}
