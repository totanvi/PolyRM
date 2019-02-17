<?php

namespace App\Policies;

use App\User;
use App\Property;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
	use HandlesAuthorization;

	public function view(User $user, Property $property)
	{
		return $user->id == $property->user_id;
	}
}
