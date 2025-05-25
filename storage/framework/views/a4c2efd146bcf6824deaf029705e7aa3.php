

<?php $__env->startSection('title_customer'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

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
            <h1 class="text-3xl font-bold mb-4 text-black">My Certificates</h1>
        </center>
        <hr class="my-4 border-black animate-fade-in-up">
        <div class="container">

            <?php if($certificates->count()): ?>
                <ul class="list-group">
                    <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            Issued to: <strong><?php echo e($certificate->name); ?></strong> — Certificate: <strong><?php echo e($certificate->event); ?></strong> — Issued by: <strong><?php echo e($certificate->instructor); ?></strong> — Certificate No.: <strong><?php echo e($certificate->certificate_no); ?></strong> — Date Issued: <strong><?php echo e($certificate->created_at->format('F d, Y')); ?></strong>
                            <a href="<?php echo e(route('certificates.student', $certificate->student_id)); ?>" 
                                class="btn btn-sm btn-primary float-end">View</a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <p class="text-black">No certificates found.</p>
            <?php endif; ?>  </div>

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

   
<?php echo $__env->make('customer.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/customer/certificate/view.blade.php ENDPATH**/ ?>