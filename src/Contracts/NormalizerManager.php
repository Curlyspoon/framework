<?php

namespace Curlyspoon\Framework\Contracts;

use Closure;

interface NormalizerManager
{
    public function register(string $name, Closure $normalizer): NormalizerManager;

    public function normalizer(string $name): Closure;

    public function getNormalizers(): array;
}
