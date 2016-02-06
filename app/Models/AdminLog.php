<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_log';
    public $timestamps = false;
}