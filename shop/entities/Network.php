<?php

namespace shop\entities;

use function PHPUnit\Framework\isEmpty;

class Network extends ActiveRecord
{
    private string $network;
    private string $identity;
    public static function create($network, $identity): self
    {
        if (isEmpty($network) || isEmpty($identity)) {
            throw new \DomainException('Empty value.');
        }
        $item = new static();
        $item->network = $network;
        $item->identity = $identity;
        return $item;
    }

    public function isFor($network, $identity): bool
    {
        return $this->network === $network && $this->identity === $identity;
    }

    public static function tableName()
    {
        return '{{%user_networks}}';
    }
}