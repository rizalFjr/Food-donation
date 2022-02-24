<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Donation;

class DonationDetails extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'donations_id',
        'donation_categories_id',
        'nama_barang',
        'jumlah',
        'quantities_id',
        'foto',
        'status',
        'members_id',
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
        return $this->belongsTo(Donation::class, 'donations_id', 'id');
    }
}
