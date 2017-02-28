<?php namespace Machaen\Blog;

//======================================================================
// METODOS PARA LA OBTENCIÓN DE DATOS Y CALCULOS ESPECÍFICOS
//======================================================================

use DateTime;
use Illuminate\Support\Facades\URL;
use Machaen\Blog\Blog;
use Machaen\Blog\BlogTranslations;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Input;
use Auth;
use Carbon;
use Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class Helpers{
    
    
    public static function dateString($date)
    {
        $date_f = explode("-", explode(" " , $date)[0]);

        $months  = array(   1 => 'Enero', 
                2   => 'Febrero',
                3   => 'Marzo',
                4   => 'Abril',
                5   => 'Mayo',
                6   => 'Junio',
                7   => 'Julio',
                8   => 'Agosto',
                9   => 'Septiembre',
                10  => 'Octubre',
                11  => 'Noviembre', 
                12  => 'Diciembre'
            );
        
        
        

        return $months[intval($date_f[1])]." ".$date_f[2].", ".$date_f[0];
    }
    static public function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)){
            return 'n-a';
        }
        return $text;
    }

    public static function getYearsPost()
    {
        $year_init = intval(self::getMinYear());

        $years = [];

        for($year_init; $year_init <= date('Y'); $year_init++){
            array_push($years, $year_init);
        }
        return $years;
    }

    public static function getMonthsPost($year)
    {
        $month  = self::getMinMonth($year);
        
        $months = [ ];

        $intMonth = 1;

        for ($intMonth; $intMonth <= intval($month) ; $intMonth++) { 

              array_push($months, $intMonth);
        }   
        return $months;  
    }

    public static function getDestination($destino_id){
        return \DB::table('destinos')->where('id', $destino_id)->first()->nombre;
    }
    public static function getMonthString($month)
    {
        if (LaravelLocalization::getCurrentLocale() == "en")
        {
            $months  = array(   1 => 'January', 
                2   => 'February',
                3   => 'March',
                4   => 'April',
                5   => 'May',
                6   => 'June',
                7   => 'July',
                8   => 'August',
                9   => 'September',
                10  => 'October',
                11  => 'November', 
                12  => 'December'
            );

        }else{
            $months  = array(   1 => 'Enero', 
                2   => 'Febrero',
                3   => 'Marzo',
                4   => 'Abril',
                5   => 'Mayo',
                6   => 'Junio',
                7   => 'Julio',
                8   => 'Agosto',
                9   => 'Septiembre',
                10  => 'Octubre',
                11  => 'Noviembre', 
                12  => 'Diciembre'
            );
        }
        

        return strtoupper($months[$month]);
    }

    public static function monthHasPost($month, $year){

        if (strlen($month) == 1){
            $month = "0".$month; 
        }
        $date_min = strtotime($year."-".$month."-01");
        $date_max = strtotime($year."-".$month."-01");

        $date_max = date('Y-m-d H:i:s', strtotime('+1 month', $date_max));
        $date_min = date('Y-m-d H:i:s', $date_min);

        $query = Blog::select(['*'])->whereBetween('created_at', [$date_min, $date_max]);

        return $query->count();
    }

    public static function getPostByMonth($month, $year){

        if (strlen($month) == 1){
            $month = "0".$month; 
        }

        $date_min = strtotime($year."-".$month."-01");
        $date_max = strtotime($year."-".$month."-01");

        $date_max = date('Y-m-d H:i:s', strtotime('+1 month', $date_max));
        $date_min = date('Y-m-d H:i:s', $date_min);

        $query = Blog::select(['blog_translations.titulo', 'blog_translations.slug'])
                    ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                    ->where('blog_translations.locale',  LaravelLocalization::getCurrentLocale())
                    ->whereBetween('blog.created_at', [$date_min, $date_max]);

        return $query->get();
    }

    public static function getPrevPost($post){

        $query = Blog::select(['blog_translations.titulo', 'blog_translations.slug', 'blog_translations.slug', 'blog.created_at'])
                    ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                    ->where('blog_translations.locale',  LaravelLocalization::getCurrentLocale())
                    ->where('blog.created_at', '<', $post->created_at)
                    ->orderBy('blog.created_at', 'DESC');

        return $query->first();
    }

    public static function getNextPost($post){

        $query = Blog::select([ 'blog_translations.titulo', 
                                'blog_translations.slug', 
                                'blog_translations.slug', 
                                'blog.created_at' ])
                    ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                    ->where('blog_translations.locale',  LaravelLocalization::getCurrentLocale())
                    ->where('blog.created_at', '>', $post->created_at)
                    ->orderBy('blog.created_at', 'ASC');

        return $query->first();
    }

    public static function getMinMonth($year){

        $date_min = date('Y-m-d', strtotime($year."-01-01"));
        $date_max = date('Y-m-d', strtotime('+1 year', strtotime($year."-01-01")));

        $query = Blog::select(['created_at'])
                    ->whereBetween('created_at', [$date_min, $date_max])
                    ->orderBy('created_at', 'DESC')
                    ->first();
        if(count($query) == 0){
            return 0;
        }
        return explode("-", $query->created_at)[1];
    }

    public static function getMinYear(){

        $query = Blog::select(['created_at'])->orderBy('created_at', 'ASC')->first();

        return explode("-", $query->created_at)[0];
    }

    
     public static function getRouteBlog($id){
        if (true){
            $locale = 'en';
        }else{
            $locale = LaravelLocalization::getCurrentLocale();
        }
        $query = Blog::select([ 'blog_translations.titulo', 
                                'blog_translations.slug', 
                                'blog_translations.slug', 
                                'blog.created_at' ])
                    ->leftjoin('blog_translations', 'blog_translations.blog_id', '=', 'blog.id')
                    ->where('blog_translations.blog_id',  $id)
                    ->where('blog_translations.locale',  $locale)
                    ->first()->slug;
        if ($locale == LaravelLocalization::getCurrentLocale()){
            return '/es/blog/mostrar/'.$query;
        }else{
            return '/en/blog/show/'.$query;
        }
    }
    

    
}