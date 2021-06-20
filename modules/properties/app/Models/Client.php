<?php

namespace Modules\Properties\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Properties\Database\Factories\ClientFactory;
use Modules\Properties\Database\Factories\PropertyFactory;
use Modules\Users\Models\User;

class Client extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "clients";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name' ,
        'email' ,
        'phone_number' ,
        'summary',
        'description' ,
        'physical_address_street',
        'physical_address_city',
        'physical_address_surburb',
        'physical_address_postcode',
        'postal_equal_to_physical',
        'postal_address_street',
        'postal_address_city',
        'postal_address_surburb',
        'postal_address_postcode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'full_name' ,
        'email' ,
        'phone_number' ,
        'description' ,
        'physical_address_street',
        'physical_address_city',
        'physical_address_surburb',
        'physical_address_postcode',
        'postal_equal_to_physical',
        'postal_address_street',
        'postal_address_city',
        'postal_address_surburb',
        'postal_address_postcode',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d\TH:i:sP',
    ];


    protected static function newFactory()
    {
        return ClientFactory::new();
    }

    public function realtor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
