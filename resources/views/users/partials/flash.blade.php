@if(session()->has('message'))
    <h6 class="alert alert-success">{{session()->get('message')}}</h6>
    <?php
       header('Refresh:10');
    ?> 
@endif