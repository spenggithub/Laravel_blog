<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //允许更新content
    protected $fillable = ['content','title'];
    public function user(){
        //一条微博属于一个用户，定义关系模型
        return $this->belongsTo(User::class);
    }
}
