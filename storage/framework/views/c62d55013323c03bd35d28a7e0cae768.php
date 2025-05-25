

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
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

        </center>

                <div class="bg-white max-w-xl mx-auto px-4 py-5">

                <h1 class="text-xl font-bold text-black text-center">Add Activity to Session: <?php echo e($course->title); ?></h1>
                <hr class="my-4 border-black animate-fade-in-up">
                <br>
                <form action="<?php echo e(route('activities.store', $course->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label class="block font-semibold text-black">Activity Title</label>
                        <input type="text" name="title" class="w-full border px-3 py-2 rounded text-black"
                            placeholder="Enter your activity title" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-black">Description</label>
                        <textarea name="description" class="w-full border px-3 py-2 rounded text-black"
                            placeholder="Enter your activity description"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-black">Due Date</label>
                        <input type="datetime-local" name="due_date" class="w-full border px-3 py-2 rounded text-black">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-black">Attach File or Photo</label>
                        <input type="file" name="attachment" class="w-full border px-3 py-2 rounded text-black" required>
                    </div>

                    <center><button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create Activity</button></center>
                </form>



                    <div class="mt-6 bg-gray-100 p-4 rounded">
                        <h2 class="font-semibold text-lg mb-2">Need Help?</h2>
                        <p class="mb-2 text-gray-700">Watch this short tutorial on how to create effective course activities:</p>
                        <div class="aspect-w-16 aspect-h-9 mb-4">
                            <iframe class="w-full h-64 rounded" src="https://www.youtube.com/embed/VIDEO_ID_HERE" frameborder="0"
                                allowfullscreen></iframe>
                        </div>

                        <p class="text-gray-700">Or download our guide:</p>
                        <a href="<?php echo e(asset('storage/guides/activity-creation-guide.pdf')); ?>" target="_blank"
                            class="text-green-600 underline hover:text-green-400">Download PDF Guide</a>
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




<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/activities/create.blade.php ENDPATH**/ ?>