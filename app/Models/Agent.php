<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'alamat',
        'nomor_kantor',
        'pic', 
        'designation', 
        'hp', 
        'user_id'
    ];

    /**
     * Get the user that owns the Agent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
