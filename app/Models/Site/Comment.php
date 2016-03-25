<?php

namespace App\Models\Site;
use DB;

class Comment extends SiteBase
{
    protected $table ='comments';
    protected $primaryKey ='cid';
    protected $fillable = ['uid','nickname','email','subject','comment','photo_path','status','from','ip','timestamp','directory_tid','tag_id'];

    public function addComment($comment){
        return DB::connection($this->connection)->table($this->table)->insertGetId($comment);
    }
}
