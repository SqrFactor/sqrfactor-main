@extends('layouts.app-news-feed')

@section('styles')
    @include('users.partials.medium-editor-css')
    <style>
        .hide{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div id="scroll_refrence"></div>
    <div class="header-spacer"></div>
    <div class="container" id="page_scroll_up">
        <div class="design-post" id="design-post-1">

            <div class="d-flex align-items-center pl-lg-5 mb-3">
                <div class="h6">
                    {{$competition->competition_title}}
                </div>
            </div>

            <form enctype="multipart/form-data" id="competition_submit_design" data-href="{{$competition->slug}}">
                {{ csrf_field() }}
                <input type="hidden" name="competition_id" value="{{$competition->id}}"/>
                <input type="hidden" name="competition_participation_id" value="{{$competition_participation->id}}"/>
                <input type="hidden" name="competition_title" value="{{$competition->competition_title}}"/>

                <div class="pl-lg-5">
                    <div class="form-group post_type">
                        <input type="text" placeholder="Design Title" name="design_title"
                               class="form-control"/>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <div class="form-group post_type">
                        <label class="control-label">Design Cover Image</label>
                        <input type="file" name="design_cover_image" class="form-control"/>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <button type="button" class="btn btn-secondary btn-submit" id="design_use_sqrfactor_editor">Use Sqrfactor Editor</button>
                    <p>----------------------------- OR ----------------------------- </p>
                    <button type="button" class="btn btn-secondary btn-submit" id="design_upload_pdf">Upload PDF</button>
                </div>

                <div class="pl-lg-5" id="design_editor">
                    <div class="form-group" style="margin-left: -13px;">
                        <label class="control-label">Sqrfactor Editor</label>
                        <div class="editable" id="design_body"></div>
                        <span class="placeholder">Type your text, add pictures and videos by clicking + (plus) icon on the left side.</span>
                    </div>
                </div>

                <div class="pl-lg-5 hide" id="design_pdf">
                    <div class="form-group post_type">
                        <label class="control-label">Upload PDF</label>
                        <input type="file" name="design_pdf" class="form-control"/>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @include('users.partials.medium-editor-js')
    <script>
        var editor = new MediumEditor('.editable');

        $(function () {
            $('.editable').mediumInsert({
                editor: editor
            });
        });

    </script>
@endsection
