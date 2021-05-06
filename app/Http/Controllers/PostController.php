<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Helpers\Helper;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $posts = Post::all();
        $posts = Post::orderBy('id', 'desc')->get();
        return view('post.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            '_file' => 'Image|nullable|max:1999'
       ]);

       $path = 'uploads/';
       //$test = $request->file('_file')->getClientOriginalName();
       $image = $request->_file;
       $filenameWithExt= $image->getClientOriginalName();

        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

         //GET JUST EXT
         $extension = $request->file('_file')->getClientOriginalExtension();

         //filename to store
         $filenameToStore = $filename .'_'.time().'.'.$extension;
       
       $image_resize = Image::make($image->getRealPath())->fit(280, 280);
       //$image_resize->save(public_path('uploads/'.$filename));


        $newname = Helper::renameFile($path, $filenameToStore);
        $upload = $image_resize->save(public_path($path.$newname));

         //$image = Image::make(public_path("public/{$upload}"))->fit(1200, 1200);
         // $image_resize->save();

       if ($upload) {

            $post = new Post;
            // $post->code = Str::random(8);
            $post->name = $request->input('name');
            $post->email= $request->input('email');
            $post->_file = $newname;
            $post->save();

         return back()->with('success', 'Post created');
       } else {
        echo 'error';
       }


            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Post::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Post::where('slug', '!=', $slug)->mightAlsoLike()->get();

         //$stockLevel = getStockLevel($product->quantity);

        return view('product')->with([
            'product' => $product,
           // 'stockLevel' => $stockLevel,
            'mightAlsoLike' => $mightAlsoLike,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit')->with('posts', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            '_file' => 'Image|nullable|max:1999'
       ]);
   

           $path = 'uploads/';
       //$test = $request->file('_file')->getClientOriginalName();
       $image = $request->_file;
       $filenameWithExt= $image->getClientOriginalName();

        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

         //GET JUST EXT
         $extension = $request->file('_file')->getClientOriginalExtension();

         //filename to store
         $filenameToStore = $filename .'_'.time().'.'.$extension;
       
       $image_resize = Image::make($image->getRealPath())->fit(280, 280);
       //$image_resize->save(public_path('uploads/'.$filename));


        $newname = Helper::renameFile($path, $filenameToStore);
        $upload = $image_resize->save(public_path($path.$newname));

       $post = post::find($request->id);
       $post->name = $request->input('name');
        if ($request->hasFile('_file')) {
            $post->_file = $newname;
        }
        $post->save();

         return back()->with('success', 'Product Updated');
    }

    public function searchProduct(){
        return view('api.search');
    }

    public function search(Request $request) 
    {
       $request->validate([
           'query' => 'required|min:3',
       ]);

       $query = $request->input('query');

       $products = Post::where('name', 'like', "%$query%")
                          ->orWhere('email', 'like', "%$query%")
                          ->orWhere('_file', 'like', "%$query%")
                          ->paginate(1);
        //$products = Product::search($query)->paginate(1);

       return view('api.search-result')->with('products', $products);
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // if(auth()->user()->id !== $post->user_id){
        //     return redirect('/post/index')->with('error', 'Unauthorize access');
        // }
        $post->delete();
        return redirect('/post/index')->with('success', 'Deleted');
    }

    public function single() {

        return view('single');
      }
    
    
    public function singlebreed(Request $request) {

        $slug = $request->input('query');
      
      $data = Http::get('http://api.giphy.com/v1/gifs/search?q={slug}&api_key=4iFFHYWpWiiEC38nzwVO4jW4cWSb5aBT&limit=5')->json();
      return view('profiles', ['data' => $data['data']]);
    }

    
}
