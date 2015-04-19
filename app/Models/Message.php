<?php


namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    protected $table = "messages";
    protected $fillable = ['author', 'content'];
}