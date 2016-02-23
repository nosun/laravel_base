<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceFile extends Model
{
    protected $table = 'upload_files';
    public $timestamps = false;
    protected $fillable = ['type', 'name', 'path','ext','size','uid','created_at'];

}
