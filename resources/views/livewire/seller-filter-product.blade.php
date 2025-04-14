<div class="w-full max-w-xs mx-auto">
    <select
        id="category-select"
        onchange="location = this.value;"
        class="block w-full px-4 py-2 text-lg text-black bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
        <option value="">Select Category</option>
        @foreach($categories as $category)
            @php
                $categoryUrl = route('seller.category.products', $category->category_name);
            @endphp
            <option
                value="{{ $categoryUrl }}"
                {{ url()->current() == $categoryUrl ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
</div>


