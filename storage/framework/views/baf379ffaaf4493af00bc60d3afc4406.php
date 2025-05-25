

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>
    <div>
        <center>
            <h1 class="text-2xl font-bold mb-4 text-black">Archived Courses</h1>
        </center>
        <hr class="my-4 border-black animate-fade-in-up">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <?php $__currentLoopData = $archivedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative bg-gray-100 rounded-lg shadow p-4 opacity-70">

                    <form action="<?php echo e(route('courses.unarchive', $course->id)); ?>" method="POST"
                        onsubmit="return confirm('Unarchive this course?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <button type="submit" class="text-blue-500 hover:text-blue-500 font-bold text-xl">
                            <i class="fas fa-archive"></i> Unarchive Course</button>
                        </form>

                    <h2 class="text-lg font-semibold text-gray-600 mt-4"><?php echo e($course->title); ?></h2>
                    <p class="text-gray-500 mt-2"><?php echo e($course->description); ?></p>


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
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/courses/archive.blade.php ENDPATH**/ ?>