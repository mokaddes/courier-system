<form action="{{ route('admin.weights.update',$weight->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" value="{{ $weight->name }}" class="form-control"
            placeholder="Enter Weight name" required>
    </div>
    <div class="form-group">
        <label for="weight" class="form-label">Weight</label>
        <input type="text" name="weight" id="weight" value="{{ $weight->weight }}" class="form-control"
            placeholder="Enter Weight" required>
    </div>
    <div class="form-group">
        <label for="order_id" class="form-label">Order Number</label>
        <input type="number" name="order_id" id="order_id" value="{{ $weight->order_id }}" class="form-control"
            placeholder="Enter Order Number" required>
    </div>
    <div class="form-group">
        <label for="order_id" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="1" {{ $weight->status == "1" ? "selected" : "" }}>Active</option>
            <option value="0" {{ $weight->status == "0" ? "selected" : "" }}>Inactive</option>
        </select>
    </div>
    <div class="form-group float-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>