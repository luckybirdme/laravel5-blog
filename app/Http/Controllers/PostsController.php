<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Posts;
use App\User;
use Auth;
use Gate;
use Form;
use App\Categories;
use App\Tags;
use App\PostsTags;
use Image;
use App\HtmlMarkdown\HtmlMarkdownConvertor;
use Purifier;
use App\Comments;

class PostsController extends Controller
{
    protected $htmlMarkdownConvertor;


    public function __construct(HtmlMarkdownConvertor $htmlMarkdownConvertor)
    {
        $this->htmlMarkdownConvertor = $htmlMarkdownConvertor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected $per_page = '5';

    public function getCreate()
    {
        //
        $page_title = 'Create Post';

        $categories = Categories::all();
        $tags = Tags::all();

        $data = compact('page_title','categories','tags');

        return view('posts.create',$data);
    }

    public function postCreate(Request $request){

        $all = $request->all();
        $validator = Validator::make($all, [
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required'        
        ]);
        if(isset($all['active'])){
            $all['active'] = true;
        }else{
            $all['active'] = false;
        }


        if ($validator->fails()) {
            
            $page_title = 'Create Post';
            $categories = Categories::all();
            $tags = Tags::all();

            $data = compact('page_title','categories','tags');
            return view('posts.create',$data)
                ->withErrors($validator->errors());
   
        }



        $user = Auth::user();
        $markdown_content = $all['content'];
        $html_content = $this->htmlMarkdownConvertor->convertMarkdownToHtml($markdown_content);

        $post = Posts::create([
            'title' => $all['title'],
            'content' => $html_content,
            'markdown_content' => $markdown_content,
            'active' => $all['active'],
            'user_id' => $user->id,
            'category_id' => $all['category_id']
        ]); 

        $this->savePostsTags($all['tags'],$post->id);


        return redirect(route('getPostPage'));

    }


    private function savePostsTags($data,$post_id){
        $tags = explode(',', $data);

        foreach ($tags as $tag) {
            $normalized = $this->strtoupperForCN($tag);
            $tag_ref = Tags::where('normalized',$normalized)->first();
            if(is_null($tag_ref)) {
                $tag_ref = Tags::create([
                    'name' => $tag,
                    'normalized' => $normalized
                ]);
            } 

            $posts_tags = PostsTags::where('post_id',$post_id)->where('tag_id',$tag_ref->id)->first();
            if(is_null($posts_tags)){
                $posts_tags = PostsTags::create([
                    'post_id' => $post_id,
                    'tag_id' => $tag_ref->id
                ]);
            }

        }
    }

    private function strtoupperForCN($a){  
        $b = str_split($a, 1);  
        $r = '';  
        foreach($b as $v){  
            $v = ord($v);  
            if($v >= 97 && $v<= 122){  
                $v -= 32;  
            }  
            $r .= chr($v);  
        }  
        return $r;  
    }




    public function getPage(){

        $page_title = 'All Posts';
        $posts = Posts::where('active',1)->orderBy('updated_at', 'desc')->paginate($this->per_page);

        $data = compact('posts','page_title');
        return view('posts.page',$data);
    }


    public function getShow($id = null){

        $post = Posts::findOrFail($id);
        $page_title = $post->title;
        
        $data = compact('post','page_title');
        return view('posts.show',$data);
    }

    public function getMine(){
        $user = Auth::user();
        $posts = $user->posts()
            ->orderBy('updated_at', 'desc')
            ->paginate($this->per_page);
        $page_title = 'My Posts';
        $data = compact('posts','page_title');
        return view('posts.page',$data);       
    }


    public function getUserPost($id = null){
        $user = User::findOrFail($id);
        $page_title = $user->name;
        $posts = $user->posts()
            ->where('active',1)
            ->orderBy('updated_at', 'desc')
            ->paginate($this->per_page);

        $data = compact('posts','page_title');
        return view('posts.page',$data);

    }

    public function getCategoryPost($id = null){
        $category = Categories::findOrFail($id);
        $page_title = $category->name;
        $posts = $category->posts()
            ->where('active',1)
            ->orderBy('updated_at', 'desc')
            ->paginate($this->per_page);

        $data = compact('posts','page_title');
        return view('posts.page',$data);

    }

    public function getTagPost($id = null){
        $tag = Tags::findOrFail($id);
        $page_title = $tag->name;
        $posts = $tag->posts()
            ->where('active',1)
            ->orderBy('updated_at', 'desc')
            ->paginate($this->per_page);


        $data = compact('posts','page_title');
        return view('posts.page',$data);

    }


    public function getUpdate(Request $request,$id = null){
        $post = Posts::findOrFail($id);
        $tags = $post->tags;

        if (Gate::denies('update-post', $post)) {
            return redirect(route('home'));
        }

        $html_content = $post->content;
        $markdown_content = $post->markdown_content;
        if(empty($markdown_content) && $html_content){
            $markdown_content = $this->htmlMarkdownConvertor->convertHtmlToMarkdown($html_content);
        }

        $page_title = 'Edit Post';
        $request->offsetSet('id', $post->id);
        $request->offsetSet('title', $post->title);
        $request->offsetSet('content', $markdown_content);
        $request->offsetSet('active',$post->active);
        $request->offsetSet('category_id',$post->category_id);
        if(count($tags) > 0){
            $taglist="";
            foreach ($tags as $tag) {
                $taglist .= $tag->name.',';
            }
            $request->offsetSet('tags',$taglist);
        }else{
            $request->offsetSet('tags','');
        }
        


        $categories = Categories::all();
        $tags = Tags::all();

        $data = compact('page_title','categories','tags');

        return view('posts.edit',$data);
    }


    public function postUpdate(Request $request){
        

        $all = $request->all();
        $validator = Validator::make($all, [
            'id' => 'required',
            'title' => 'required|max:255',
            'content' => 'required'        
        ]);   
        if(isset($all['active'])){
            $all['active'] = true;
        }else{
            $all['active'] = false;
        }

        if ($validator->fails()) {
            $page_title = 'Edit Post';
            $categories = Categories::all();
            $tags = Tags::all();

            $data = compact('page_title','categories','tags');
            return view('posts.edit',$data)
                ->withErrors($validator->errors());
   
        }
        $post = Posts::findOrFail($all['id']);

        $markdown_content = $all['content'];
        $html_content = $this->htmlMarkdownConvertor->convertMarkdownToHtml($markdown_content);

        $post->title = $all['title'];
        $post->content = $html_content;
        $post->markdown_content = $markdown_content;
        $post->active = $all['active'];
        $post->category_id = $all['category_id'];

        if (Gate::allows('update-post', $post)) {
            $post->save();
            $this->savePostsTags($all['tags'],$post->id);
        }
        
        return redirect(route('getPostPage'));

    }


    public function getDelete($id = null){
        $post = Posts::findOrFail($id);
        if (Gate::allows('update-post', $post)) {
            $post->delete();
        }
        return redirect(route('getPostPage'));
    }


    public function uploadPostImage(Request $request){
        $data = [
            'success' => false,
            'msg' => 'Failed!',
            'file_path' => ''
        ];


        if($request->hasFile('imageLocalInput')){
            $file = $request->file('imageLocalInput');
            $fileName        = $file->getClientOriginalName();
            $ext_array = array(
                'png',
                'jpg',
                'jpeg',
                'gif');
                
            $extension       = $file->getClientOriginalExtension();
            if(in_array($extension, $ext_array)){
                $folderName      = '/upload/images/' . date("Ym", time()) .'/'.date("d", time()) .'/'. Auth::user()->id.'/';
    
                $destinationPath = public_path() . $folderName;
                $safeName        = str_random(10).'.'.$extension;
    
                $localFullPath   = $destinationPath . $safeName;
                $httpFullPath    = route('home') . $folderName . $safeName;
    
                $file->move($destinationPath, $safeName);
    
                $img = Image::make($localFullPath);
    
                $height = $img->height();
                $width = $img->width();
    
                if($width > 900){
                    $resize_width = 900;
                    $resize_heigth = $height*900/$width;
    
                    $resize_safeName = $resize_width."X".$resize_heigth."_".$safeName;
                    $resize_localFullPath = $destinationPath.$resize_safeName;
                    $img->resize($resize_width, $resize_heigth)->save($resize_localFullPath);
    
                    $httpFullPath = route('home') . $folderName . $resize_safeName;
    
                }
    
                $data['file_path'] = $httpFullPath;
                $data['msg'] = "Succeeded!";
                $data['success'] = true;                
            }

        }
        
        return $data;
    }

    function postComment(Request $request){
        $all = $request->all();
        $validator = Validator::make($all, [
            'comment' => 'required'
        ]); 

        if ($validator->fails()) {
            $id = $all['id'];
            $post = Posts::findOrFail($id);
            $page_title = $post->title;
            
            $data = compact('post','page_title');

            return view('posts.show',$data)
                ->withErrors($validator->errors());
   
        }  

        $comment = Purifier::clean($all['comment'], 'markdown');;
        $user_id = Auth::user()->id;
        $post_id = $all['id'];

        $post = Comments::create([
            'comment' => $comment,
            'post_id' => $post_id,
            'user_id' => $user_id

        ]); 


        return redirect(route('getPostShow',$post_id));


    }



}
