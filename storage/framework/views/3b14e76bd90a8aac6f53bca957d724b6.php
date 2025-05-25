


<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>



        <div class="bg-white py-4 px-4 max-w-lg mx-auto">

        <ul>
    <div class="p-4">
        <div class="overflow-x-auto">
            <center>
                <h2 style="color:black">All Student Work Submissions</h2>
            </center>
            <hr class="my-4 border-black animate-fade-in-up">
            <br>
            <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            File</th>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Grade</th>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created
                            At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo e($submission->id); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo e($submission->activity->title); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo e($submission->content); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 underline">
                            <?php if($submission->attachment): ?>
                                <a href="<?php echo e(asset('storage/' . $submission->attachment)); ?>" target="_blank">View</a>
                            <?php else: ?>
                                <span class="text-gray-400">No file</span>
                            <?php endif; ?>


                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 relative">
                                <!-- Grade link -->
                                <a href="javascript:void(0);" onclick="toggleGradeForm(<?php echo e($submission->id); ?>)"
                                    class="text-blue-600 underline cursor-pointer">
                                    <?php echo e($submission->grade ?? 'Add Grade'); ?>

                                </a>

                                <!-- Hidden grade form -->
                                <div id="grade-form-<?php echo e($submission->id); ?>" class="hidden mt-2 p-2 border rounded bg-gray-50 absolute z-10">
                                    <form action="<?php echo e(route('submissions.updateGrade', $submission->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <input type="number" name="grade" min="0" max="100" value="<?php echo e($submission->grade ?? ''); ?>"
                                            class="border rounded px-2 py-1 w-20" required>
                                        <button type="submit"
                                            class="ml-2 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Submit</button>
                                        <button type="button" onclick="toggleGradeForm(<?php echo e($submission->id); ?>)"
                                            class="ml-2 text-gray-500 hover:text-gray-800">Cancel</button>
                                    </form>
                                </div>                      
                             </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <?php echo e($submission->created_at->format('Y-m-d')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">No submissions found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


        </ul>

        <div>


            <script>
                function toggleGradeForm(id) {
                    const form = document.getElementById('grade-form-' + id);
                    if (form.classList.contains('hidden')) {
                        form.classList.remove('hidden');
                    } else {
                        form.classList.add('hidden');
                    }
                }
            </script>
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

    
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/submission/index.blade.php ENDPATH**/ ?>