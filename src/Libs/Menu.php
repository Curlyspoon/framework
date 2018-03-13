<?php

namespace Curlyspoon\Framework\Libs;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class Menu extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);

        $this->prepare();
    }

    public static function fromFile(string $filepath): Menu
    {
        if (!file_exists($filepath)) {
            throw new InvalidArgumentException('Menu file does not exist');
        }
        if (!is_file($filepath)) {
            throw new InvalidArgumentException('Menu file is not a file');
        }
        if (!is_readable($filepath)) {
            throw new InvalidArgumentException('Menu file is not readable');
        }

        return self::fromJson(file_get_contents($filepath));
    }

    public static function fromJson(string $json): Menu
    {
        $array = json_decode($json, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException('Menu JSON is not valid');
        }

        return self::fromArray($array);
    }

    public static function fromArray(array $array): Menu
    {
        $menuItems = [];
        foreach ($array as $menuItem) {
            $menuItems[] = new MenuItem($menuItem);
        }

        return new self($menuItems);
    }

    public function getCurrentLabel()
    {
        $current = $this->firstWhere('current', true);

        return is_null($current) ? '' : $current->getLabel();
    }

    protected function prepare()
    {
        $this->items = $this->getArrayableItems(Arr::where($this->items, function (MenuItem $menuItem) {
            return $menuItem->isActive();
        }));
    }
}
