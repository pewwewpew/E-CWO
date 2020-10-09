@if(empty($aircraft))

<div>Please Select Company First!</div>

@elseif(count($aircraft) < 1)

<div>This Company doesn't exists or not have Aircraft!</div>

@else

@foreach ($aircraft as $item)
<div value="{{$item->id}}"><a href="/admin/aircraft/{{$company}}/{{$item->id}}">{{$x++.'.'.$item->id}}</a></div>
@endforeach

{{ $aircraft->links() }}

@endif


