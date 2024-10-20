<?php

namespace App\Helpers;

use App\Models\Admin;
use App\Notifications\AdminNotify;

class sendNotification
{
    public static function newClientNotify()
    {
        $notifyData['message'] ='dashboard.notification.new_client';
        $notifyData['icon'] ='bi bi-person-vcard-fill';
        $notifyData['url'] = route('clients.index');
        $admins = self::getAdmins();
        self::notify($admins, $notifyData);
    }

    public static function newInvoiceNotify()
    {
        $notifyData['message'] ='dashboard.notification.new_invoice';
        $notifyData['icon'] ='fa-solid fa-file-invoice';
        $notifyData['url'] = route('invoices.index');
        $admins = self::getAdmins();
        self::notify($admins, $notifyData);
    }

    public static function newCollectionNotify()
    {
        $notifyData['message'] ='dashboard.notification.new_collection';
        $notifyData['icon'] ='fa-solid fa-file-invoice-dollar';
        $notifyData['url'] = route('collections.index');
        $admins = self::getAdmins();
        self::notify($admins, $notifyData);
    }

    public static function newExpenseNotify()
    {
        $notifyData['message'] ='dashboard.notification.new_expense';
        $notifyData['icon'] ='fa-solid fa-hand-holding-dollar';
        $notifyData['url'] = route('expenses.index');
        $admins = self::getAdmins();
        self::notify($admins, $notifyData);
    }


    private static function getAdmins()
    {
        $admins = Admin::all();
        return $admins;
    }

    private static function notify($admins, $notifyData)
    {
        foreach ($admins as $admin) {
            $admin->notify(new AdminNotify($notifyData));
        }
    }
}
