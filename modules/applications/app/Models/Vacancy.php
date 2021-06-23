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

    const STATUS_PENDING = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_EXPIRED = 3;

    protected $table = "vacancies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'available_from',
        'reference',
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
        'reference',
        'link',
        'token',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d\TH:i:sP',
        'created_at' => 'datetime:Y-m-d\TH:i:sP',
        'available_from' => 'datetime:d-m-Y',
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

    public function applications()
    {
        return $this->hasMany(Application::class, 'vacancy_id');
    }

    function getVacancyStatusAttribute(){
        switch ($this->status){
            case static::STATUS_PENDING:
                return 'Pending';
            case static::STATUS_ACTIVE:
                return 'Active';
            case static::STATUS_EXPIRED:
                return 'Expired';
            default:
                return 'Inactive';

        }
    }

}
