
<?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_layout'); ?>
    <div class="max-w-full">

        <?php if(session('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo e(session('success')); ?>',
                confirmButtonColor: '#3085d6',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        </script>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '<?php echo e(session('error')); ?>',
                confirmButtonColor: '#d33'
            });
        </script>
        <?php endif; ?>


        <?php if(auth()->user()->role == 0): ?>
            <div class="mb-4">
                <a href="<?php echo e(route('admin.create')); ?>" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Create User
                </a>
            </div>
        <?php endif; ?>


        <h2 >
            <?php if($role === '0'): ?>
                Admin/Secretary
            <?php elseif($role === '2'): ?>
                Students
            <?php elseif($role === '1'): ?>
                Mentors
            <?php elseif($role === '0'): ?>
                Admin/Secretary
            <?php else: ?>
                All Users
            <?php endif; ?>
        </h2>



        <div class="flex space-x-3 mb-4">
            <a href="<?php echo e(route('admin.users')); ?>" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">All</a>
            <a href="<?php echo e(route('admin.users', 0)); ?>" class="px-4 py-2 bg-gray-200 rounded hoverb:g-gray-300">Admin/Secretary</a>
            <a href="<?php echo e(route('admin.users', 1)); ?>" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Mentors</a>
            <a href="<?php echo e(route('admin.users', 2)); ?>" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Students</a>
        </div>




        <div class="w-full overflow-x-auto rounded-lg border border-gray-200 dark:border-neutral-700 shadow-sm">
            <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Actions</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-neutral-900 dark:divide-neutral-800">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-5 py-2 text-sm text-black dark:text-white">
                                <?php echo e($user->created_at->format('F d, Y - h:i A')); ?>

                            </td>
                            <td class="px-6 py-4 text-sm text-black dark:text-white"><?php echo e($user->full_name); ?></td>
                            <td class="px-6 py-4 text-sm text-black dark:text-neutral-300"><?php echo e($user->email); ?></td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block px-2 py-1 text-xs font-medium rounded-full 
                                    <?php echo e($user->role == 0 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'); ?>">
                                    <?php echo e($user->role == 0 ? 'Admin/Secretary' : ($user->role == 2 ? 'Student' : 'Mentor')); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm space-y-2">
                                <!-- View Button -->
                                <a href="<?php echo e(route('admin.users.show', $user->id)); ?>"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-semibold text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                                    View
                                </a>

                                <!-- Edit Button -->
                                <a href="<?php echo e(route('edit.user', $user->id)); ?>"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="<?php echo e(route('delete.user', $user->id)); ?>" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                        Delete
                                    </button>
                                </form>
                            </td>


                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/manage/user.blade.php ENDPATH**/ ?>