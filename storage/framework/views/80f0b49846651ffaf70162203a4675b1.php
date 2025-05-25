<?php $__env->startSection('title', 'All Messages'); ?>

<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto max-w-3xl p-4 flex-direction-column">
        <h1 class="text-2xl font-bold mb-4">All Messages</h1>

        <?php if($messages->isEmpty()): ?>
            <p class="text-gray-600">No messages yet.</p>
        <?php else: ?>
            <ul class="space-y-4">
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="border border-gray-200 p-4 rounded shadow-sm bg-white">
                        <div class="mb-1 text-sm text-gray-500 flex items-center space-x-2">
                            
                            <img src="<?php echo e($message->sender->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->sender->full_name)); ?>"
                                alt="Sender Avatar" class="w-8 h-8 rounded-full object-cover border border-gray-300">
                            <div>
                                <strong><?php echo e($message->sender->full_name); ?></strong>
                                (<?php echo e(getRoleLabel($message->sender->role)); ?>)
                                to
                            </div>

                            
                            <img src="<?php echo e($message->receiver->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->receiver->full_name)); ?>"
                                alt="Receiver Avatar" class="w-8 h-8 rounded-full object-cover border border-gray-300 ml-2">
                            <div>
                                <strong><?php echo e($message->receiver->full_name); ?></strong>
                                (<?php echo e(getRoleLabel($message->receiver->role)); ?>)
                            </div>

                            <span class="ml-auto text-xs text-gray-400">
                                <?php echo e($message->created_at->diffForHumans()); ?>

                            </span>
                        </div>
                        <p class="text-gray-800 mt-2"><?php echo e($message->message); ?></p>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="mt-4">
                <?php echo e($messages->links()); ?>

            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\music\resources\views/community/index.blade.php ENDPATH**/ ?>