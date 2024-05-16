<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestAgen extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama', 
        'alamat',
        'nomor_kantor',
        'pic', 
        'designation', 
        'hp', 
        'status',
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
