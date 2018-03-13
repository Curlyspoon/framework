<?php

namespace Curlyspoon\Framework\Managers;

use Closure;
use Curlyspoon\Framework\Contracts\NormalizerManager as NormalizerManagerContract;
use InvalidArgumentException;

class NormalizerManager implements NormalizerManagerContract
{
    protected $normalizers = [];

    public function register(string $name, Closure $normalizer): NormalizerManagerContract
    {
        $this->normalizers[$name] = $normalizer;

        return $this;
    }

    public function normalizer(string $name): Closure
    {
        if (!isset($this->normalizers[$name])) {
            throw new InvalidArgumentException(sprintf('No normalizer with name [%s] found.', $name));
        }

        return $this->normalizers[$name];
    }

    public function getNormalizers(): array
    {
        return $this->normalizers;
    }
}
