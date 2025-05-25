

<?php $__env->startSection('title_customer'); ?>
    ConnectingNotes | Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('home'); ?>

    
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
    <h1 class="text-center font-bold text-black text-3xl">Dashboard</h1>
    <hr class="my-4 border-black animate-fade-in-up">


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        <?php if($courses->count()): ?>
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow-md rounded-2xl overflow-hidden p-4 flex flex-col space-y-4">
                    
                    <div class="flex items-center space-x-4">
                        <img src="<?php echo e($course->mentor->profile_photo ? asset('storage/' . $course->mentor->profile_photo) : asset('images/default-avatar.png')); ?>"
                            alt="Profile" class="w-16 h-16 rounded-full object-cover border border-gray-300">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800"><?php echo e($course->title); ?></h3>
                            <p class="text-sm text-gray-600">Mentor: <?php echo e($course->mentor->full_name ?? 'N/A'); ?></p>
                        </div>
                    </div>

                    
                    <div class="text-sm text-gray-700">
                        <p><strong>Contact:</strong> <?php echo e($course->mentor->contact_number); ?></p>
                        <p><strong>Address:</strong> <?php echo e($course->mentor->address); ?></p>


                    
                    <?php
        $store = optional($course->mentor)->store;
        $reviews = $store ? $store->mentorReviews : collect();
        $averageRating = $reviews->avg('rating') ?? 0;
                    ?>

                    <?php if($reviews->count()): ?>
                        <div class="text-sm text-yellow-400">
                            <strong>Average Rating:</strong> <?php echo e(number_format($averageRating, 1)); ?>/5
                            (<?php echo e($reviews->count()); ?> review<?php echo e($reviews->count() > 1 ? 's' : ''); ?>)
                        </div>
                    <?php else: ?>
                        <div class="text-sm text-gray-500">No reviews yet.</div>
                    <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p class="text-gray-700">You are not enrolled in any mentor’s course.</p>
        <?php endif; ?>
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
<?php echo $__env->make('customer.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>