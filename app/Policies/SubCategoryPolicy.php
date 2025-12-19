<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SubCategory');
    }

    public function view(AuthUser $authUser, SubCategory $subCategory): bool
    {
        return $authUser->can('View:SubCategory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SubCategory');
    }

    public function update(AuthUser $authUser, SubCategory $subCategory): bool
    {
        return $authUser->can('Update:SubCategory');
    }

    public function delete(AuthUser $authUser, SubCategory $subCategory): bool
    {
        return $authUser->can('Delete:SubCategory');
    }

    public function restore(AuthUser $authUser, SubCategory $subCategory): bool
    {
        return $authUser->can('Restore:SubCategory');
    }

    public function forceDelete(AuthUser $authUser, SubCategory $subCategory): bool
    {
        return $authUser->can('ForceDelete:SubCategory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SubCategory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SubCategory');
    }

    public function replicate(AuthUser $authUser, SubCategory $subCategory): bool
    {
        return $authUser->can('Replicate:SubCategory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SubCategory');
    }

}