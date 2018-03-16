<!-- newsfeed form -->
@include('users.partials.cropping')

<div class="ui-block">
    <div class="news-feed-form box-shadow2">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active inline-items" data-toggle="tab" href="#form_status" role="tab"
                   aria-expanded="true">
                    <svg class="olymp-status-icon">
                        <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-status-icon') }}"></use>
                    </svg>
                    <span>Status</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  inline-items" href="{{ route('designPost.add') }}" role="tab" aria-expanded="false">
                    <svg class="olymp-multimedia-icon">
                        <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-multimedia-icon') }}"></use>
                    </svg>
                    <span>Design</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  inline-items" href="{{ route('articlePost.add') }}" role="tab" aria-expanded="true">
                    <svg class="olymp-status-icon">
                        <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-status-icon') }}"></use>
                    </svg>
                    <span>Article</span>
                </a>
            </li>

            @if(Auth::user()->type == 'work')
                @if(Auth::user()->user_type == 'work_architecture_firm_companies' OR Auth::user()->user_type == 'work_architecture_organizations' OR Auth::user()->user_type == 'work_architecture_college')
                    {{--<div class="more">
                        <svg class="olymp-three-dots-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="http://localhost:8000/assets/icons/icons.svg#olymp-three-dots-icon"></use>
                        </svg>
                        <ul class="more-dropdown">
                            <li>
                                <a href="javascript:void(0)">Edit Post</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Delete Post</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Turn Off Notifications</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Select as Featured</a>
                            </li>
                        </ul>
                    </div>--}}
                    <li class="nav-item">
                        <div class="nav-link  inline-items p_22">
                            <div class="more">

                                <svg class="olymp-three-dots-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                         xlink:href="http://localhost:8000/assets/icons/icons.svg#olymp-three-dots-icon"></use>
                                </svg>
                                <ul class="more-dropdown post_dropdown">
                                  

                                    <li>
                                        <a href="{{ route('competitionAdd') }}" >Competition</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="launching_soon">Announcement </a>
                                    </li>

                                </ul>
                                {{--<span>Competition</span>--}}
                            </div>
                        </div>
                    </li>
                @endif
            @endif
        </ul>
        <!-- Tab panes -->


        <div class="tab-content">
            <div class="tab-pane active" id="form_status" role="tabpanel" aria-expanded="true">
                <form enctype="multipart/form-data" id="post_ad_form">
                    <div class="author-thumb">
                        <img src="@if(!empty(Auth::user()->profile)){{ Auth::user()->profile }} @endif" alt="author"
                             class="profile_change_append">
                    </div>
                    <div class="form-group with-icon label-floating">
                        <label class="control-label">Share what you are thinking here...</label>
                        <textarea class="form-control c-white" placeholder="" style="" name="description"
                                  id="post_description"></textarea>
                        <img src="{{ asset('img/remove-icon.png') }}" alt="Remove Image" data-toggle="tooltip"
                             data-placement="top" title="Remove Image" class="remove_image pull-right remove_icon"
                             style="display: none;">

                        <img  id="target_image_cropper" class="target_image_cropper"/>

                        <p class="errors_post_description" style="display: none;color:red;margin-left: 10px;"></p>
                    </div>


                    <input type="hidden" name="image_value" id="image_val" value="">
                    {{-- Inpyt file --}}
                    <input type="file" style="display: none;" id="status_image_picker">

                    <div class="add-options-message">

                        <a href="#" class="options-message" onclick="openFileInput('#status_image_picker')">
                            <svg class="olymp-camera-icon" >
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-camera-icon') }} "></use>
                            </svg>

                        </a>
                        {{--<a href="#" class="options-message" data-toggle="tooltip" data-placement="top" title="" data-original-title="TAG YOUR FRIENDS">
                            <svg class="olymp-computer-icon">
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-happy-face-icon') }}"></use>
                            </svg>
                        </a>--}}
                        <a href="javascript:void(0)"
                           class="btn btn-primary btn-sm font-weight-bold {{--post_saved--}} post_ad_save_data pull-right">Post
                            Status</a>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="form_design" role="tabpanel" aria-expanded="true">
                <form>
                    <div class="author-thumb">
                        <img src="{{ asset('assets/images/user-photo.jpg') }}" alt="author">
                    </div>
                    <div class="form-group with-icon label-floating">
                        <label class="control-label">Share what you are thinking here...</label>
                        <textarea class="form-control" placeholder=""></textarea>
                    </div>
                    <div class="add-options-message">
                        <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo"
                           data-toggle="tooltip" data-placement="top" title="" data-original-title="ADD PHOTOS">
                            <svg class="olymp-camera-icon">
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-camera-icon') }}"></use>
                            </svg>
                        </a>
                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" title=""
                           data-original-title="TAG YOUR FRIENDS">
                            <svg class="olymp-computer-icon">
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-computer-icon') }}"></use>
                            </svg>
                        </a>
                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" title=""
                           data-original-title="ADD LOCATION">
                            <svg class="olymp-small-pin-icon">
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-small-pin-icon') }}"></use>
                            </svg>
                        </a>
                        <button class="btn btn-primary btn-sm btn-md-2">Post Status</button>
                        <button class="btn btn-md-2 btn-sm btn-border-think btn-transparent c-grey">Preview</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- /newsfeed form --}}