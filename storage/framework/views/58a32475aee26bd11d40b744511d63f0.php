

<?php $__env->startSection('title_customer', 'ConnectingNotes'); ?>

<?php $__env->startSection('customer_layout'); ?>
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

        <center>
            <h1 class="text-3xl font-extrabold mb-2 tracking-wide text-black font-bold">🏅 My Achievements</h1>
        </center>
        <hr class="my-4 border-black animate-fade-in-up">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 mb-12">
            <?php $__empty_1 = true; $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div
                    class="bg-gradient-to-br from-yellow-100 via-white to-yellow-50 p-5 rounded-xl shadow-lg border border-yellow-300 animate-fade-in-up hover:scale-105 transform transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#fbbf24" viewBox="0 0 24 24" class="w-8 h-8">
                            <path
                                d="M12 2C11.4 2 11 2.4 11 3V4.4L9.4 6H6C5.4 6 5 6.4 5 7V9C5 9.6 5.4 10 6 10H6.3L7 13H5C4.4 13 4 13.4 4 14V16C4 16.6 4.4 17 5 17H8L9 21L12 19.2L15 21L16 17H19C19.6 17 20 16.6 20 16V14C20 13.4 19.6 13 19 13H17L17.7 10H18C18.6 10 19 9.6 19 9V7C19 6.4 18.6 6 18 6H14.6L13 4.4V3C13 2.4 12.6 2 12 2ZM12 8C13.7 8 15 9.3 15 11C15 12.7 13.7 14 12 14C10.3 14 9 12.7 9 11C9 9.3 10.3 8 12 8Z" />
                        </svg>
                        <h2 class="text-xl font-bold text-yellow-700"><?php echo e($achievement->title); ?></h2>
                    </div>

                    <p class="text-sm text-gray-700 mb-2"><?php echo e($achievement->description); ?></p>

                    <p class="text-xs text-gray-600 italic mb-2">
                        Issued by:
                        <span class="font-semibold text-gray-800"><?php echo e($achievement->issued_by ?? 'Unknown'); ?></span>
                    </p>
                    <?php
                        $progress = $achievement->pivot->progress ?? 0;
                        $progressColor = $progress >= 100 ? 'bg-green-500' : ($progress >= 50 ? 'bg-yellow-400' : 'bg-red-400');
                    ?>

                    <!-- Progress bar -->
                    <div class="mt-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-xs font-medium text-gray-700">Progress</span>
                            <span class="text-xs font-medium text-gray-700"><?php echo e($progress); ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                            <div class="<?php echo e($progressColor); ?> h-4 rounded-full transition-all duration-500 ease-out animate-pulse"
                                style="width: <?php echo e($progress); ?>%">
                            </div>
                        </div>
                    </div>


                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-black text-center col-span-3">No achievements to display.</p>
            <?php endif; ?>
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
        animation: fadeIn 0.8s ease-out forwards;
    }
</style>
<?php echo $__env->make('customer.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/customer/achievements/index.blade.php ENDPATH**/ ?>