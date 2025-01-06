<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//u se Illuminate\Database\Eloquent\Casts\Attribute;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Listing;
use App\Models\Offer;

class User extends Authenticatable implements MustVerifyEmail {

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function listings(): HasMany {
        return $this->hasMany(Listing::class, 'owner_id');
    }

    public function offers(): HasMany {
        return $this->hasMany(Offer::class, 'bidder_id');
    }

 
    
}
