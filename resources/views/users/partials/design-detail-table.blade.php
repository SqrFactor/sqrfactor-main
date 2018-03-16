<table class="table table-condensed">

    @if(!empty($post->designDetail->status))
      <td class="border-zero"><b>Status</b></td>
    <td  class="border-zero"> {{$post->designDetail->status}} </td>

    <tr/>
    @endif

     @if(!empty($post->designDetail->select_design_type))
            <td><b>Type </b></td>
            <td>{{$post->designDetail->select_design_type}}</td>
            <tr/>
      @endif

     @if(!empty($post->designDetail->building_program))
    <td><b>Building Program</b></td>
    <td>{{$post->designDetail->building_program}}</td>
    <tr/>
     @endif

     @if(!empty($post->designDetail->end_year) && !empty($post->designDetail->start_year))
    <td><b>Date</b></td>
    <td>{{$post->designDetail->start_year}}
        to {{$post->designDetail->end_year}}</td>
    <tr/>
     @endif

    @if(!empty($post->designDetail->total_budget) && !empty($post->designDetail->currency) )
    <td><b>Budget</b></td>
    <td>{{$post->designDetail->total_budget}} {{$post->designDetail->currency}}</td>
    <tr/>
   @endif
</table>