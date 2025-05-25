

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>


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

    <div class="mb-8 form-control px-4 py-4">
        <center><h3 class="text-black text-xl font-bold mb-2">Add New Achievement</h3></center>
        <hr class="my-4 border-black animate-fade-in-up">
        <form action="<?php echo e(route('achievements.store')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block">Title</label>
                <input type="text" name="title" class="text-black w-full border px-3 py-2 rounded" placeholder="Enter achievement title" required>
            </div>
            <div>
                <label class="block">Description</label>
                <textarea name="description" class="text-black w-full border px-3 py-2 rounded" placeholder="Enter achievement description" required></textarea>
            </div>
            <div>
                <label class="block">Criteria</label>
                <textarea name="criteria" class="text-black  w-full border px-3 py-2 rounded" placeholder="Enter achievement criteria" required></textarea>
            </div>
            <div>
                <label class="block">Issued By</label>
                <input type="text" name="issued_by" class="text-black  w-full border px-3 py-2 rounded" placeholder="Enter the instructor's name" required>
            </div>
            <div>
                <label class="block">Level</label>
                <input type="text" name="level" class="text-black  w-full border px-3 py-2 rounded" placeholder="Enter the level" required>
            </div>
            <center><button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Achievement</button></center>
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
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/achievements/create.blade.php ENDPATH**/ ?>