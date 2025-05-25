

<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_layout'); ?>
<h1 class="text-3xl font-bold mb-2">Manage Certificates</h1>


    <div class="container mx-auto px-4 py-6">
   
        <?php if($certificates->isEmpty()): ?>
            <p class="text-gray-600 text-center">No certificates found.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                            <th class="px-6 py-3">Certificate Name</th>
                            <th class="px-6 py-3">Issued To</th>
                            <th class="px-6 py-3">Instructor Name</th>
                            <th class="px-6 py-3">Date Issued</th>
                            <th class="px-6 py-3">Certificate No.</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4"><?php echo e($certificate->event ?? 'N/A'); ?></td>
                                <td class="px-6 py-4"><?php echo e($certificate->name ?? 'N/A'); ?></td>
                                <td class="px-6 py-4"><?php echo e($certificate->instructor ?? 'N/A'); ?></td>
                                <td class="px-6 py-4"><?php echo e($certificate->created_at->format('Y-m-d') ?? 'N/A'); ?></td>
                                <td class="px-6 py-4"><?php echo e($certificate->certificate_no ?? 'N/A'); ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="<?php echo e(route('certificates.admin', $certificate->student_id)); ?>"
                                            class="inline-block px-4 py-2 bg-green-500 text-white text-xs font-semibold rounded hover:bg-blue-600 transition">
                                            <button>View</button>
                                        </a>

                                        
                                    </div>                           
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/certificates/index.blade.php ENDPATH**/ ?>