<?php

namespace Curlyspoon\Framework\Contracts;

interface Element
{
    public function __construct(array $options = []);

    public function render(): string;

    public function toString(): string;

    public function __toString(): string;
}
