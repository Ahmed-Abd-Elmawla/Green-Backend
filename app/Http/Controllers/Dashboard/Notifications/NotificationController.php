<?php

namespace App\Http\Controllers\Dashboard\Notifications;

use App\Traits\ShowToast;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;


class NotificationController extends Controller
{
    use ShowToast;
    public function read($id){
        $notifications = DatabaseNotification::where('notifiable_id', $id)->get();
        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }
        $this->showToast(__('dashboard.notification.successfully_read'));
        return redirect()->back();
    }
}
