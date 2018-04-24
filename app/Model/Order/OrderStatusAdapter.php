<?php

namespace App\Model\Order;

use App\Model\OrderStatus;

class OrderStatusAdapter extends OrderStatus
{
    public function asObjectById()
    {
        $grouped = $this->all()->mapToGroups(function ($item, $key) {
            return [$item->id => $item];
        });

        return $grouped;
    }

    public function asObjectByValue()
    {
        $grouped = $this->all()->mapToGroups(function ($item, $key) {
            return [$item->value => $item];
        });

        return $grouped;
    }
}
