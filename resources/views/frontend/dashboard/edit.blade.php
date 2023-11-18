@extends('frontend.frontend_dashboard')
@section('main')
@php
    $user = Auth::user();
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!--Page Title-->
  <section class="page-title centred" style="background-image: url({{asset('frontend/assets/images/background/page-title-5.jpg')}});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>User Profile </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>User Profile </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            








<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="blog-sidebar">
      <div class="sidebar-widget post-widget">
            <div class="widget-title">
                <h4>User Profile </h4>
            </div>
            <div class="post-inner">
                <div class="post">
                    <figure class="post-thumb"><a href="blog-details.html">
<img src="{{(!empty($user->photo)) ? url('uploade/user_images/'.$user->photo) : url('uploade/no_image.jpg')}}" alt=""></a></figure>
<h5><a href="blog-details.html">{{$user->name}} </a></h5>
 <p>{{$user->email}}</p>
                </div> 
            </div>
        </div> 

<div class="sidebar-widget category-widget">
    <div class="widget-title">
        
    </div>
    @include('frontend.dashboard.sidebar')

  </div> 
                 
                </div>
            </div>




<div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            
                            <div class="lower-content">
                                <h3>Including Animation In Your Design System.</h3>
                             
                              
  
<form action="{{route('user.profile.update')}}" method="post" class="default-form" enctype="multipart/form-data">
    @csrf
<div class="form-group">
    <label for="name" class="form-label">Name</label>
    <input name="name" type="text" class="form-control" id="name" autocomplete="off" value="{{$user->name}}">
</div>
<div class="form-group">
    <label for="username" class="form-label">Username</label>
    <input name="username" type="text" class="form-control" id="username" autocomplete="off" value="{{$user->username}}">
</div>
<div class="form-group">
    <label for="phone" class="form-label">Phone</label>
    <input name="phone" type="text" class="form-control" id="phone" autocomplete="off" value="{{$user->phone}}">
</div>
<div class="form-group">
    <label for="address" class="form-label">address</label>
    <input name="address" type="text" class="form-control" id="address" autocomplete="off" value="{{$user->address}}">
</div>
<div class="form-group">
    <label for="photo" class="form-label">Photo</label>
    <input name="photo" type="file" class="form-control" id="image" >
</div>
<div class="form-group">

<label for="photoInput" class="form-label"> </label>
<img src="{{(!empty($user->photo)) ? url('uploade/user_images/'.$user->photo) : url('uploade/no_image.jpg')}}" type="file" class="wd-80 rounded-circle" id="showImage" alt="profile image">
</div>

<div class="form-group message-btn">
    <button type="submit" class="theme-btn btn-one">Save Changes </button>
</div>
</form>



                            </div>
                        </div>
                    </div>
                     
                    
                </div>


            </div> 


        </div>
    </div>
</section>
<!-- sidebar-page-container -->

<!-- subscribe-section -->
<section class="subscribe-section bg-color-3">
    <div class="pattern-layer" style="background-image: url({{asset('frontend/assets/images/shape/shape-2.png')}});"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                <div class="text">
                    <span>Subscribe</span>
                    <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                <div class="form-inner">
                    <form action="contact.html" method="post" class="subscribe-form">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter your email" required="">
                            <button type="submit">Subscribe Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subscribe-section end -->


<script type="text/javascript">
    $(document).ready(function () {
      $('#image').change(function (e) {
    var reader = new FileReader();
    reader.onload = function(e){
      $("#showImage").attr('src',e.target.result);
    }
    reader.readAsDataURL(e.target.files['0']);
      })
    })
    </script>
    
@endsection
