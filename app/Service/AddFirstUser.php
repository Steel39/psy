<?php
namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class AddFirstUser
{
    public static function addUser()
    {
        try {
            $data = [
                'name' => 'admin',
                'email' => env('ADMIN_DASHBOARD_EMAIL'),
                'password' => Hash::make(env('ADMIN_DASHBOARD_PASSWORD')),
                'email_verified_at' => '1',
            ];

            User::create($data);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}

