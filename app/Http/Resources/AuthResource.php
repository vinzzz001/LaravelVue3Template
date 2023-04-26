<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuthResource extends JsonResource
{
     /**
     * Determine if the authenticated user is an administrator.
     *
     * @param  string  $role
     * @return bool
     */
    public static function isAdmin(): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $user->is_admin;
    }
}
