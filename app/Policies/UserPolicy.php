<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
  public function modifyRole(User $user)
  {
    return $user->isAdmin();
  }
}
