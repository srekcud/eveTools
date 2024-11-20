<?php

namespace App\Message;


use App\Entity\RavworksStock;

class RavworksStockMessage
{
    public function __construct(
        private readonly RavworksStock $stock
    )
    {
    }

    public function getStock(): RavworksStock
    {
        return $this->stock;
    }


}
