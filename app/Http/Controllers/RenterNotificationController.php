<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renter;
use App\Notification;

class RenterNotificationController extends BaseController
{
    public function getSettings()
    {
        $renters = Renter::with('notifications')->get();

        return $renters->makeHidden(['phone_number', 'email', 'is_renting']);
    }

    public function updateSettings(Request $request)
    {
        $renter = Renter::find($request->input('renterID'));

        $renter->notifications()
            ->updateExistingPivot(
                $request->input('notificationID'),
                ['is_active' => $request->input('isActive')]
            );
    }
}
