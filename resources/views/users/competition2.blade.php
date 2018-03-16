@extends('layouts.app-news-feed')
@section('content')
    <div class="header-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-10">
                <div class="competition-launch">
                    <h3 class="h3 mb-5">Launch a competition</h3>

                    <form action="{{ route('competition2Add',$userCompetition->slug) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Terms & Condition</label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating mb-0">
                                    <label class="control-label">Write Terms and condition for your competition</label>
                                    <textarea class="form-control" name="terms_and_condition" id="terms_and_condition"></textarea>
                                    @if ($errors->has('terms_and_condition'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('terms_and_condition') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row form-group append-more-jury">
                            <label class="col-lg-3 col-form-label h6">Jury</label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating mb-0">
                                    <label class="control-label">Jury Name</label>
                                    <input name="jury_name[]" id="jury_name[]" class="form-control" placeholder="" type="text">
                                    @if ($errors->has('jury_name'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('jury_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 add-more-jury"><u>Add more +</u></a>
                            </div>
                        </div>




                        <div class="row form-group mb-4 append_association_with">
                            <label class="col-lg-3 col-form-label h6">Association With</label>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <select class="form-control" name="association[]" id="association[]">
                                        <option value="" selected disabled>Associate name</option>
                                        <option value="
Indian Institute of Architects">
                                            Indian Institute of Architects</option>
                                        <option value="Gwalior Municipal Corporation">Gwalior Municipal Corporation</option>
                                    </select>
                                    @if ($errors->has('association'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('association') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group mb-0">
                                    <input type="file" readonly class="form-control" placeholder="Associate Logo" name="image[]" id="image[]" style="background-color: transparent;">
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                    <span class="input-group-addon"><i class="fa fa-paperclip" style="font-size: 18px;"></i></span>
                                </div>
                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 add_association_with"><u>Add more +</u></a>
                            </div>
                        </div>


                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Early Registration</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" name="early_registration" id="early_registration" placeholder="Early Registration" value="{{--From 25th May to 5th June.  INR 1200 per team 2017--}}">
                                @if ($errors->has('early_registration'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('early_registration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Standard Registration</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control"  name="standard_registration" id="standard_registration" placeholder="Standard Registration" value="{{--From 10th June to 25th June 2017.  INR 1800 per team--}}">
                                @if ($errors->has('standard_registration'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('standard_registration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row form-group ">
                            <label class="col-lg-3 col-form-label h6">Note</label>
                            <div class="col-lg-7">
                                <div class="form-group label-floating mb-0">
                                    <label class="control-label">Write your detailed note here</label>
                                    <textarea class="form-control" name="note" id="note"></textarea>
                                    @if ($errors->has('note'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('note') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-lg-12 offset-lg-3">
                                <button type="submit" class="btn btn-primary btn-submit">Post Job</button>
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