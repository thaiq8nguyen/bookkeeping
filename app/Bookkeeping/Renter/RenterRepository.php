<?php

namespace App\Bookkeeping\Renter;

use App\Renter;

class RenterRepository implements RenterInterface
{
    public function getRenters()
    {
    
        $renters = Renter::where('is_renting', '1')->get();
        return $renters;
    }
}
