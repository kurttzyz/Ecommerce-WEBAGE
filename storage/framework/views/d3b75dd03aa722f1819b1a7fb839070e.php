

<?php $__env->startSection('title_customer'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

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
        <center><h1 class="text-3xl font-bold mb-4 text-black">My Courses</h1></center>
        <hr class="my-4 border-black animate-fade-in-up">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="rounded-lg shadow p-4 bg-cover bg-center" >
                    <div class="relative rounded overflow-hidden">
                        <div class="absolute inset-0 bg-black bg-opacity-40 z-0"
                            style="background-image: url('<?php echo e(asset('landingpage/img/room.jpg')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        </div>
                        <div class="relative z-10 p-4">


                        <div class="course-card" >
                            <h3 style="color:white; text-align:center" class="bg-gray-600"><?php echo e($course->title); ?></h3>
                           <br><br>
                           <br>
                           <br>
                           <br>
                </div>

      
                <center>
                    <a href="<?php echo e(route('classroom.show', $course->id)); ?>"
                        class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition duration-200">
                        Enter Class
                    </a>
                </center>

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
<?php echo $__env->make('customer.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/customer/class/index.blade.php ENDPATH**/ ?>