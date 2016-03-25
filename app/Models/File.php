<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'upload_files';
    public $timestamps = false;
    protected $fillable = ['type', 'name', 'path','ext','size','uid','url','created_at'];

}
