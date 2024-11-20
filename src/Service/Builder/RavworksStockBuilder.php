<?php

namespace App\Service\Builder;

use App\Entity\RavworksStock;

class RavworksStockBuilder
{
    public function build($code, $data): RavworksStock
    {
        return (new RavworksStock())
            ->setRavworksCode($code)
            ->setName($data[1])
            ->setToBuy($data[2])
            ->setToBuyValue((int) str_replace(',', '', $data[3]))
            ->setToBuyVolume((float) $data[4])
            ->setStartAmount($data[5])
            ->setEndAmount($data[6]);
    }
}
