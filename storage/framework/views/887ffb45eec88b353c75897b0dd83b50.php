
<?php $__env->startSection('title_admin', 'Create Admin/Secretary'); ?>
<?php $__env->startSection('admin_layout'); ?>
    <div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>

        <form action="<?php echo e(route('update.user', $user->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium">First Name</label>
                <input type="text" name="first_name" value="<?php echo e(old('first_name', $user->first_name)); ?>" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" value="<?php echo e(old('last_name', $user->last_name)); ?>" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required
                    class="w-full border px-3 py-2 rounded">
            </div>


            <div class="mb-4">
                <label for="address" class="block text-sm font-medium">Address</label>
                <input type="address" name="address" value="<?php echo e(old('address', $user->address)); ?>" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="contact_number" class="block text-sm font-medium">Contact Number</label>
                <input type="text" name="contact_number" value="<?php echo e(old('contact_number', $user->contact_number)); ?>" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium">Role</label>
                <select name="role" required class="w-full border px-3 py-2 rounded">
                    <option value="0" <?php echo e($user->role == 0 ? 'selected' : ''); ?>>Admin/Secretary</option>
                    <option value="1" <?php echo e($user->role == 1 ? 'selected' : ''); ?>>Mentor</option>
                    <option value="2" <?php echo e($user->role == 2 ? 'selected' : ''); ?>>Student</option>
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="<?php echo e(route('admin.users')); ?>" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/manage/edit.blade.php ENDPATH**/ ?>