<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'wp_posts';
    public $timestamps = false;
    protected $primaryKey = "ID";
    protected $fillable = ['post_author','post_content','post_title','post_excerpt','post_status','comment_status','ping_status','post_password','post_date','post_date_gmt','post_modified','post_modified_gmt','post_name','to_ping','pinged','post_content_filtered','post_parent','guid','menu_order','post_type','post_mime_type'];
}