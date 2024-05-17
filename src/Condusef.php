<?php

namespace OpenFintech\Complaints;

use OpenFintech\Complaints\Redeco\RedecoService;
use OpenFintech\Complaints\Reune\ReuneService;

class Condusef
{
    public function __construct(
        public readonly RedecoService $redeco,
        public readonly ReuneService $reune
    ) {
    }
}