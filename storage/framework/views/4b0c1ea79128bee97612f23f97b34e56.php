<div>
<label for="category_id" class="fw-bold mb-2">Select A Category For Your Product</label>
<select class="form-control mb-2" name="category_id" wire:model.live="selectedCategory">
    <option value="">Select a Courses
    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
</option>
</select>

<label for="subcategory_id" class="fw-bold mb-2">Select A Sub Category For Your Product</label>
<select class="form-control mb-2" name="subcategory_id">
    <option value="">Select a Sub Courses
    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->subcategory_name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
</option>
</select>
</div>
 <?php /**PATH C:\music\resources\views/livewire/category-subcategory.blade.php ENDPATH**/ ?>