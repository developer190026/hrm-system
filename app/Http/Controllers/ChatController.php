<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function ask(Request $request)
{
    $message = $request->input('message');

    // Raw POST to OpenAI
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user',   'content' => $message],
        ],
    ]);

    // Dump status and body so we can see exactly what came back
    return response()->json([
        'status_code' => $response->status(),
        'raw_body'    => $response->body(),
    ]);
}

}
