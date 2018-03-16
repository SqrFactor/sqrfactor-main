
{{--success--}}

@if(Session::has('success'))
<div class="alert alert-success">
    <strong>Success!</strong> {{ Session::get('success') }}.
</div>
    @endif

{{--danger--}}

@if(Session::has('danger'))
<div class="alert alert-danger">
    <strong>Danger!</strong> {{  Session::get('danger')}}.
</div>
    @endif

{{--info--}}

@if(Session::has('info'))
    <div class="alert alert-info">
        <strong>Info!</strong> {{ Session::get('info') }}.
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-info">
        <strong>Error!</strong> {{ Session::get('error') }}.
    </div>
@endif

@if(Session::has('oops'))
    <div class="alert alert-danger">
        <strong>Oops!</strong> {{ Session::get('oops') }}.
    </div>
@endif
@if(isset($_GET['val']) && $_GET['val'] == 'success')

    <div class="alert alert-success work_professional_success" id="messageSuccess">
        <strong>Success!</strong>  Updated successfully...
    </div>
@endif

<div class="alert alert-success " id="removeEmail" style="display: none;">
    <strong>Success!</strong>  Removed successfully...
</div>
