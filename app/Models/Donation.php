<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'members_id',
        'donation_date',
        'pick_up_date',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'rw',
        'rt',
        'kode_pos',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      
    ];

    public function items()
    {
        return $this->hasMany(DonationDetails::class,'donations_id','id');
    }

    public function histories()
    {
        return $this->hasMany(DonationHistory::class,'donations_id','id');
    }
}
