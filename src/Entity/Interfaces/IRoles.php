<?php

namespace App\Entity\Interfaces;

use Symfony\Component\Security\Core\Role;

interface IRoles
{
    const
    ROLE_ADMIN = "ROLE_ADMIN",
    ROLE_MEMBRE = "ROLE_MEMBRE";
}
