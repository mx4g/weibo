<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    //1.只有当前登录用户为自己才能执行编辑操作
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    //1.只有当前登录用户为管理员才能执行删除操作；
    //2.删除的用户对象不是自己（即使是管理员也不能自己删自己）。
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }

    //自己不能关注自己
    public function follow(User $currentUser, User $user)
    {
        return $currentUser->id !== $user->id;
    }
}
