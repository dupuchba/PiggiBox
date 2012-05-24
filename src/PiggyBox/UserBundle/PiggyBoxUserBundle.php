<?php

namespace PiggyBox\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PiggyBoxUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
