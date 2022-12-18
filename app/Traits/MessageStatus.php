<?php

namespace App\Traits;

trait MessageStatus {
    /**
     * Display a error when input is invalid.
     *
     * @param Illuminate\Support\Facades\Validator $validator
     * @return \Illuminate\Http\Response
     */
    public static function displayInvalidInput($validator)
    {
        return response()->json(['error' => $validator->errors(), 'message' => 'Invalid input'], 400);
    }

    /**
     * Not found
     *
     * @return \Illuminate\Http\Response
     */
    public static function notFound()
    {
        return response()->json(['message' => 'Not found'], 404);
    }
}
