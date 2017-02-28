<?php namespace Machaen\Blog;

use Illuminate\Database\Eloquent\Model;
use Input;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Blog extends Model {

    protected $fillable = [];

    protected $table = 'blog';

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


    public function scopeGetPosts($query){

        $query->select([ 'blog_translations.titulo', 'blog_translations.descripcion','blog_translations.slug', 'blog.created_at', 'blog_translations.image_banner', 'blog_translations.previo' ])
                        ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                        ->where('blog_translations.locale', LaravelLocalization::getCurrentLocale())
                        ->orderBy('blog.created_at', 'DESC');

        $query->where(function($query){
            $query->orWhere('blog_translations.titulo',  'LIKE', '%'.Input::get('search').'%');
            $query->orWhere('blog_translations.descripcion',  'LIKE', '%'.Input::get('search').'%');
        });

        if (Input::get('tag'))
        {
            $query->leftjoin('blog_has_tag', 'blog_has_tag.blog_id', '=', 'blog.id')
                  ->leftjoin('tag_translations', 'tag_translations.tag_id', '=', 'blog_has_tag.tag_id') 
                  ->where('tag_translations.slug',  '=', Input::get('tag'));
        }

        $query->groupBy('blog.id');

        return $query->paginate(15);
    }

    public function scopeGetPostBySlug($query, $slug){

        $query->select([ 'blog_translations.titulo', 'blog_translations.descripcion','blog_translations.slug','blog_translations.previo', 'blog.created_at', 'blog.id', 'blog_translations.image_banner' ])
                        ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                        ->where('blog_translations.locale',  LaravelLocalization::getCurrentLocale())
                        ->where('blog_translations.slug', $slug);

        return $query->first();
    }

    public function scopeGetTags($query){

        $query->select([ 'tag_translations.nombre as tag_name', 'tag_translations.slug', \DB::raw("count(blog_has_tag.tag_id) as count") ])
                        ->leftjoin('blog_has_tag', 'blog_has_tag.blog_id', '=', 'blog.id')
                        ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog_has_tag.blog_id')
                        ->leftjoin('tag', 'tag.id', '=', 'blog_has_tag.tag_id')
                        ->leftjoin('tag_translations', 'tag_translations.tag_id', '=', 'tag.id')
                        ->where('tag_translations.locale',  LaravelLocalization::getCurrentLocale())
                        ->groupBy('tag.id')
                        ->orderBy('tag_translations.nombre');

        
        return $query->get();
    }

    public function scopeGetPostRecent($query, $num_post){

        $query->select([ '*' ])
                        ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                        ->where('blog_translations.locale',  LaravelLocalization::getCurrentLocale())
                        ->orderBy('blog.created_at', 'DESC' );

        return $query->take($num_post)->get();
    }

    public function scopeGetPostRelation($query, $num_post){

        $query->select([ 'blog_translations.titulo', 'blog_translations.slug' ])
                        ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                        ->where('blog_translations.locale',  LaravelLocalization::getCurrentLocale())
                        ->orderBy('blog.created_at', 'DESC' );

        return $query->take($num_post)->get();
    }

    public function scopeGetLastThree($query, $skip){
        $query->select([ 'blog_translations.titulo', 'blog_translations.slug', 'blog_translations.descripcion', 'blog_translations.previo', 'blog_translations.image_banner' ])
                        ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                        ->where('blog_translations.locale',  LaravelLocalization::getCurrentLocale())
                        ->orderBy('blog.created_at', 'DESC' );

        return $query->skip($skip)->first();
    }

    public function scopeGetByLote($query, $num, $skip){
        $query->select([ 'blog_translations.titulo', 'blog_translations.slug', 'blog_translations.descripcion', 'blog_translations.image_banner' ])
                        ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                        ->where('blog_translations.locale',  LaravelLocalization::getCurrentLocale())
                        ->orderBy('blog.created_at', 'DESC' );

        return $query->skip($skip)->take($num)->get();
    }

}
