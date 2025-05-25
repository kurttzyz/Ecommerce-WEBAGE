

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>



    <div class="bg-white py-4 px-4 max-w-lg mx-auto">
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
            <h1 class="text-2xl  mb-4 text-black">Create New Course</h1>
            </center>
            <hr class="my-4 border-black animate-fade-in-up">
        <form method="POST" action="<?php echo e(route('courses.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-black">Course Title</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded text-black" placeholder="Create course title" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-black">Section/Description</label>
                <textarea name="description" class="w-full border px-3 py-2 rounded text-black" placeholder="Provide course description"></textarea>
            </div>

            <center>><button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button></center
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
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/courses/create.blade.php ENDPATH**/ ?>