@php
    $properties = App\Models\Property::where('status',1)->where("featured",1)->limit(3)->get();
@endphp
<section class="feature-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Features</h5>
            <h2>Featured Property</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
        </div>
        <div class="row clearfix">

@foreach ($properties as $property)
    
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="{{asset($property->property_thumbnail)}}" alt=""></figure>
                            <div class="batch"><i class="icon-11"></i></div>
                            <span class="category">Featured</span>
                        </div>
                        <div class="lower-content">
                            <div class="author-info clearfix">
                                <div class="author pull-left">
                                    @if ($property->user->role == 'agent')
                                        
                                    <figure class="author-thumb"><img src="{{(!empty($property->user->photo)) ? url('uploade/agent_images/'.$property->user->photo) : url('uploade/no_image.jpg')}}" alt=""></figure>
                                    @else
                                        
                                    <figure class="author-thumb"><img src="{{(!empty($property->user->photo)) ? url('uploade/user_images/'.$property->user->photo) : url('uploade/no_image.jpg')}}" alt=""></figure>
                                    @endif
                                    <h6>{{$property->user->name}}</h6>
                                </div>
                                <div class="buy-btn pull-right"><a href="{{url('property/details/'.$property->id .'/'.$property->property_slug)}}">For {{Str::upper($property->property_status)}}</a></div>
                            </div>
                            <div class="title-text"><h4><a href="{{url('property/details/'.$property->id .'/'.$property->property_slug)}}">{{$property->property_name}}</a></h4></div>
                            <div class="price-box clearfix">
                                <div class="price-info pull-left">
                                    <h6>Start From</h6>
                                    <h4>${{$property->min_price}}</h4>
                                </div>
                                <ul class="other-option pull-right clearfix">
                                    <li><a aria-label="Add to Compare list" class="action-btn" id="{{$property->id}}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>
                                    <li><a aria-label="Add to wish list" class="action-btn" id="{{$property->id}}" onclick="addToWishlist(this.id)"><i class="icon-13"></i></a></li>
                                </ul>
                            </div>
                            <p>{{$property->short_description}}</p>
                            <ul class="more-details clearfix">
                                <li><i class="icon-14"></i>{{$property->bedrooms}} Beds</li>
                                <li><i class="icon-15"></i>{{$property->bathrooms}} Baths</li>
                                <li><i class="icon-16"></i>{{$property->property_size}} Sq Ft</li>
                            </ul>
                            <div class="btn-box"><a href="{{url('property/details/'.$property->id .'/'.$property->property_slug)}}" class="theme-btn btn-two">See Details</a></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


            
        </div>
        <div class="more-btn centred"><a href="property-list.html" class="theme-btn btn-one">View All Listing</a></div>
    </div>
</section>