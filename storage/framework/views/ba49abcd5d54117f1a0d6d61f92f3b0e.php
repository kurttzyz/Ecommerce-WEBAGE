

<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_layout'); ?>

    <body class="bg-gray-50 font-sans antialiased">

        
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

        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-2">Mentorship Applications</h2>

            <?php $__empty_1 = true; $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
    $id = $seller->user_id;
    $fullName = $seller->first_name . ' ' . $seller->last_name;
    $isApproved = $seller->status === 'approved';
    $isDeclined = $seller->status === 'declined';
    $isPending = !$isApproved && !$isDeclined;
                ?>

                <div class="bg-white border border-gray-200 rounded-2xl shadow-md mb-10 p-8 hover:shadow-lg transition">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-semibold text-gray-800">
                            <?php echo e($seller->business_name); ?>

                            <span class="block text-sm text-gray-500 mt-1"><?php echo e($fullName); ?></span>
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 text-[15px] mb-6">
                        <div><strong class="text-gray-600">Email:</strong> <?php echo e($seller->email); ?></div>
                        <div><strong class="text-gray-600">Phone:</strong> <?php echo e($seller->phone); ?></div>
                        <div><strong class="text-gray-600">Country:</strong> <?php echo e($seller->country); ?></div>
                        <div><strong class="text-gray-600">Payment Method:</strong> <?php echo e($seller->payment_method); ?></div>
                        <div class="md:col-span-2">
                            <strong class="text-gray-600">Address:</strong> <?php echo e($seller->business_address); ?>

                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <?php $__currentLoopData = ['business_certificate' => 'Business Certificate', 'government_id' => 'Government ID']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <strong class="text-gray-600"><?php echo e($label); ?>:</strong><br>
                                <?php if($seller->$field): ?>
                                    <a href="<?php echo e(asset('storage/' . $seller->$field)); ?>" target="_blank" class="text-blue-600 hover:underline text-sm">
                                        View <?php echo e($label); ?>

                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400 italic text-sm">Not uploaded</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center justify-center gap-6 mt-8">
                        
                        <form action="<?php echo e(route('admin.approve', $id)); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col items-center space-y-3">
                            <?php echo csrf_field(); ?>
                            <label for="contract_<?php echo e($id); ?>" class="text-sm font-medium text-gray-700">
                                Upload Signed Contract
                            </label>
                            <input type="file" name="contract" id="contract_<?php echo e($id); ?>" required
                                class="block w-64 text-sm border border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 transition">

                            <button type="submit"
                                class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition disabled:opacity-50"
                                <?php echo e($isPending ? '' : 'disabled'); ?>>
                                Approve
                            </button>
                        </form>

                        
                        <form action="<?php echo e(route('admin.decline', $id)); ?>" method="POST" class="flex flex-col items-center space-y-3">
                            <?php echo csrf_field(); ?>
                            <div class="invisible md:visible h-[2.5rem]"></div>
                            <br><br><br>
                            <button type="submit"
                                class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition disabled:opacity-50"
                                <?php echo e($isPending ? '' : 'disabled'); ?>>
                                Decline
                            </button>
                        </form>
                    </div>

                    <div class="text-center mt-6">
                        <span class="text-sm font-semibold text-gray-600">Status:</span>
                        <?php if($isApproved): ?>
                            <span class="inline-block px-3 py-1 ml-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                Approved
                            </span>
                        <?php elseif($isDeclined): ?>
                            <span class="inline-block px-3 py-1 ml-2 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                                Declined
                            </span>
                        <?php else: ?>
                            <span class="inline-block px-3 py-1 ml-2 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">
                                Pending
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-center text-gray-500 text-base">No mentorship applications found.</p>
            <?php endif; ?>
        </div>
    </body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>