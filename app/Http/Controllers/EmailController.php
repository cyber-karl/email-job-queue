<?php

namespace App\Http\Controllers;

use App\Http\Requests\Email\EmailCreateRequest;
use App\Jobs\SendSubscribedNotification;
use App\Models\Email;
use Illuminate\Http\JsonResponse;

class EmailController extends Controller
{
    public function store(EmailCreateRequest $request): JsonResponse
    {
        $emailInput = $request->validated('email');

        $email = (new Email)->firstOrCreate(
            ['email' => $emailInput],
        );

        SendSubscribedNotification::dispatch($email);

        return response()->json(['message' => 'Store successful for email ' . $emailInput], 201);
    }
}
