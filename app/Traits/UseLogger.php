<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait UseLogger
{
    public function addToLogger(string $context, $exception): void
    {
        Log::error($context, [$exception->getMessage()]);
    }
}
