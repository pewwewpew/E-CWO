<select class="form-control aircraft" name="aircraft">
    <option id="option">Select Aircraft Registration</option>
    @forelse ($aircraft as $item)
<option id="option" value="{{$item->id}}">{{$item->id}}</option>
    @empty
    <option>There is No Aircraft Registration from selected company</option>
    @endforelse
</select>
