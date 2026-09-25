<?php

namespace Rabsana\Sialk\Contracts\Support;

use Illuminate\Http\Request;

interface NetworkingInterface
{
    public function detectRequestIp(Request $request): string;
}
