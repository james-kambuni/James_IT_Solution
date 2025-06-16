<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Price</label>
    <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
    @if(!empty($product->image))
        <img src="{{ asset('storage/' . $product->image) }}" width="100">
    @endif
</div>

<div class="mb-3">
    <label>Description</label>
    <input type="text" name="description" value="{{ old('description', $product->description ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>In Stock</label>
    <select name="in_stock" class="form-control">
        <option value="1" {{ (old('in_stock', $product->in_stock ?? '') == 1) ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ (old('in_stock', $product->in_stock ?? '') == 0) ? 'selected' : '' }}>No</option>
    </select>
</div>

<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" class="form-control">
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                @if(old('category_id', $product->category_id ?? '') == $category->id) selected @endif>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-success">Save</button>
