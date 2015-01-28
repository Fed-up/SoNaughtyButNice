<?php

class PostsController extends \BaseController {

	protected $post;
	
	//Creating the constructor - Using the Post model 
	public function __construct(Post $post)
	{
		$this->post = $post;	
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = $this->post->all();
		return View::make('posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{ 
		$input = Input::all();
		$rules = array(
			'author' => 'required',
			'title' => 'required',
			'body' => 'required'
		);
		
		$v = Validator::make($input, $rules);
		
		if ($v->fails()){
			return Redirect::to('posts.create')->withErrors($v);
		};
		
		$post = new Post();
		$post->author = $input['author'];
		$post->title = $input['title'];
		$post->body = $input['body'];
		
		if($post->save()){	
			return Redirect::route('posts.index');
		} else {
			return Redirect::route('posts.create')
				->withInput()
				->withErrors($v)
				->with('message', 'There were save errors');
		};
			
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::findOrFail($id);
		return View::make('posts.show')
			->with('post',$post);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = $this->post->find($id);
		if(is_null($post))
		{
			return Redirect::route('posts.index');	
		}
		return View::make('posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Browsers can't read push and put methods *Hence _method*
		$input = array_except(input::all(), '_method');
		$v = Validator::make($input, Post::$rules);
		
		if($v->passes())
		{
			$post = $this->post->find($id);
			$post->update($input);
			
			return View::make('posts.show', $id);	
		}
		
		return Redirect::route('posts.edit')
			->withInput()
			->withErrors($v)
			->with('message', 'There were validation errors');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->post->find($id)->delete();
		return Redirect::route('posts.index');
	}

}