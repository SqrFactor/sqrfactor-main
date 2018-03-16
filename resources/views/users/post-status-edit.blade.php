@extends('layouts.app-news-feed')

@section('content')
    <div class="header-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-10">
                <div class="competition-launch">
                    <h3 class="h3 mb-5">Post Edit</h3>



                    <div class="row form-group ">
                        <label class="col-lg-3 col-form-label h6"></label>
                        <div class="col-lg-7">
                            <div class="form-group label-floating mb-0">
                                @foreach ($errors->all() as $error)
                                    <p style="color:red;" >{{ $error }}</p>
                                @endforeach
                                @include('error-message')

                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="post_slug" value="{{ $usersPost->slug }}" >

                    <form {{--action="{{ route('post.status.edit',$usersPost->slug) }}"--}} method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Description</label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating mb-0">
                                    <label class="control-label"></label>
                                    <textarea class="form-control" name="description" id="description">{{ $usersPost->description }}</textarea>
                                    <p  style="color:red;display: none;" class="errors"></p>

                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Image</label>
                            <div class="col-lg-7">
                                @if($usersPost->image != null)
                                <img src="{{ asset('img/remove-icon.png') }}" alt="" class="post-image-remove pull-right remove_icon " data-post_slug = "{{ $usersPost->slug }}" data-toggle="tooltip" data-placement="top"  title="Remove Image"   >
                                <br />
                                    <img src="@if($usersPost->image != null) {{ asset($usersPost->image) }} @endif" id="target_image_cropper"  class="target_image_cropper" />
                                @endif
                                    <img  id="image_target" >



                                <br />
                                <br />
                                <div class="form-group mb-0" onclick="openFileInput('#upload_status_image')">

                                    <input type="text"   readonly style="background-color: white;" class="form-control " placeholder="Attachment" >


                                    <span class="input-group-addon"><i class="fa fa-paperclip" style="font-size: 18px;"></i></span>
                                </div>
                            </div>

                        </div>

                        <input type="file" id="upload_status_image" value="Choose a file" accept="image/*" style="display: none;"   >
                        <input type="hidden" name="image" value="" id="image_val">


                        <div class="row pt-2">
                            <div class="col-lg-12 offset-lg-3">
                                <a  class="btn btn-primary btn-submit post_status_save" style="color: white;cursor:pointer;">Update<div class="ripple-container"></div></a>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>



    @endsection