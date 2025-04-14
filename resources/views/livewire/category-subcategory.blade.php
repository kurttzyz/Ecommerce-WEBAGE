<div>
<label for="category_id" class="fw-bold mb-2">Select A Category For Your Product</label>
<select class="form-control mb-2" name="category_id" wire:model.live="selectedCategory">
    <option value="">Select a Category
    @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->category_name}}</option>
    @endforeach
</option>
</select>

<label for="subcategory_id" class="fw-bold mb-2">Select A Sub Category For Your Product</label>
<select class="form-control mb-2" name="subcategory_id">
    <option value="">Select a Sub Category
    @foreach($subcategories as $subcategory)
        <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
    @endforeach
</option>
</select>
</div>
 