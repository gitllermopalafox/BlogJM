<?php namespace Machaen\Blog;

use Illuminate\Database\Eloquent\Model;
use Input;
//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogHasTag extends Model {

    protected $fillable = [];

    protected $table = 'blog_has_tag';

    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */

    /**  
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at']; 


}
