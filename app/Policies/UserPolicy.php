<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //只能修改自己的账户信息
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
    //只有登录用户为管理员才能执行删除操作，并且删除的对象不能是自己，（管理员也不能删除自己）
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
