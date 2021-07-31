<?php

namespace Modules\Admin\Repositories;


use Modules\Users\Models\User;

class UsersRepository
{
    /**
     * @param $browse_inputs
     * @param $realtor
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function browse($browse_inputs)
    {
        $query = User::query()
                        ->where('is_admin', false);

        $query->orderByDesc('created_at');
        $admin = $query->paginate(15);

        return $admin;
    }

    /**
     * @param $id
     * @param $realtor
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    function read($id)
    {
        $user = User::query()
            ->where('id', $id)
            ->first();

        if ($user) {
            return $user;
        } else {
            return false;
        }
    }


}
