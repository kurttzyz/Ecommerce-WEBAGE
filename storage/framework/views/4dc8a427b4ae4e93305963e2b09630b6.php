

<?php $__env->startSection('title_customer'); ?>
    <?php echo e($course->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('customer_layout'); ?>





    <div>
        <a href="<?php echo e(url()->previous()); ?>"
            class="inline-flex items-center text-black hover:text-blue transition duration-200 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

                <div class="bg-white py-4 px-4 opacity-99" >>
                    <center><h1 class="text-3xl font-bold text-black mb-4"><?php echo e($course->title); ?></h1></center>
                    <center><p class="mb-2 text-black"><?php echo e($course->description); ?></p></center>
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

                    <center><p class="text-gray-700">
                        <strong>Instructor:</strong> <?php echo e($course->course->mentor->full_name ?? 'N/A'); ?>

                    </p>
                    </center>


                    
                    <div class="mt-8 bg-green-50 border border-green-200 p-4 rounded shadow">
                        <h2 class="text-lg font-semibold text-green-700 mb-2">Need Help with This Activity?</h2>
                        <p class="text-gray-700 mb-3">Watch the tutorial below to understand how to complete and submit your activity
                            properly.</p>

                        
                        <div class="aspect-w-16 aspect-h-9 mb-4">
                            <iframe class="w-full h-64 rounded" src="https://www.youtube.com/embed/AmC_qmSODEk" frameborder="0"
                                allowfullscreen></iframe>
                        </div>

                    </div>




                    
                    <div class="bg-white rounded shadow p-6 mb-6">
                        <center><h2 class="text-2xl font-bold text-gray-800 mb-4">Announcements</h2>
                         <hr style="color:black"></center>


                        <?php $__empty_1 = true; $__currentLoopData = $course->course->announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="bg-gray-100 p-4 rounded-lg shadow mb-4" style="text-align:center">
                                <h3 class="text-lg font-semibold text-gray-800"><?php echo e($announcement->title); ?></h3>
                                <p class="text-gray-700"><?php echo e($announcement->body); ?></p>
                                <p class="text-gray-500">
                                    Posted by: <?php echo e($announcement->mentor->name ?? 'N/A'); ?>

                                </p>
                                <br>
                                <small class="text-gray-500">
                                    Posted: <?php echo e($announcement->created_at->format('F j, Y \a\t g:i A')); ?>

                                </small>    

                                    
                                    <div class="mt-4">
                                        <h4 class="text-lg font-semibold text-gray-700">Responses:</h4>
                                        <?php $__currentLoopData = $announcement->responses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="mt-2 p-3 bg-gray-200 rounded-lg">
                                                <p class="font-semibold text-black"><?php echo e($response->student ? $response->student->name : 'User'); ?></p>
                                                <p class="text-gray-700"><?php echo e($response->response); ?></p>
                                                <small class="text-gray-500"><?php echo e($response->created_at->format('F j, Y \a\t g:i A')); ?></small>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>


                                
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg shadow">
                                    <h4 class="text-lg font-semibold text-gray-700">Respond to this Announcement</h4>

                                    <form action="<?php echo e(route('announcements.respond', $announcement->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="mb-2">
                                            <textarea name="response" id="response" rows="4"
                                                class="w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                                                placeholder="Enter your response" required></textarea>
                                        </div>

                                        <div class="flex justify-center">
                                            <button type="submit"
                                                class="bg-blue text-black">
                                                Submit Response
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-gray-500" style="text-align:center">No announcements available.</p>
                        <?php endif; ?>
                    </div>

                    
                    <div class="bg-white rounded shadow p-6 mb-6">
                        <center>
                            <h2 class="text-2xl font-bold text-gray-800 mb-4" >Upcoming Activities/Assignments</h2>
                            <hr style="color:black">
                        </center>

                    <?php $__empty_1 = true; $__currentLoopData = $course->course->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="bg-gray-100 p-4 rounded-lg shadow mb-4 text-center">
                                <h3 class="text-lg font-semibold text-gray-800"><?php echo e($activity->title); ?></h3>
                                <p class="text-gray-700"><?php echo e($activity->description); ?></p>
                                <a href="<?php echo e(asset('storage/' . $activity->attachment_path)); ?>" target="_blank" class="text-blue-500 underline">
                                    View Attachment
                                </a>
                                <br>
                                <small class="text-gray-500">Created:
                                    <?php echo e(\Carbon\Carbon::parse($activity->date)->format('F j, Y \a\t g:i A')); ?></small>
                                <br>
                                <small class="text-gray-500">Deadline:
                                    <?php echo e(\Carbon\Carbon::parse($activity->due_date)->format('F j, Y \a\t g:i A')); ?></small>
                                <hr class="my-4 border-black">

                                <?php
                                    $studentSubmission = \App\Models\Submission::where('activity_id', $activity->id)
                                        ->where('student_id', auth()->id())
                                        ->first();
                                ?>


                                <?php if($studentSubmission): ?>
                                    <p class="text-green-600 font-semibold mb-2">You have already submitted this activity.</p>
                                    <p class="text-green-600 font-semibold mb-4">Mark: <?php echo e($studentSubmission->grade ?? 'Not graded yet'); ?>/100</p>


                                    <button disabled class="bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed">
                                        Already Submitted
                                    </button>
                                <?php else: ?>
                                    <h1 class="text-xl font-bold mb-2">Submit Your Work</h1>
                                    <form action="<?php echo e(route('submissions.store', $activity->id)); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="mb-2">
                                            <label for="content" class="block text-lg font-semibold text-gray-800">Add Your Content</label>
                                            <input type="text" name="content" id="content"
                                                class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                                                placeholder="Enter your content" required>
                                        </div>

                                        <div class="mb-4 text-center">
                                            <label for="attachment" class="block text-lg font-semibold text-gray-800 mb-2">Attach Your File</label>
                                            <div class="flex justify-center">
                                                <input type="file" name="attachment" id="attachment"
                                                    class="text-sm text-gray-700 file:bg-blue-500 file:text-white file:rounded file:px-3 file:py-1 file:cursor-pointer focus:outline-none w-fit"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="flex justify-center">
                                            <button type="submit"
                                                class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Turn In
                                            </button>
                                        </div>
                                    </form>

                                <?php endif; ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <p class="text-gray-500 text-center">No upcoming activities at the moment.</p>
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
<?php echo $__env->make('customer.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/customer/class/show.blade.php ENDPATH**/ ?>