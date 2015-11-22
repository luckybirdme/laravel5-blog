<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
	protected $table = 'posts';

    protected $fillable = ['title', 'content', 'active', 'user_id','category_id','markdown_content'];

	public function user() 
	{
		return $this->belongsTo('App\User');
	}

	public function category() 
	{
		return $this->belongsTo('App\Categories');
	}

	public function tags()
    {
        return $this->belongsToMany('App\Tags', 'posts_tags', 'post_id', 'tag_id');
    }

    public function comments() 
    {
      return $this->hasMany('App\Comments','post_id');
    }
}
