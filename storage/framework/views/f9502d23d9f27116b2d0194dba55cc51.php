
<?php $__env->startSection('title_admin', 'Create Admin/Secretary'); ?>
<?php $__env->startSection('admin_layout'); ?>
    <center><h1>Create New User</h1></center>
    <hr>
        <form action="<?php echo e(route('admin.store')); ?>" method="POST" class="max-w-md mx-auto mt-8 space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block mb-1">First Name</label>
                <input type="text" name="first_name" class="w-full border px-3 py-2 rounded" placeholder="Enter first name" required>
            </div>

            <div>
                <label class="block mb-1">Last Name</label>
                <input type="text" name="last_name" class="w-full border px-3 py-2 rounded" placeholder="Enter last name" required>
            </div>

            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded" placeholder="Enter user email" required>
            </div>

            <div>
                <label class="block mb-1">Adress</label>
                <input type="address" name="address" class="w-full border px-3 py-2 rounded" placeholder="Enter user address" required>
            </div>

            <div>
                <label class="block mb-1">Contact Number</label>
                <input type="text" name="contact_number" class="w-full border px-3 py-2 rounded" placeholder="Enter user contact number" required>
            </div>

            <div>
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded" placeholder="Enter user password" required>
            </div>
            <div>
                <label class="block mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" placeholder="Confirm password" required>
            </div>
            <div>
                <label class="block mb-1">Role</label>
                <select name="role" class="w-full border px-3 py-2 rounded">
                    <option value="0">Admin/Secretary</option>
                    <option value="1">Mentor</option>
                    <option value="2">Student</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create</button>
        </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/manage/create.blade.php ENDPATH**/ ?>