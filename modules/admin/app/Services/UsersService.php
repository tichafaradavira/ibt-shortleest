<?php

namespace Modules\Admin\Services;


use Carbon\Carbon;
use Modules\Admin\Repositories\UsersRepository;
use Modules\Users\Models\User;

class UsersService
{
    protected $repository;
    protected $realtor;

    function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
        $this->realtor = auth()->guard('api')->user();
    }

    /**
     * @param $inputs
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    function browse($inputs)
    {
        $admin = $this->repository->browse($inputs);

        return $admin;
    }


    /**
     * @return mixed
     */
    function labelList()
    {
        $users = $this->repository->labelList($this->realtor);

        return $users;
    }


    /**
     * @param $id
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    function read($id)
    {
        if ($id) {
            $user = $this->repository->read($id);
            return $user;
        } else {
            return false;
        }
    }

    function suspend($id)
    {
        $user = User::query()
            ->where('id', $id)
            ->whereNull('suspended_at')->first();

        if ($user) {
            $user->suspended_at = Carbon::now();
            $user->save();

            return $user;
        } else {
            return false;
        }
    }


    function activate($id)
    {
        $user = User::query()
            ->where('id', $id)
            ->whereNotNull('suspended_at')->first();

        if ($user) {
            $user->suspended_at = null;
            $user->save();

            return $user;
        } else {
            return false;
        }
    }
}
