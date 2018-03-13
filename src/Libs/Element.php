<?php

namespace Curlyspoon\Framework\Libs;

use Curlyspoon\Framework\Contracts\Element as ElementContract;
use Curlyspoon\Framework\Contracts\NormalizerManager as NormalizerManagerContract;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Element implements ElementContract
{
    protected $options = [];

    protected $view;

    /**
     * @var array
     *
     * @see OptionsResolver::setDefault()
     */
    protected $defaults = [];

    /**
     * @var array
     *
     * @see OptionsResolver::setRequired()
     */
    protected $required = [];

    /**
     * @var array
     *
     * @see OptionsResolver::setAllowedTypes()
     */
    protected $types = [];

    /**
     * @var array
     *
     * @see OptionsResolver::setAllowedValues()
     */
    protected $values = [];

    /**
     * @var array
     *
     * @see NormalizerManagerContract::normalizer()
     * @see OptionsResolver::setNormalizer()
     */
    protected $normalizers = [];

    public function __construct(array $options = [])
    {
        $this->options = $this->optionsResolver()->resolve($options);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function render(): string
    {
        if (empty($this->view)) {
            throw new \InvalidArgumentException('No view given to render.');
        }

        return view('curlyspoon::elements.'.$this->view)->with($this->getOptions())->render();
    }

    public function toString(): string
    {
        return $this->render();
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    protected function optionsResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults($this->defaults);

        $resolver->setRequired($this->required);

        foreach ($this->types as $option => $types) {
            $resolver->setAllowedTypes($option, $types);
        }

        foreach ($this->values as $option => $values) {
            $resolver->setAllowedValues($option, $values);
        }

        foreach ($this->normalizers as $option => $normalizer) {
            $resolver->setNormalizer($option, app(NormalizerManagerContract::class)->normalizer($normalizer));
        }

        return $resolver;
    }
}
