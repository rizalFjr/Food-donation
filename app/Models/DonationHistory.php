<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationHistory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'donations_id',
        'donation_statuses_id',
        'users_id',
        'histories_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      
    ];

    public function histories()
    {
        return $this->belongsTo(Donation::class, 'donations_id', 'id');
    }

    public function statuses()
    {
        return $this->belongsTo(DonationStatus::class,'donation_statuses_id','id');
    }
}
