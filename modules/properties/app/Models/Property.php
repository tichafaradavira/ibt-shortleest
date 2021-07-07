<?php

namespace Modules\Properties\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Applications\Models\Vacancy;
use Modules\Properties\Database\Factories\PropertyFactory;
use Modules\Users\Models\User;

class Property extends Model
{
    use SoftDeletes;
    use HasFactory;

    const TYPE_RESIDENTIAL = 1;
    const TYPE_INDUSTRIAL = 2;
    const TYPE_COMMERCIAL = 3;
    const TYPE_RAW_LAND = 4;

    protected $table = "properties";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'uuid',
        'type',
        'area',
        'rental_price',
        'description',
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
        'type',
        'area',
        'rental_price',
        'description',
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
        'created_at' => 'datetime:Y-m-d\TH:i:sP',
    ];


    /**
     * @return PropertyFactory
     */
    protected static function newFactory()
    {
        return PropertyFactory::new();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function realtor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vacancy()
    {
        return $this->hasOne(Vacancy::class, 'property_id')
            ->where('status', '!=', Vacancy::STATUS_EXPIRED);
    }

    function getPropertyTypeAttribute()
    {
        switch ($this->type) {
            case static::TYPE_RESIDENTIAL:
                return 'Residential';
            case static::TYPE_INDUSTRIAL:
                return 'Industrial';
            case static::TYPE_COMMERCIAL:
                return 'Cormmecial';
            case static::TYPE_RAW_LAND:
                return 'Raw land';
            default:
                return 'Unclassified';

        }
    }

}
