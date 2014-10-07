<?php

namespace Brainstrap\Bundles\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BrainstrapBundlesUserBundle extends Bundle
{
    public function getParent()
    {
        return "FOSUserBundle";
    }
}
