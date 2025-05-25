

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes - Issued Certificates
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_cart'); ?>

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

    <div class="max-w-6xl mx-auto mt-10 p-8 bg-white shadow-xl rounded-xl animate-fade-in-up">
        <center><h2 class="text-3xl font-bold mb-4 text-gray-800">Issued Certificates</h2></center>
        <hr class="my-4 border-black animate-fade-in-up">

        <?php if($certificates->count()): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200 rounded">
                    <thead class="bg-gray-100 text-sm text-gray-700 uppercase">
                        <tr>
                            <th class="py-3 px-5 border-b">#</th>
                            <th class="py-3 px-5 border-b">Name</th>
                            <th class="py-3 px-5 border-b">Event</th>
                            <th class="py-3 px-5 border-b">Date</th>
                            <th class="py-3 px-5 border-b">Instructor</th>
                            <th class="py-3 px-5 border-b text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-5 border-b"><?php echo e($loop->iteration); ?></td>
                                <td class="py-2 px-5 border-b font-medium"><?php echo e($certificate->name); ?></td>
                                <td class="py-2 px-5 border-b"><?php echo e($certificate->event); ?></td>
                                <td class="py-2 px-5 border-b"><?php echo e(\Carbon\Carbon::parse($certificate->date)->format('M d, Y')); ?>

                                </td>
                                <td class="py-2 px-5 border-b"><?php echo e($certificate->instructor); ?></td>
                                <td class="py-2 px-5 border-b text-center">
                                    <a href="<?php echo e(route('certificates.show', $certificate->id)); ?>"
                                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-1 px-3 rounded transition duration-150">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <?php echo e($certificates->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-gray-600 mt-6">No certificates found.</p>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/certificates/index.blade.php ENDPATH**/ ?>