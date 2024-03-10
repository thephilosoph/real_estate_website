@extends('frontend.frontend_dashboard')
@section('main')

<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-9.png')}});"></div>
        <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-10.png')}});"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{$state->state_name}} Property List</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>{{$state->state_name}} Property List</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- property-page-section -->
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="default-sidebar property-sidebar">
                    <div class="filter-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Property</h5>
                        </div>
                        @php
                            $states = App\Models\State::latest()->get();
                            $types = App\Models\PropertyType::latest()->get();
                        @endphp
                        <form action="{{route('all.property.search')}}" method="post" class="search-form">
                            @csrf
                            <div class="widget-content">
                                <div class="select-box">
                                    <select name="pstatus" class="wide">
                                        <option data-display="All Type">All Status</option>
                                        <option value="rent">Rent</option>
                                        <option value="buy">Buy</option>
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select name="pstate" class="wide">
                                        <option data-display="Select Location" selected disabled>Select Location</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->state_name}}">{{$state->state_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select name="ptype" class="wide">
                                        <option data-display="Select Type" selected disabled>Select Type</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->name}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select name="rooms_number" class="wide">
                                        <option data-display="Max Rooms">Max Rooms</option>
                                        <option value="1">1 Room</option>
                                        <option value="2">2 Rooms</option>
                                        <option value="3">3 Rooms</option>
                                        <option value="4">4 Rooms</option>
                                        <option value="5">5 Rooms</option>
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select name="bathrooms_number" class="wide">
                                        <option  data-display="Max Bathrooms">Max Bathrooms</option>
                                        <option value="1">1 Bathroom</option>
                                        <option value="2">2 Bathrooms</option>
                                        <option value="3">3 Bathrooms</option>
                                        <option value="4">4 Bathrooms</option>
                                        <option value="5">5 Bathrooms</option>
                                    </select>
                                </div>

                                <div class="filter-btn">
                                    <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="price-filter sidebar-widget">
                        <div class="widget-title">
                            <h5>Select Price Range</h5>
                        </div>
                        <div class="range-slider clearfix">
                            <div class="clearfix">
                                <div class="input">
                                    <input type="text" class="property-amount" name="field-name" readonly="">
                                </div>
                            </div>
                            <div class="price-range-slider"></div>
                        </div>
                    </div>
                    <div class="category-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Status Of Property</h5>
                        </div>
                        <ul class="category-list clearfix">
                            <li><a href="{{route('rent.property')}}">For Rent <span>({{$forRent}})</span></a></li>
                            <li><a href="{{route('buy.property')}}">For Buy <span>({{$forBuy}})</span></a></li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left">
                            <h5>Search Reasults: <span>Showing {{count($properties)}} Listings</span></h5>
                        </div>
                        <div class="right-column pull-right clearfix">


                        </div>
                    </div>
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">



                            @foreach ($properties as $property)

                            <div class="deals-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        @if ($property->user->role == 'agent')

                                        <figure class="author-thumb"><img src="{{(!empty($property->user->photo)) ? url('uploade/agent_images/'.$property->user->photo) : url('uploade/no_image.jpg')}}" alt=""></figure>
                                        @else

                                        <figure class="author-thumb"><img src="{{(!empty($property->user->photo)) ? url('uploade/user_images/'.$property->user->photo) : url('uploade/no_image.jpg')}}" alt=""></figure>
                                        @endif

                                        <div class="batch"><i class="icon-11"></i></div>
                                        @if ($property->featured == 'featured')
                                        <span class="category">Featured</span>
                                        @else
                                        <span class="category">New</span>
                                        @endif

                                        <div class="buy-btn"><a href="property-details.html">For {{$property->property_status}}</a></div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="title-text"><h4><a href="property-details.html">{{$property->property_name}}</a></h4></div>
                                        <div class="price-box clearfix">
                                            <div class="price-info pull-left">
                                                <h6>Start From</h6>
                                                <h4>${{$property->min_price}}</h4>
                                            </div>
                                            <div class="author-box pull-right">
                                                <figure class="author-thumb">
                                                    <img class="wd-100 rounded-circle" src="{{(!empty($property->user->photo)) ? url('uploade/agent_images/'.$property->user->photo) : url('uploade/no_image.jpg')}}" alt="profile">
                                                    <span>{{$property->user->name}}</span>
                                                </figure>
                                            </div>
                                        </div>
                                        <p>{{$property->short_description}}</p>
                                        <ul class="more-details clearfix">
                                            <li><i class="icon-14"></i>{{$property->bedrooms}} Beds</li>
                                            <li><i class="icon-15"></i>{{$property->bathrooms}} Baths</li>
                                            <li><i class="icon-16"></i>{{$property->property_size}} Sq Ft</li>
                                        </ul>
                                        <div class="other-info-box clearfix">
                                            <div class="btn-box pull-left"><a href="{{url('property/details/'.$property->id.'/'.$property->property_slug)}}" class="theme-btn btn-two">See Details</a></div>
                                            <ul class="other-option pull-right clearfix">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>

                    </div>
                    <div class="pagination-wrapper">
                        {{$properties->links('vendor.pagination.custom')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->


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


@endsection
