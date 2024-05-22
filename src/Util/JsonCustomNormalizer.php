<?php

namespace Authlete\Util;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class JsonCustomNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private ObjectNormalizer $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|array|string|null|\ArrayObject
    {
        // Implement your normalization logic here
        return $this->normalizer->normalize($object, $format, $context);
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        // Define your support logic here
        return $this->normalizer->supportsNormalization($data, $format, $context);
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        // Implement your denormalization logic here
        // This is where you would handle complex nested structures
        return $this->normalizer->denormalize($data, $class, $format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        // Define your support logic here
        return $this->normalizer->supportsDenormalization($data, $type, $format, $context);
    }

    public function getSupportedTypes(?string $format): array
    {
        // TODO: Implement getSupportedTypes() method.
    }
}
