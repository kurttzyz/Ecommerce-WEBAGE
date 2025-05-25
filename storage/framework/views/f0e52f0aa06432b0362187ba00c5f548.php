
<div wire:ignore class="w-full max-w-xs mx-auto ">
    <select
        id="category-select"
        onchange="location = this.value;"
        class="block w-full px-4 py-2 text-lg text-black bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
    >
        <option value="">Select Courses</option>
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $categoryUrl = route('category.products', $category->category_name);
            ?>
            <option
                value="<?php echo e($categoryUrl); ?>"
                <?php echo e(url()->current() == $categoryUrl ? 'selected' : ''); ?>>
                <?php echo e($category->category_name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </select>
</div>
<?php /**PATH C:\music\resources\views/livewire/filter-component.blade.php ENDPATH**/ ?>