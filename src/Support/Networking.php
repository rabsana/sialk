<?php

namespace Rabsana\Sialk\Support;

use Illuminate\Http\Request;
use Rabsana\Sialk\Contracts\Support\NetworkingInterface;

class Networking implements NetworkingInterface
{

    public function detectRequestIp(Request $request): string
    {
        //TODO improve this logic
        return $request->ip();
    }
}
