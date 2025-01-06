<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Inertia\Response;

class NotificationController extends Controller {
    
    public function index(Request $request): Response {
        return Inertia::render(
            'Notification/Index',
            [
                'notifications' => $request->user()
                    ->notifications()->paginate(10)
            ]
        );
    }
}
