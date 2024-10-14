<form action="{{ route('admin.cities.update',$city->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="country_id" class="form-label">Country <span class="text-danger">*</span></label>
        <select name="country_id" id="country_id" class="form-control">
            @if (isset($country) && count($country) > 0)
                @foreach ($country as $key => $item)
                    <option value="{{ $item->id }}" {{ $city->country_id == $item->id ? "selected": "" }}>{{ $item->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="region_id" class="form-label">Region <span class="text-danger">*</span></label>
        <select name="region_id" id="region_id" class="form-control">
            @if (isset($region) && count($region) > 0)
                @foreach ($region as $key => $item)
                    <option value="{{ $item->id }}" {{ $city->region_id == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="name" class="form-label">City <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" value="{{ $city->name }}" class="form-control"
            placeholder="City name" required>
    </div>
    <div class="form-group float-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>