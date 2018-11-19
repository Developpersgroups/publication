<?php

namespace FLSHR\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FLSHRUserBundle extends Bundle
{  
        public function getParent()
        {
        return 'FOSUserBundle';
        }
}
