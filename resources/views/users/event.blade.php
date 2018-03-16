@extends('layouts.app-news-feed')

@section('title') Post-event | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')

    <div class="header-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-10">

                {{--error message--}}
                @include('error-message')
                {{--end error message--}}

                <div class="competition-launch">
                    <h3 class="h3 mb-5">Post event</h3>
                    <form action="{{ route('eventAdd') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Cover Image</label>
                            <div class="col-lg-7">
                                <div class="form-group mb-0 is-empty" onclick="openFileInput('#cover_image')">
                                    <input type="text" readonly="" class="form-control" placeholder="Attachment" style="background-color: transparent;">
                                    <span class="input-group-addon">
                                        <i class="fa fa-paperclip" style="font-size: 18px;"></i></span>
                                    <span class="material-input"></span>
                                    <span class="material-input"></span></div>
                                    <p style="color: red">Imgae size should be 502 X 292 px</p>
                            </div>
                        </div>

                        <input type="file" class="hidden-file" name="cover_image" id="cover_image" style="display: none;">

                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Event Title <span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating mb-0">
                                    <label class="control-label">Event Title</label>
                                    <input type="text" value="{{ old('event_title') }}" name="event_title" class="form-control" placeholder="">
                                    @if ($errors->has('event_title'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6"> Description <span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <textarea name="description" class="form-control" placeholder="Tell everyone about your event, don’t forget to includes your event contact info like email, address, and phone number.">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Venue <span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating mb-0">
                                    <label class="control-label">Venue address</label>
                                    <input type="text" name="venue" class="form-control" placeholder="" value="{{ old('venue') }}">
                                    @if ($errors->has('venue'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('venue') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group " id="append_image_html">
                            <label class="col-lg-3 col-form-label h6">Image</label>
                            <div class="col-lg-7">
                                <div class="form-group mb-0">
                                    <input type="file" readonly class="form-control" name="image[]" style="background-color: transparent;">

                                    <span class="input-group-addon"><i class="fa fa-paperclip" style="font-size: 18px;"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 add-more-event-image"><u>Add more +</u></a>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Location</label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label">Country</label>
                                    <select class="selectpicker form-control" name="country" data-live-search="true">
                                        <option selected disabled> Select Country</option>
                                        @if($countries->count())
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" >{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group label-floating is-select">
                                    <label class="control-label">State/Province</label>
                                    <select class="selectpicker form-control state" data-live-search="true" name="state">
                                    </select>
                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group label-floating is-select">
                                    <label class="control-label">City</label>
                                    <select class="selectpicker form-control city  fghfghfghf" name="city" data-live-search="true">
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-lg-12 offset-lg-3">
                                <button type="submit" class="btn btn-primary btn-submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

@section('scripts')
    <script>
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script>

@endsection