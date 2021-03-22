<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetUser extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function assetUser(){
        return $this->belongsTo(Asset::class);
    }
}
