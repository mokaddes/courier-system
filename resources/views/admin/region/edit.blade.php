<form action="{{ route('admin.region.update',$region->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="country_id" class="form-label required">Country</label>
        <select name="country_id" id="country_id" class="form-control">
            @if (isset($country) && count($country) > 0)
                @foreach ($country as $key => $item)
                    <option value="{{ $item->id }}" {{ $region->country_id == $item->id? "selected" : "" }}>{{ $item->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="name" class="form-label required">Region Name</label>
        <input type="text" name="name" id="name" value="{{ $region->name }}" class="form-control"
            placeholder="Region name" required>
    </div>
    <div class="form-group">
        <label for="code" class="form-label required">Order Number</label>
        <input type="number" name="code" id="code" value="{{ $region->code }}" class="form-control"
            placeholder="Order Number" required>
    </div>

    <div class="form-group float-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>
