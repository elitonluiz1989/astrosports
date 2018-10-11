<?php

namespace App\Handlers;

use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Log;

class AppLog
{
    public static function write($level, $message, array $context = [])
    {
        Log::useDailyFiles(storage_path().'/logs/app.log');

        switch ($level) {
            case 'debug':
                Log::debug($message, $context);

                break;
            case 'info':
                Log::info($message, $context);

                break;
            case 'notice':
                Log::notice($message, $context);

                break;
            case 'warning':
                Log::warning($message, $context);

                break;
            case 'error':
                Log::error($message, $context);

                break;
            case 'critical':
                Log::critical($message, $context);

                break;
            case 'alert':
                Log::alert($message, $context);

                break;
            case 'emergency':
                Log::emergency($message, $context);

                break;
            default:
                throw new InvalidArgumentException("Invalid log level passed with parameter.");
        }
    }
}