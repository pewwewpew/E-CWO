@forelse ($detailservices as $item)
<div><a>{{++$x.'.'.$item->name.' '.$item->aircraft_type_id.' dengan '.$item->manhours.' manhours'}}</a></div>
@empty
<div>There is No Detail Service on the database</div>
@endforelse
