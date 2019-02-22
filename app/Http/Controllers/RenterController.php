<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookkeeping\Renter\RenterInterface as RenterInterface;

class RenterController extends Controller
{
    protected $renter;

    public function __construct(RenterInterface $renter)
    {
        $this->renter = $renter;
    }

    public function getRenters()
    {
        $results = $this->renter->getRenters();

        return response()->json($results);
    }
}
