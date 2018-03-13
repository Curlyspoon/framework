<?php

namespace Curlyspoon\Framework\Contracts;

interface ElementManager
{
    public function register(string $name, string $element): ElementManager;

    public function render(string $name, array $options = []): string;

    public function createElement(string $name, array $options = []): Element;

    public function getElements(): array;
}
