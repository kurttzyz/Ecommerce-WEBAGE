
<?php $__env->startSection('title_admin'); ?>
ConnectingNotes | Admin
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_layout'); ?>
<h1>Manage Session & Courses</h1>

    <div>

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


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="rounded-lg shadow p-4 bg-cover bg-center">
                    <div class="bg-white bg-opacity-80 p-4 rounded"
                        style="background-image: url('<?php echo e(asset('landingpage/img/room.jpg')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">

                        <div class="course-card">
                            <h3 style="color:black; text-align:center" class="bg-gray-400"><?php echo e($course->title); ?></h3>
                            <center><strong style="color:black ; text-align:center" class="bg-gray-400">Total Students: <?php echo e($course->students->count()); ?></strong></center>
                            <p class="text-black" style="text-align:center" class="bg-gray-400">
                                <strong class="bg-gray-400">Instructor: <?php echo e($course->course->mentor->full_name ?? 'N/A'); ?></strong>
                            </p>
                            <center>
                                <form action="<?php echo e(route('product.destroy', $course->id)); ?>" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </center>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
    
    <style>
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
    
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    
        .animate-fade-in-up {
            animation: fadeIn 1s ease-out forwards;
        }
</style>
<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/product/manage.blade.php ENDPATH**/ ?>