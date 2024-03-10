<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function allBlogCategory()
    {
        $categories = BlogCategory::latest()->get();
        return view('backend.blog.blog_category',compact('categories'));
    }


    public function storeBlogCategory(Request $request)
    {
        BlogCategory::insert([
            'category_name'=>$request->category_name,
            'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
        ]);
        $notification = array([
            "message"=>"category have created successfully",
            "alert-type"=>"success",
        ]);
        return redirect()->route('all.blog.category')->with($notification);
    }

    public function editBlogCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        return response()->json($category);
    }




    public function updateBlogCategory(Request $request)
    {
        $id = $request->cat_id;

        if (BlogCategory::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ])) {
            $notification = array([
                "message" => "Blog Category have updated successfully",
                "alert-type" => "success",
            ]);

            return redirect()->route('all.blog.category')->with($notification);
        }
    }




    public function deleteBlogCategory($id){


        $blogCategory = BlogCategory::findOrFail($id);

        $blogCategory->delete();

        $notification = array([
            "message"=>"Blog Category have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }


    public function allPost()
    {
        $posts = BlogPost::latest()->get();
        return view('backend.post.all_post',compact('posts'));
    }


    public function addPost()
    {
        $categories = BlogCategory::latest()->get();
        return view('backend.post.add_post',compact('categories'));
    }


    public function storePost(Request $request)
    {
        $image = $request->file('post_image');
        $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save(public_path('/uploade/post/' . $generatedName));
        $url = '/uploade/post/' . $generatedName;

        if(BlogPost::insert([
            'post_title'=>$request->post_title,
            'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
            'blogcat_id'=>$request->blogcat_id,
            'short_desc'=>$request->short_desc,
            'long_desc'=>$request->long_desc,
            'post_tags'=>$request->post_tags,
            'user_id'=>Auth::user()->id,
            'post_image'=>$url,
            'created_at'=>Carbon::now(),
        ])){

            $notification = array([
                "message"=>"post have created successfully",
                "alert-type"=>"success",
            ]);

            return redirect()->route('all.post')->with($notification);
        }
        $notification = array([
            "message"=>"post haven't created successfully",
            "alert-type"=>"danger",
        ]);

        return redirect()->route('all.post')->with($notification);
    }

    public function editPost($id){
        $post = BlogPost::findOrFail($id);
        $categories = BlogCategory::latest()->get();
        return view('backend.post.edit_post',compact('post','categories'));
    }


    public function updatePost(Request $request){
        $id = $request->id;

        if ($image = $request->file('post_image')) {
            $generatedName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(100, 100)->save(public_path('/uploade/post/' . $generatedName));
            $url = '/uploade/post/' . $generatedName;

            if(BlogPost::findOrFail($id)->update([
                'post_title'=>$request->post_title,
                'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
                'blogcat_id'=>$request->blogcat_id,
                'short_desc'=>$request->short_desc,
                'long_desc'=>$request->long_desc,
                'post_tags'=>$request->post_tags,
                'user_id'=>Auth::user()->id,
                'post_image'=>$url,
            ])) {
                $notification = array([
                    "message"=>"post have updated successfully",
                    "alert-type"=>"success",
                ]);

                return redirect()->route('all.post')->with($notification);
            }
        }
        BlogPost::findOrFail($id)->update([
            'post_title'=>$request->post_title,
            'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
            'blogcat_id'=>$request->blogcat_id,
            'short_desc'=>$request->short_desc,
            'long_desc'=>$request->long_desc,
            'post_tags'=>$request->post_tags,
            'user_id'=>Auth::user()->id,
        ]);
        $notification = array([
            "message"=>"post have updated successfully",
            "alert-type"=>"success",
        ]);
        return redirect()->route('all.post')->with($notification);

    }

    public function deletePost($id){


        $post = BlogPost::findOrFail($id);

        $img = '.'.$post->post_image;
//        dd ($img)   ;
        unlink($img);
        $post->delete();

        $notification = array([
            "message"=>"post have deleted successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }

    public function blogDetails($slug)
    {
//        dd($slug);
        $blog = BlogPost::where('post_slug',$slug)->first();
        $tags = explode(',' , $blog->post_tags);
        $categories = BlogCategory::latest()->get();
        $dposts = BlogPost::latest()->limit(3)->get();
//        dd($blog);
        return view('frontend.blog.blog_details',compact('blog','tags','categories','dposts'));
    }


    public function blogCategoryList($id)
    {
        $posts = BlogPost::where('blogcat_id',$id)->get();
        $ycategory = BlogCategory::where('id',$id)->first();
        $categories = BlogCategory::latest()->get();
        $dposts = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_cat_list',compact('posts','ycategory','categories','dposts'));
    }


    public function blogList()
    {
        $posts = BlogPost::latest()->get();
        $categories = BlogCategory::latest()->get();
        $dposts = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_list',compact('posts','categories','dposts'));
    }

    public function storeComment(Request $request)
    {
        Comment::insert([
            'post_id'=>$request->post_id,
            'user_id'=>Auth::user()->id,
            'parent_id'=>null,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            ]);

        $notification = array([
            "message"=>"Comment have been sent successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);

    }


    public function adminBlogComment()
    {
        $comments = Comment::where('parent_id',null)->get();
        return view('backend.comment.all_comment',compact('comments'));
    }


    public function adminCommentReply($id)
    {
        $comment = Comment::where('id',$id)->first();
        return view('backend.comment.reply_comment',compact('comment'));
    }


    public function commentReply(Request $request)
    {
        Comment::insert([
            'post_id'=>$request->post_id,
            'user_id'=>$request->user_id,
            'parent_id'=>$request->id,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array([
            "message"=>"Reply have been sent successfully",
            "alert-type"=>"success",
        ]);

        return redirect()->back()->with($notification);
    }


}
