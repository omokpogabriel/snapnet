<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['type'];


    public function assetGroup(){
        return $this->hasMany(AssetGroup::class, 'asset_id', 'id');
    }

    public function assetUser(){
        return $this->hasMany(AssetUser::class);
    }
}
