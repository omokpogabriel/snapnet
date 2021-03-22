<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function asset(){
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }
}
