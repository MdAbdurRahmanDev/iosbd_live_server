@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Setting</h2>
    </div>
    <div class="">
    	<form method="post" action="{{ route('update.setting') }}" enctype="multipart/form-data">
	    	@csrf
		    <div class="row">
	            <div class="col-md-7">
					<div class="card">
						<div class="card-header">
							<h3>General Settings</h3>
						</div>
				        <div class="card-body">
	                    	<div class="row">
	                    		<div class="col-sm-6 mb-3">
		                           <label for="site_name" class="col-form-label" style="font-weight: bold;">Site Name :</label>
		                           	<input type="hidden" name="types[]" value="site_name">
		                            <input class="form-control" type="text" name="site_name" id="site_name" placeholder="Write Site name" value="{{ get_setting('site_name')->value ?? '' }}">
		                            @error('site_name')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           <label for="business_name" class="col-form-label" style="font-weight: bold;">Business Name :</label>
		                           	<input type="hidden" name="types[]" value="business_name">
		                            <input class="form-control" type="text" name="business_name" id="business_name" placeholder="Write Site name" value="{{ get_setting('business_name')->value ?? '' }}">
		                            @error('business_name')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           <label for="phone" class="col-form-label" style="font-weight: bold;">Phone :</label>
		                           <input type="hidden" name="types[]" value="phone">
		                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Write phone" value="{{ get_setting('phone')->value ?? '' }}">
		                            @error('phone')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           <label for="email" class="col-form-label" style="font-weight: bold;">Email :</label>
		                           <input type="hidden" name="types[]" value="email">
		                            <input class="form-control" type="text" name="email" id="email" placeholder="Write email" value="{{ get_setting('email')->value ?? '' }}">
		                            @error('phone')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>
	                    	</div>
	                    	<!-- Row End -->
	                    	<div class="row">
				        		<div class="col-sm-6 mb-3">
		                           	<label for="business_hours" class="col-form-label" style="font-weight: bold;">Business Hours</label>
		                           	<input type="hidden" name="types[]" value="business_hours">
		                           	<input class="form-control" type="text" name="business_hours" placeholder="business hours" value="{{ get_setting('business_hours')->value ?? '' }}">
		                           	@error('business_hours')
		                               	<p class="text-danger">{{$message}}</p>
		                           	@enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           	<label for="copy_right" class="col-form-label" style="font-weight: bold;">Copy Right</label>
		                           	<input type="hidden" name="types[]" value="copy_right">
		                           	<input class="form-control" type="text" name="copy_right" placeholder="copy right" value="{{ get_setting('copy_right')->value ?? '' }}">
		                           	@error('copy_right')
		                               	<p class="text-danger">{{$message}}</p>
		                           	@enderror
		                        </div>

				        		<div class="col-sm-12 mb-3">
		                           <label for="business_address" class="col-form-label" style="font-weight: bold;">Address</label>
		                           <input type="hidden" name="types[]" value="business_address">
		                           <textarea class="form-control" id="business_address" cols="2" name="business_address" placeholder="Write address here">{{ get_setting('business_address')->value ?? '' }}</textarea>
		                            @error('business_address')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>
                                <div class="col-sm-12 mb-3">
                                    <label for="short_description" class="col-form-label" style="font-weight: bold;">Short Bio</label>
                                    <input type="hidden" name="types[]" value="short_description">
                                    <textarea class="form-control" id="short_description" cols="2" name="short_description" placeholder="Write short description about your company">{{ get_setting('short_description')->value ?? '' }}</textarea>
                                    @error('short_description')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label for="homepage_description" class="col-form-label" style="font-weight: bold;">Homepage Marquee Text</label>
                                    <input type="hidden" name="types[]" value="homepage_description">
                                    <textarea class="form-control" id="homepage_description" cols="2" name="homepage_description" placeholder="Write marquee text of home page">{{ get_setting('homepage_description')->value ?? '' }}</textarea>
                                    @error('homepage_description')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                
                          <!--      <div class="col-sm-12 mb-3">-->
		                        <!--   	<label for="copy_right" class="col-form-label" style="font-weight: bold;">Intro Yoututbe Video Code</label>-->
		                        <!--   	<input type="hidden" name="types[]" value="intro_youtube_video_code">-->
		                        <!--   	<input class="form-control" type="text" name="intro_youtube_video_code" placeholder="Youtube video code" value="{{ get_setting('intro_youtube_video_code')->value ?? '' }}">-->
		                        <!--   	@error('intro_youtube_video_code')-->
		                        <!--       	<p class="text-danger">{{$message}}</p>-->
		                        <!--   	@enderror-->
		                        <!--</div>-->
				        	</div>
				        	<!-- Row End// -->
				        	<hr>
				        	<div class="row">
				        	    <!--<div class="col-sm-6 mb-3">-->
		               <!--            	<label for="is_free_shipping_available" class="col-form-label" style="font-weight: bold;">Free Shipping</label>-->
		               <!--            	<input type="hidden" name="types[]" value="is_free_shipping_available">-->
		               <!--            	<select class="form-select" name="is_free_shipping_available">-->
		               <!--            	    <option value="1" {{ get_setting('is_free_shipping_available')->value==1 ?? 'selected' }}>Available</option>-->
		               <!--            	    <option value="0" {{ get_setting('is_free_shipping_available')->value==0 ?? 'selected' }}>Unavailable</option>-->
		               <!--            	</select>-->
		               <!--            	@error('is_free_shipping_available')-->
		               <!--                	<p class="text-danger">{{$message}}</p>-->
		               <!--            	@enderror-->
		               <!--         </div>-->
		               <!--         <div class="col-sm-6 mb-3">-->
		               <!--            	<label for="free_shipping_purchase_amount" class="col-form-label" style="font-weight: bold;">Purchase Amount For Free Shipping</label>-->
		               <!--            	<input type="hidden" name="types[]" value="free_shipping_purchase_amount">-->
		               <!--            	<input class="form-control" type="text" name="free_shipping_purchase_amount" placeholder="Purchase amount for free shipping" value="{{ get_setting('free_shipping_purchase_amount')->value ?? '0' }}">-->
		               <!--            	@error('free_shipping_purchase_amount')-->
		               <!--                	<p class="text-danger">{{$message}}</p>-->
		               <!--            	@enderror-->
		               <!--         </div>-->
				        	    <div class="col-sm-6 mb-3">
                                    <label for="standard_delivery_charge" class="col-form-label" style="font-weight: bold;">Standard Delivery Charge</label>
                                    <input type="hidden" name="types[]" value="standard_delivery_charge">
                                    <input class="form-control" type="number" name="standard_delivery_charge" id="standard_delivery_charge" placeholder="Standard delivery charge" value="{{ get_setting('standard_delivery_charge')->value ?? '' }}">
                                    @error('standard_delivery_charge')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="standard_delivery_time" class="col-form-label" style="font-weight: bold;">Standard Delivery Time</label>
                                    <input type="hidden" name="types[]" value="standard_delivery_time">
                                    <input class="form-control" type="text" name="standard_delivery_time" id="standard_delivery_time" placeholder="Standard delivery time" value="{{ get_setting('standard_delivery_time')->value ?? '' }}">
                                    @error('standard_delivery_time')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        		<div class="col-sm-6 mb-3">
                                    <label for="pinterest_url" class="col-form-label" style="font-weight: bold;">Order Return Duration (Days)</label>
                                    <input type="hidden" name="types[]" value="order_return_duration">
                                    <input class="form-control" type="number" name="order_return_duration" id="order_return_duration" placeholder="Write rrder return duration" value="{{ get_setting('order_return_duration')->value ?? '' }}">
                                    @error('order_return_duration')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	</div>
				        	<hr>
				        	<div class="row">
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_1_icon" class="col-form-label" style="font-weight: bold;">Feature 1 Icon (fa-class)</label>
                                    <input type="hidden" name="types[]" value="footer_feature_1_icon">
                                    <input class="form-control" type="text" name="footer_feature_1_icon" id="footer_feature_1_icon" placeholder="Feature 1 icon fa-class" value="{{ get_setting('footer_feature_1_icon')->value ?? '' }}">
                                    @error('footer_feature_1_icon')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_1_title" class="col-form-label" style="font-weight: bold;">Feature 1 Title</label>
                                    <input type="hidden" name="types[]" value="footer_feature_1_title">
                                    <input class="form-control" type="text" name="footer_feature_1_title" id="footer_feature_1_title" placeholder="Feature 1 title" value="{{ get_setting('footer_feature_1_title')->value ?? '' }}">
                                    @error('footer_feature_1_title')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_1_subtitle" class="col-form-label" style="font-weight: bold;">Feature 1 Subtitle</label>
                                    <input type="hidden" name="types[]" value="footer_feature_1_subtitle">
                                    <input class="form-control" type="text" name="footer_feature_1_subtitle" id="footer_feature_1_subtitle" placeholder="Feature 1 subtitle" value="{{ get_setting('footer_feature_1_subtitle')->value ?? '' }}">
                                    @error('footer_feature_1_subtitle')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_1_link" class="col-form-label" style="font-weight: bold;">Feature 1 Link</label>
                                    <input type="hidden" name="types[]" value="footer_feature_1_link">
                                    <input class="form-control" type="text" name="footer_feature_1_link" id="footer_feature_1_link" placeholder="Feature 1 link" value="{{ get_setting('footer_feature_1_link')->value ?? '' }}">
                                    @error('footer_feature_1_link')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	</div>
				        	<hr>
				        	<div class="row">
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_2_icon" class="col-form-label" style="font-weight: bold;">Feature 2 Icon (fa-class)</label>
                                    <input type="hidden" name="types[]" value="footer_feature_2_icon">
                                    <input class="form-control" type="text" name="footer_feature_2_icon" id="footer_feature_2_icon" placeholder="Feature 2 icon fa-class" value="{{ get_setting('footer_feature_2_icon')->value ?? '' }}">
                                    @error('footer_feature_2_icon')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_2_title" class="col-form-label" style="font-weight: bold;">Feature 2 Title</label>
                                    <input type="hidden" name="types[]" value="footer_feature_2_title">
                                    <input class="form-control" type="text" name="footer_feature_2_title" id="footer_feature_2_title" placeholder="Feature 2 title" value="{{ get_setting('footer_feature_2_title')->value ?? '' }}">
                                    @error('footer_feature_2_title')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_2_subtitle" class="col-form-label" style="font-weight: bold;">Feature 1 Subtitle</label>
                                    <input type="hidden" name="types[]" value="footer_feature_2_subtitle">
                                    <input class="form-control" type="text" name="footer_feature_2_subtitle" id="footer_feature_2_subtitle" placeholder="Feature 2 subtitle" value="{{ get_setting('footer_feature_2_subtitle')->value ?? '' }}">
                                    @error('footer_feature_2_subtitle')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
					            <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_2_link" class="col-form-label" style="font-weight: bold;">Feature 2 Link</label>
                                    <input type="hidden" name="types[]" value="footer_feature_2_link">
                                    <input class="form-control" type="text" name="footer_feature_2_link" id="footer_feature_2_link" placeholder="Feature 2 link" value="{{ get_setting('footer_feature_2_link')->value ?? '' }}">
                                    @error('footer_feature_2_link')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	</div>
				        	<hr>
				        	<div class="row">
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_3_icon" class="col-form-label" style="font-weight: bold;">Feature 3 Icon (fa-class)</label>
                                    <input type="hidden" name="types[]" value="footer_feature_3_icon">
                                    <input class="form-control" type="text" name="footer_feature_3_icon" id="footer_feature_3_icon" placeholder="Feature 3 icon fa-class" value="{{ get_setting('footer_feature_3_icon')->value ?? '' }}">
                                    @error('footer_feature_3_icon')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_3_title" class="col-form-label" style="font-weight: bold;">Feature 3 Title</label>
                                    <input type="hidden" name="types[]" value="footer_feature_3_title">
                                    <input class="form-control" type="text" name="footer_feature_3_title" id="footer_feature_3_title" placeholder="Feature 3 title" value="{{ get_setting('footer_feature_3_title')->value ?? '' }}">
                                    @error('footer_feature_3_title')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_3_subtitle" class="col-form-label" style="font-weight: bold;">Feature 3 Subtitle</label>
                                    <input type="hidden" name="types[]" value="footer_feature_3_subtitle">
                                    <input class="form-control" type="text" name="footer_feature_3_subtitle" id="footer_feature_3_subtitle" placeholder="Feature 3 subtitle" value="{{ get_setting('footer_feature_3_subtitle')->value ?? '' }}">
                                    @error('footer_feature_3_subtitle')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
					            <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_3_link" class="col-form-label" style="font-weight: bold;">Feature 3 Link</label>
                                    <input type="hidden" name="types[]" value="footer_feature_3_link">
                                    <input class="form-control" type="text" name="footer_feature_3_link" id="footer_feature_3_link" placeholder="Feature 3 link" value="{{ get_setting('footer_feature_3_link')->value ?? '' }}">
                                    @error('footer_feature_3_link')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	</div>
				        	<hr>
				        	<div class="row">
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_4_icon" class="col-form-label" style="font-weight: bold;">Feature 4 Icon (fa-class)</label>
                                    <input type="hidden" name="types[]" value="footer_feature_4_icon">
                                    <input class="form-control" type="text" name="footer_feature_4_icon" id="footer_feature_4_icon" placeholder="Feature 4 icon fa-class" value="{{ get_setting('footer_feature_4_icon')->value ?? '' }}">
                                    @error('footer_feature_4_icon')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_4_title" class="col-form-label" style="font-weight: bold;">Feature 4 Title</label>
                                    <input type="hidden" name="types[]" value="footer_feature_4_title">
                                    <input class="form-control" type="text" name="footer_feature_4_title" id="footer_feature_4_title" placeholder="Feature 4 title" value="{{ get_setting('footer_feature_4_title')->value ?? '' }}">
                                    @error('footer_feature_4_title')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
				        	    <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_4_subtitle" class="col-form-label" style="font-weight: bold;">Feature 4 Subtitle</label>
                                    <input type="hidden" name="types[]" value="footer_feature_4_subtitle">
                                    <input class="form-control" type="text" name="footer_feature_4_subtitle" id="footer_feature_4_subtitle" placeholder="Feature 4 subtitle" value="{{ get_setting('footer_feature_4_subtitle')->value ?? '' }}">
                                    @error('footer_feature_4_subtitle')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
					            <div class="col-sm-6 mb-3">
                                    <label for="footer_feature_4_link" class="col-form-label" style="font-weight: bold;">Feature 4 Link</label>
                                    <input type="hidden" name="types[]" value="footer_feature_4_link">
                                    <input class="form-control" type="text" name="footer_feature_4_link" id="footer_feature_4_link" placeholder="Feature 4 link" value="{{ get_setting('footer_feature_4_link')->value ?? '' }}">
                                    @error('footer_feature_4_link')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
					            <hr>
					            <div class="col-sm-12 mb-3 mt-3">
			                        <div class="mb-2 mt-3">
						             	<img id="showFooterPaymentImage" class="rounded avatar-lg" src="{{ asset(get_setting('footer_payment_image')->value ?? '') }}" alt="No Image" width="270px" height="39px;">
						            </div>
						            <div class="mb-2">
						             	<label for="footer_payment_image" class="col-form-label" style="font-weight: bold;">Footer Payment Methods Image</label>

						                <input name="footer_payment_image" class="form-control" type="file" id="footer_payment_image">
						                @error('footer_payment_image')
						                    <p class="text-danger">{{$message}}</p>
						                @enderror
						            </div>
					            </div>
				        	</div>
				        	<hr>
				        	<div class="row">
				        	    <div class="col-sm-6 mb-3">
                                    <label for="instagram_username" class="col-form-label" style="font-weight: bold;">Instagram Username</label>
                                    <input type="hidden" name="types[]" value="instagram_username">
                                    <input class="form-control" type="text" name="instagram_username" id="instagram_username" placeholder="Feature 4 icon fa-class" value="{{ get_setting('instagram_username')->value ?? '' }}">
                                    @error('instagram_username')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
					            </div>
					       </div>
				        </div>
				        <!-- card body .// -->
				    </div>
				    <!-- card .// -->

				    <div class="card">
						<div class="card-header">
							<h3>Social Link Settings</h3>
						</div>
				        <div class="card-body">
				        	<div class="row">
				        		<div class="col-sm-6 mb-3">
		                           <label for="facebook_url" class="col-form-label" style="font-weight: bold;">Facebook link :</label>
		                           <input type="hidden" name="types[]" value="facebook_url">
		                            <input class="form-control" type="text" name="facebook_url" id="facebook_url" placeholder="Write facebook url" value="{{ get_setting('facebook_url')->value ?? ''}}">
		                            @error('facebook_url')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           <label for="twitter_url" class="col-form-label" style="font-weight: bold;">Twitter link :</label>
		                           <input type="hidden" name="types[]" value="twitter_url">
		                            <input class="form-control" type="text" name="twitter_url" id="twitter_url" placeholder="Write twitter url" value="{{ get_setting('twitter_url')->value ?? '' }}">
		                            @error('twitter_url')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           <label for="linkedin_url" class="col-form-label" style="font-weight: bold;">Linkedin Link :</label>
		                           <input type="hidden" name="types[]" value="linkedin_url">
		                            <input class="form-control" type="text" name="linkedin_url" id="linkedin_url" placeholder="Write linkedin url" value="{{ get_setting('linkedin_url')->value ?? '' }}">
		                            @error('linkedin_url')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           <label for="youtube_url" class="col-form-label" style="font-weight: bold;">Youtube Link :</label>
		                           <input type="hidden" name="types[]" value="youtube_url">
		                            <input class="form-control" type="text" name="youtube_url" id="youtube_url" placeholder="Write youtube url" value="{{ get_setting('youtube_url')->value ?? '' }}">
		                            @error('youtube_url')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           <label for="instagram_url" class="col-form-label" style="font-weight: bold;">Instagram Link :</label>
		                           <input type="hidden" name="types[]" value="instagram_url">
		                            <input class="form-control" type="text" name="instagram_url" id="instagram_url" placeholder="Write instagram url" value="{{ get_setting('instagram_url')->value ?? '' }}">
		                            @error('instagram_url')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-sm-6 mb-3">
		                           <label for="pinterest_url" class="col-form-label" style="font-weight: bold;">Pinterest Link :</label>
		                           <input type="hidden" name="types[]" value="pinterest_url">
		                            <input class="form-control" type="text" name="pinterest_url" id="pinterest_url" placeholder="Write pinterest url" value="{{ get_setting('pinterest_url')->value ?? '' }}">
		                            @error('pinterest_url')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

				        	</div>
				        </div>
				    </div>
				    <!-- card //-->

				</div>
				<!-- col-6 //-->
				<div class="col-md-5">
					<div class="card">
						<div class="card-header mb-4">
							<h3>Logo Settings</h3>
						</div>
				        <div class="card-body">
				        	<div class="row">
				        		<div class="col-sm-12 mb-3">
			                        <div class="mb-2">
						             	<img id="showFavicon" class="rounded avatar-lg" src="{{ asset(get_setting('site_favicon')->value ?? '') }}" alt="No Image" width="50px" height="50px;">
						            </div>
						            <div class="mb-2">
						             	<label for="site_favicon" class="col-form-label" style="font-weight: bold;">Site Favicon</label>

						                <input name="site_favicon" class="form-control" type="file" id="site_favicon">
						                @error('site_favicon')
						                    <p class="text-danger">{{$message}}</p>
						                @enderror
						            </div>
					            </div>

		                        <div class="col-sm-12 mb-3">
			                        <div class="mb-2">
						             	<img id="showImage" class="rounded avatar-lg" src="{{ asset(get_setting('site_logo')->value ?? '') }}" alt="No Image" style="width: 100px; height: auto">
						            </div>
						            <div class="mb-2">
						             	<label for="image" class="col-form-label" style="font-weight: bold;">Site Logo</label>

						                <input name="site_logo" class="form-control" type="file" id="image">
						                @error('site_logo')
						                    <p class="text-danger">{{$message}}</p>
						                @enderror
						            </div>
					            </div>

					            <div class="col-sm-12 mb-3">
			                        <div class="mb-2">
						             	<img id="showFooter" class="rounded avatar-lg" src="{{ asset(get_setting('site_footer_logo')->value ?? '') }}" alt="No Image"  style="width: 100px; height: auto">
						            </div>
						            <div class="mb-2">
						             	<label for="site_footer_logo" class="col-form-label" style="font-weight: bold;">Site Footer Logo</label>

						                <input name="site_footer_logo" class="form-control" type="file" id="site_footer_logo">
						                @error('site_footer_logo')
						                    <p class="text-danger">{{$message}}</p>
						                @enderror
						            </div>
					            </div>

				        	</div>
				        	<!-- row //-->
				        </div>
				    </div>
				    <!-- card //-->

				    <div class="card">
						<div class="card-header mb-4">
							<h3>Meta Settings</h3>
						</div>
				        <div class="card-body">
				        	<div class="row">
				        		<div class="col-sm-12 mb-3">
			                        <div class="mb-2">
						             	<img id="showMeta" class="rounded avatar-lg" src="{{ asset(get_setting('site_favicon')->value ?? '') }}" alt="No Image" width="50px" height="50px;">
						            </div>
						            <div class="mb-2">
						             	<label for="product_meta" class="col-form-label" style="font-weight: bold;">Product Meta</label>

						                <!-- <input name="product_meta" class="form-control" type="file" id="product_meta"> -->
						                @error('product_meta')
						                    <p class="text-danger">{{$message}}</p>
						                @enderror
						            </div>
					            </div>

				        	</div>
				        	<!-- row //-->
				        </div>
				    </div>
				    <div class="card d-none">
						<div class="card-header mb-2">
							<h3>Other Settings</h3>
						</div>
				        <div class="card-body">
				        	
				        	<!-- row //-->
				        </div>
				    </div>
				    <!-- card //-->

				</div>
			</div>
			<div class="row mb-4 justify-content-sm-end">
				<div class="col-lg-3 col-md-4 col-sm-5 col-6">
					<input type="submit" class="btn btn-primary" value="Update">
				</div>
			</div>
		</form>
		<!-- .row // -->
	</div>
</section>

@endsection

@push('footer-script')
    <!--Site favicon Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#site_favicon').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showFavicon').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <!--Site footer logo Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#site_footer_logo').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showFooter').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    
    <!--Site footer payment image Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#footer_payment_image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showFooterPaymentImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endpush
