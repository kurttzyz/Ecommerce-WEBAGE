

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


            <div class="max-w-xl mx-auto bg-white p-6 px-4 rounded shadow">
                <center>
                    <h2 class="text-xl font-bold mb-4 text-black">Post Announcement - <?php echo e($course->title); ?></h2>
                    </center>
                    <hr class="my-4 border-black animate-fade-in-up">
                <form action="<?php echo e(url('mentor/courses/' . $course->id . '/announcements')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1 text-black">Title</label>
                        <input type="text" name="title" class="w-full border rounded p-2 text-black" placeholder="Post your announcement title" required>
                    </div>  
                    <div class="mb-4">
                        <label class="block font-semibold mb-1 text-black">Body</label>
                        <textarea name="body" class="w-full border rounded p-2 text-black" placeholder="Enter you announcement here" required></textarea>
                    </div>
                    <center><button type="submit" class="bg-green-600 text-black px-4 py-2 rounded text-white">Post</button></center>
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
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/announcements/create.blade.php ENDPATH**/ ?>