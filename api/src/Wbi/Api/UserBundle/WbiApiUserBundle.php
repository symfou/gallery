<?php

namespace Wbi\Api\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WbiApiUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
