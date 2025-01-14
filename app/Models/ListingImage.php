<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Listing;

class ListingImage extends Model {
    
    use HasFactory;

    protected $fillable = ['filename'];
    protected $appends = ['src'];
    
    protected function listing(): BelongsTo {
        return $this->belongsTo(Listing::class);
    }

    public function getSrcAttribute() {
        return asset("storage/{$this->filename}");
    }

}
