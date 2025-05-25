

<?php $__env->startSection('title_customer'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customer_layout'); ?>
    <div class="container mx-auto p-6 space-y-10 bg-white min-h-screen">

      

        <!-- Store Card -->
        <div class="bg-gray-900 rounded-2xl shadow-lg overflow-hidden border border-green-800 animate-fade-in-up">

            <!-- Store Header -->
            <div class="bg-blue-600 from-blue-600 to-blue-800 p-6 text-white rounded-t-2xl  ">
                <h2 class="text-4xl font-bold"><?php echo e($viewstores->store_name); ?></h2>
                <p class="text-sm opacity-90"><?php echo e($viewstores->slug); ?></p>
            </div>

            <!-- Store Body -->
            <div class="bg-white p-6 space-y-6 animate-fade-in">
                <!-- Store Details -->
                <div>
                    <h3 class="text-xl font-bold text-black mb-2">About the Mentor</h3>
                    <p class="text-black leading-relaxed"><?php echo e($viewstores->details); ?></p>
                </div>

                <!-- Store Design Section -->
                <div>
                    <center>
                        <h1 class="text-2xl font-bold mb-4 text-black">Available Courses</h1>
                    </center>
                    <hr class="my-4 border-green-500 animate-fade-in-up">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-gray-200 rounded-lg shadow p-4">
                                <h2 class="text-xl font-semibold"><?php echo e($course->title); ?></h2>
                                <p style="color:black"><?php echo e($course->description); ?></p>

                                <?php $__currentLoopData = $course->sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mt-4">
                                        <h3 class="text-lg font-semibold text-black"><?php echo e($session->title); ?></h3>
                                        <p style="color:black"><?php echo e($session->description); ?></p>

                                        <?php
                                            $visitedCheckoutSessions = session('checkout_sessions', []);
                                        ?>

                                        <?php if(!in_array($session->id, $enrolledSessionIds)): ?>
                                            <?php if(in_array($session->id, $visitedCheckoutSessions)): ?>
                                                <!-- Show Enroll Button Only -->
                                                <form method="POST" action="<?php echo e(route('sessions.enroll', ['id' => $session->id])); ?>"
                                                    class="mt-2">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                                        Enroll
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <!-- Show Pay & Enroll Button -->
                                                <a href="<?php echo e(route('customer.checkout.form', ['session_id' => $session->id])); ?>"
                                                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                                    Pay & Enroll
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-green-600 font-medium">Already Enrolled</span>
                                            <hr style="color:black">
                                        <?php endif; ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Review Section -->
                <?php if(count($enrolledSessionIds) > 0): ?>
                    <h3 class="text-2xl font-bold text-black mb-4">Leave a Review</h3>

                    <form method="POST" action="<?php echo e(route('student.review', ['store' => $viewstores->id])); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label for="rating" class="block text-black font-medium mb-2">Rating (1 to 5):</label>
                            <select id="rating" name="rating"
                                class="w-full p-2 rounded bg-white text-black border border-red-600">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?> Star<?php echo e($i > 1 ? 's' : ''); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block text-black font-medium mb-2">Comment:</label>
                            <textarea id="comment" name="comment" rows="4"
                                class="w-full p-2 rounded bg-white text-black border border-red-600"></textarea>
                        </div>

                        <center>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">Submit
                                Review</button>
                        </center>
                    </form>
                <?php endif; ?>

                <?php if($reviews->count()): ?>
                    <div class="mt-8">
                        <h4 class="text-xl text-black font-semibold mb-4">What others are saying:</h4>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <center>
                                    <div class="bg-gray-200 p-4 rounded-lg border border-red-700">

                                        <p class="text-yellow-500 text-4xl">
                                            <?php echo e(str_repeat('★', $review->rating)); ?><?php echo e(str_repeat('☆', 5 - $review->rating)); ?>

                                        </p>
                                        <p class="text-black font-semibold text-xl"><?php echo e($review->user->full_name); ?></p>
                                        <p class="text-black text-xl"><?php echo e($review->comment); ?></p>
                                        <p class="text-gray-500 text-sm"><?php echo e($review->created_at->diffForHumans()); ?></p>
                                    </div>
                                </center>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- Custom Animations -->
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
            animation: fadeIn 0.8s ease-out both;
        }

        .animate-fade-in {
            animation: fadeIn 1.2s ease-out both;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- JavaScript to handle visibility toggle -->
<script>
    function handlePayEnroll(sessionId, checkoutUrl) {
        // Hide the Pay & Enroll button
        document.getElementById('payEnrollBtn-' + sessionId).style.display = 'none';

        // Show the Enroll form
        document.getElementById('enrollForm-' + sessionId).classList.remove('hidden');

        // Redirect to checkout
        window.location.href = checkoutUrl;
    }
</script>
<?php echo $__env->make('customer.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/customer/store/showstore.blade.php ENDPATH**/ ?>