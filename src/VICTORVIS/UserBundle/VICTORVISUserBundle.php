<?php

namespace VICTORVIS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VICTORVISUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
