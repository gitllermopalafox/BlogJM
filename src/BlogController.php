<?php namespace Machaen\Blog;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Machaen\Blog\Blog;

class BlogController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$posts 			= Blog::getPosts();
		$tags 			= Blog::getTags();
		$years			= HelpersMachaen::getYearsPost();

		return view('packages::index', [	'posts' 		=> $posts, 
											'tags' 			=> $tags,
											'years'			=> $years 
											]);
	}

	public function show($slug)
	{
		$post 			= Blog::getPostBySlug($slug);
		$tags 			= Blog::getTags();
		$post_recent 	= Blog::getPostRecent(2);
		$post_relation 	= Blog::getPostRecent(2);
		$years			= HelpersMachaen::getYearsPost();

		if (!isset($post->titulo)){
			abort('404');
		}

		return view('packages::show', [	'post' 			=> $post, 
										'tags' 			=> $tags, 
										'post_recent' 	=> $post_recent, 
										'post_relation' => $post_relation,
										'years'			=> $years ]);
	}
}
