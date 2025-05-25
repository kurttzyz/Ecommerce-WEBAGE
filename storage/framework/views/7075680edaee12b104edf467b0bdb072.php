

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>
    <div class="max-w-4xl mx-auto py-8">
        <a href="<?php echo e(url()->previous()); ?>" class="text-green-500 hover:underline mb-4 inline-block">← Back</a>

        <h1 class="text-3xl font-bold text-black mb-6">Manage Students for: <?php echo e($course->title); ?></h1>

        <div class="bg-white rounded shadow p-6">
            <?php if($students->count()): ?>
                <table class="w-full table-auto border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2 text-left text-black">Name</th>
                            <th class="border px-4 py-2 text-left text-black">Email</th>
                            <th class="border px-4 py-2 text-left text-black">Enrolled At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="border px-4 py-2 text-black"><?php echo e($student->full_name); ?></td>
                                <td class="border px-4 py-2 text-black"><?php echo e($student->email); ?></td>
                                <td class="border px-4 py-2 text-black">
                                    <?php echo e(optional($student->pivot)->created_at?->format('F j, Y') ?? 'N/A'); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-600">No students enrolled in this class yet.</p>
            <?php endif; ?>

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
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/courses/manage_students.blade.php ENDPATH**/ ?>