<?php

namespace Modules\Applications\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Applications\Database\Factories\VacancyFactory;
use Modules\Properties\Database\Factories\PropertyFactory;
use Modules\Properties\Models\Property;
use Modules\Users\Models\User;

class Vacancy extends Model
{
    use SoftDeletes;
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_EXPIRED = 2;

    protected $table = "vacancies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'available_from',
        'link',
        'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'status',
        'available_from',
        'link',
        'token',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'available_from' => 'datetime',
    ];


    protected static function newFactory()
    {
        return VacancyFactory::new();
    }

    public function realtor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    function getVacancyStatusAttribute(){
        switch ($this->status){
            case static::STATUS_ACTIVE:
                return 'Active';
            case static::STATUS_EXPIRED:
                return 'Expired';
            default:
                return 'Inactive';

        }
    }

}
