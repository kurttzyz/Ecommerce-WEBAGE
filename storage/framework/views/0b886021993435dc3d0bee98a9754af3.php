

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>
    <div class="container mx-auto p-6 space-y-10 min-h-screen">

        <!-- Back Button -->
        <div>
            <a href="<?php echo e(url()->previous()); ?>"
                class="inline-flex items-center text-black hover:text-black transition duration-200 mb-4">
                <!-- Heroicon: Arrow Left -->
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
                class="bg-blue rounded-2xl shadow-md overflow-hidden border border-red-600 transform transition duration-500 hover:shadow-xl animate-fade-in-up">

                <!-- Store Header -->
                <div class="p-6 border-b border-red-600 bg-blue-600">
                    <h2 class="text-3xl font-semibold text-blue-400"><?php echo e($store->store_name); ?></h2>
                    <p class="text-sm text-blue-300 mt-1"><span class="font-mono"><?php echo e($store->slug); ?></span></p>
                </div>

                <!-- Store Body -->
                <div class="p-6 md:flex md:items-start md:justify-between">
                    <!-- Store Details -->
                    <div class="md:w-3/4 space-y-2">
                        <h3 class="text-lg font-medium text-blue-300">About the Mentor</h3>
                        <p class="text-black leading-relaxed text-sm"><?php echo e($store->details); ?></p>
                    </div>

                    <!-- CTA -->
                    <div class="mt-6 md:mt-0 md:w-1/4 text-right">
                        <a href="<?php echo e(route('seller.store.show', $store->slug)); ?>"
                            class="inline-block bg-red-600 text-white font-medium py-2 px-5 rounded-lg shadow hover:bg-red-700 transition duration-300">
                            Visit Mentor
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Fade Animation Style -->
    <style>
        @keyframes fadeInUp {
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
            animation: fadeInUp 0.7s ease-out both;
        }
    </style>
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
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/store/viewstore.blade.php ENDPATH**/ ?>