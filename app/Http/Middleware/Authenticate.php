<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // JIKA URL yang diakses mengandung kata 'admin', lempar ke login admin
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login'); // Sesuaikan dengan nama rute login adminmu
            }

            // JIKA SELAIN ITU (akses rute checkout/customer), lempar ke login customer
            return route('customer.login'); // Sesuaikan dengan nama rute login customermu
        }

        return null;
    }
}
