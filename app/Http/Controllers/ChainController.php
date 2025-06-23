<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chain\ChainCreateRequest;
use App\Jobs\SendChainNotifications;
use App\Models\Email;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;

class ChainController extends Controller
{
    public function chain(ChainCreateRequest $request): JsonResponse
    {
        $emailInput = $request->validated('email');
        $email = (new Email)->firstOrCreate(
            ['email' => $emailInput],
        );

        Bus::chain([
            SendChainNotifications::dispatch($email, 1),
            SendChainNotifications::dispatch($email, 2),
            SendChainNotifications::dispatch($email, 3),
            SendChainNotifications::dispatch($email, 4),
            SendChainNotifications::dispatch($email, 5),
        ]);

        $email->update(['notified_at' => now()]);

        return response()->json(['message' => 'Chain successfully started for ' . $emailInput]);
    }
}
