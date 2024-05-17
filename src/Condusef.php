<?php

namespace OpenFintech\Condusef;

use OpenFintech\Condusef\Redeco\RedecoService;
use OpenFintech\Condusef\Reune\ReuneService;

class Condusef
{
    public function __construct(
        public readonly RedecoService $redeco,
        public readonly ReuneService $reune
    ) {
    }
}