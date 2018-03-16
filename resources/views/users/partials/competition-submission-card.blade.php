@include('users.partials.users-like')
@foreach($items as $item)
    <div class="col-lg-4 col-md-6">
        @include('users.partials.competition-submission-card-item')
    </div>
@endforeach