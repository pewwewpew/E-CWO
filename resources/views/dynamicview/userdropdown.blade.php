<select class="form-control aircraft" name="req_user">
    <option id="option">Select User from selected company</option>
    @forelse ($user as $item)
<option id="option" value="{{$item->email}}">{{$item->email}}</option>
    @empty
    <option>User list doesnt exist!</option>
    @endforelse
</select>
