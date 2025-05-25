<?php $__env->startSection('title'); ?>
Send Message
<?php $__env->stopSection(); ?>
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
    <div class="container mx-auto max-w-3xl p-4">

        <h1 class="text-3xl font-bold mb-8 text-center">Message Someone</h1>

        
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-8 text-center font-medium">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="mb-12 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Send a Message</h2>
            <form action="<?php echo e(route('messages.send')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="receiver_id" class="block font-medium mb-2">Select Recipient</label>
                    <select name="receiver_id" id="receiver_id" required
                        class="block w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected>-- Choose user to message --</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>">
                                <?php echo e($user->full_name); ?> (<?php echo e(getRoleLabel($user->role)); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['receiver_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="message" class="block font-medium mb-2">Message</label>
                    <textarea name="message" id="message" rows="4" required
                        class="block w-full border border-gray-300 rounded px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Type your message here..."><?php echo e(old('message')); ?></textarea>
                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition w-full font-semibold">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        
        <div>
           

            <h2 class="text-2xl font-semibold mb-8 text-center ">Your Messages</h2>

            <?php if($messages->isEmpty()): ?>
                <p class="text-gray-600 text-center">No messages yet.</p>
            <?php else: ?>
                <ul class="space-y-12">
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($message->sender_id === Auth::id() || $message->receiver_id === Auth::id()): ?>
                            <li class="border border-gray-300 rounded-lg p-6 shadow-md bg-white">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="<?php echo e($message->sender->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->sender->full_name)); ?>"
                                            alt="<?php echo e($message->sender->full_name); ?> profile picture"
                                            class="w-12 h-12 rounded-full object-cover border border-gray-300">
                                        <div>
                                            <p class="font-semibold">From: <?php echo e($message->sender->full_name); ?></p>
                                            <p class="text-sm text-gray-500"><?php echo e(getRoleLabel($message->sender->role)); ?></p>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php echo e($message->created_at->diffForHumans()); ?>

                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 mb-4">
                                    <img src="<?php echo e($message->receiver->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->receiver->full_name)); ?>"
                                        alt="<?php echo e($message->receiver->full_name); ?> profile picture"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-300">
                                    <div>
                                        <p><span class="font-semibold">To:</span> <?php echo e($message->receiver->full_name); ?></p>
                                        <p class="text-sm text-gray-500"><?php echo e(getRoleLabel($message->receiver->role)); ?></p>
                                    </div>
                                </div>

                                <p class="text-gray-800 whitespace-pre-line leading-relaxed"><?php echo e($message->message); ?></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
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
<?php endif; ?><?php /**PATH C:\music\resources\views/messages/index.blade.php ENDPATH**/ ?>