<?php

namespace Curlyspoon\Framework\Libs;

use ArrayAccess;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Curlyspoon\Framework\Contracts\NormalizerManager as NormalizerManagerContract;

class MenuItem implements ArrayAccess
{
    protected $resolver;

    /**
     * @var array
     */
    protected $data;

    public function __construct(array $data)
    {
        $this->resolve($data);
        $this->data['current'] = app('request')->is($this->data['link']);
    }

    public function isActive(): bool
    {
        return $this->data['active'];
    }

    public function isCurrent(): bool
    {
        return $this->data['current'];
    }

    public function getLabel(): string
    {
        return $this->data['label'];
    }

    public function getLink(): string
    {
        return $this->data['link'];
    }

    public function offsetExists($key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function offsetGet($key)
    {
        return $this->data[$key];
    }

    public function offsetSet($key, $value)
    {
        $this->data[$key] = $value;
        $this->resolve($this->data);
    }

    public function offsetUnset($key)
    {
        unset($this->data[$key]);
        $this->resolve($this->data);
    }

    protected function resolve(array $data)
    {
        if (is_null($this->resolver)) {
            $this->resolver = $this->optionsResolver();
        }
        $this->resolver->setDefined(array_keys($data));
        $this->data = $this->resolver->resolve($data);
    }

    protected function optionsResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'active' => true,
        ]);

        $resolver->setRequired([
            'active',
            'label',
            'link',
        ]);

        $resolver->setAllowedTypes('active', 'bool');
        $resolver->setAllowedTypes('label', 'string');
        $resolver->setAllowedTypes('link', 'string');

        $resolver->setNormalizer('link', app(NormalizerManagerContract::class)->normalizer('url'));

        return $resolver;
    }
}
