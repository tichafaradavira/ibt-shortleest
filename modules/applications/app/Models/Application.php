<?php

namespace Modules\Applications\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Applications\Database\Factories\ApplicationFactory;
use Modules\Properties\Models\Property;
use Modules\Users\Models\User;

class Application extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "applications";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'nationality',
        'citizenship',
        'dob',
        'national_id',
        'gender',

        'mobile_number',
        'home_number',
        'work_number',
        'email',
        'fax',

        'physical_address_street' ,
        'physical_address_city' ,
        'physical_address_surburb' ,
        'physical_address_postcode' ,
        'postal_equal_to_physical',

        'postal_address_street',
        'postal_address_city',
        'postal_address_surburb',
        'postal_address_postcode',

        'next_of_kin_name' ,
        'next_of_kin_email',
        'next_of_kin_phone',
        'next_of_kin_address',

        'employment_status' ,
        'employer_name',
        'employer_address',
        'gross_salary',

        'employment_status' ,
        'employer_name',
        'employer_phone',
        'employer_email',
        'employer_address',
        'gross_salary',

        'dependants',
        'reason_for_moving',
        'is_smoker',
        'has_pets',

        'references',
        'next_of_kin',
        'expenses',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'nationality',
        'citizenship',
        'dob',
        'national_id',
        'gender',

        'mobile_number',
        'home_number',
        'work_number',
        'email',
        'fax',

        'physical_address_street' ,
        'physical_address_city' ,
        'physical_address_surburb' ,
        'physical_address_postcode' ,
        'postal_equal_to_physical',

        'postal_address_street',
        'postal_address_city',
        'postal_address_surburb',
        'postal_address_postcode',

        'next_of_kin_name' ,
        'next_of_kin_email',
        'next_of_kin_phone',
        'next_of_kin_address',

        'employment_status' ,
        'employer_name',
        'employer_phone',
        'employer_email',
        'employer_address',
        'gross_salary',

        'dependants',
        'reason_for_moving',
        'is_smoker',
        'has_pets',

        'references',
        'expenses',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d\TH:i:sP',
        'created_at' => 'datetime:Y-m-d\TH:i:sP',
        'references' => 'array',
        'expenses' => 'array',
    ];


    protected static function newFactory()
    {
        return ApplicationFactory::new();
    }

    public function realtor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }


}
