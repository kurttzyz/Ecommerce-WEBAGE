
<div class="search-bar-wrap hidden md:block">
    <form action="{{ route('seller.search.product') }}" method="GET" class="w-full max-w-lg mx-auto">
        <div class="flex items-center bg-white border border-gray-300 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-red-500">
            <input 
                type="text" 
                name="query" 
                placeholder="Search Courses...." 
                required 
                class="w-full px-2 py-2 text-lg text-black bg-white border-none rounded-l-lg focus:outline-none"
            />
            <button 
                type="submit" 
                class="bg-red-500 text-white px-2 py-3 rounded-r-lg hover:bg-red-600 transition duration-300">
                <i data-feather="search"></i> <!-- Feather Search Icon -->
            </button>
        </div>
    </form>
</div>

<script>
    feather.replace(); // This ensures the Feather icons are rendered
</script>
<script src="https://unpkg.com/feather-icons"></script>
