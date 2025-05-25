

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <center><h2 class="text-2xl font-semibold mb-4">Assign Achievements to Students</h2></center>
        <hr class="my-4 border-black animate-fade-in-up">

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

        <div class="space-y-4">

            <form action="<?php echo e(route('assign.achievement.single')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="student_id" style="color:black">Select Student</label>
                    <select name="student_id" id="student_id" required class="border rounded p-2 w-full text-black">
                        <option value="" disabled selected>Select a student</option>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($student->id); ?>"><?php echo e($student->full_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="achievement_id" style="color:black">Select Achievement</label>
                    <select name="achievement_id" id="achievement_id" required class="border rounded p-2 w-full text-black">
                        <option value="" disabled selected>Select an achievement</option>
                        <?php $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($achievement->id); ?>"><?php echo e($achievement->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <center><button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Assign Achievement</button></center>
            </form>

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
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/achievements/index.blade.php ENDPATH**/ ?>