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
        return redirect()->back()->with(['error' => 'Display invaild input'], 404);
    }

    /**
     * Not found
     *
     * @return \Illuminate\Http\Response
     */
    public static function notFound()
    {
        return redirect()->back()->with(['error' => 'Not found'], 404);
    }
}
