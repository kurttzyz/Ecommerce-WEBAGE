

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes | Create Session
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>

    <div>
        <a href="<?php echo e(url()->previous()); ?>"
            class="inline-flex items-center text-black hover:text-blue transition duration-200 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

        <div class="bg-white py-6 px-6 max-w-xl mx-auto">
            <center><h1 class="text-xl font-bold mb-4">Add Session to: <?php echo e($course->title); ?></h1></center>
            <hr class="my-4 border-black animate-fade-in-up">

            <form action="<?php echo e(route('sessions.store', $course->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-4">
                    <label class="block font-semibold text-black">Session Title</label>
                    <input type="text" name="title" class="w-full border px-3 py-2 rounded text-black" placeholder="Enter session title" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-black">Description</label>
                    <textarea name="description" class="w-full border px-3 py-2 rounded text-black" placeholder="Enter session description"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-black">Schedule (Date & Time)</label>
                    <input type="datetime-local" name="schedule" class="w-full border px-3 py-2 rounded text-black" required>
                </div>

                <center><button class="bg-green-500 text-white px-4 py-2 rounded">Create Session</button></center>
            </form>
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
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/session/create.blade.php ENDPATH**/ ?>