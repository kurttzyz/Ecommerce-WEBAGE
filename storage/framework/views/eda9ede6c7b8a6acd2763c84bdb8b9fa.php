

<?php $__env->startSection('title_customer'); ?>
ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customer_layout'); ?>
      <!-- Back Button -->
      <div>
        <a href="<?php echo e(url()->previous()); ?>"
           class="inline-flex items-center text-green-400 hover:text-green-300 transition duration-200 mb-4">
            <!-- Heroicon: Arrow Left -->
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <div class="relative bg-black border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 animate-fade-in">
        <img class="w-full h-auto rounded-xl" src="<?php echo e(asset('storage/' . $product->images->first()->img_path)); ?>">
        <div class="absolute top-0 start-0 end-0">
          <div class="p-4 md:p-5">
            <h3 class="text-white text-lg font-bold text-white-800">
                <?php echo e($product->name); ?>

            </h3>

            <h3 class="text-white text-lg font-bold text-white-800">
                <center><p class="mt-1 text-white-800"><strong>Mentor's Name:</strong> <?php echo e($product->store->store_name); ?></p></center>
            </h3>

            <!-- Average Rating and Reviews -->



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
          </div>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-semibold text-white">Customer Reviews</h4>

            <?php if($product->reviews->count() > 0): ?>
                <div class="mt-2">
                    <!-- Average Rating -->
                    <div class="flex items-center">
                        <div class="flex text-yellow-400 mr-2">
                            <?php
    $averageRating = round($product->reviews->avg('rating'), 1);
                            ?>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="<?php echo e($i <= $averageRating ? 'currentColor' : 'none'); ?>" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 <?php echo e($i <= $averageRating ? 'text-yellow-400' : 'text-gray-300'); ?>">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.18 6.716h7.071c.969 0 1.371 1.24.588 1.81l-5.726 4.166 2.18 6.716c.3.921-.755 1.688-1.54 1.118l-5.726-4.166-5.726 4.166c-.784.57-1.838-.197-1.54-1.118l2.18-6.716L2.21 11.453c-.783-.57-.38-1.81.588-1.81h7.071l2.18-6.716z"/>
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <span class="text-sm text-white-800">(<?php echo e($averageRating); ?>/5 based on <?php echo e($product->reviews->count()); ?> reviews)</span>
                    </div>
                </div>

                <!-- Individual Reviews -->
                <div class="mt-4 space-y-2">
                    <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-yellow rounded-md p-3 bg-black dark:bg-neutral-800 text-white dark:text-white">
                            <div class="flex items-center mb-1">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <svg class="w-4 h-4 <?php echo e($i <= $review->rating ? 'text-yellow-400' : 'text-gray-300'); ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l2.18 6.716h7.071c.969 0 1.371 1.24.588 1.81l-5.726 4.166 2.18 6.716c.3.921-.755 1.688-1.54 1.118L10 17.748l-5.726 4.166c-.784.57-1.838-.197-1.54-1.118l2.18-6.716L.188 11.453c-.783-.57-.38-1.81.588-1.81h7.071l2.18-6.716z"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <p class="text-sm"><?php echo e($review->comment); ?></p>
                            <span class="text-xs text-gray-500">– <?php echo e($review->user->name); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-sm mt-2 text-white-800">No reviews yet.</p>
            <?php endif; ?>
        </div>

        <!-- Leave a Review -->
        <div class="mt-6">
            <h4 class="text-lg font-semibold text-white">Leave a Review</h4>
            <form action="<?php echo e(route('product.review.store', $product->id)); ?>" method="POST" class="mt-2 space-y-2">
                <?php echo csrf_field(); ?>
                <label for="rating" class="block text-xl text-white">Your Rating</label>
                <select name="rating" id="rating" class="w-full rounded-md border-gray-300 text-white bg-black">
                    <?php for($i = 5; $i >= 1; $i--): ?>
                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?> Star<?php echo e($i > 1 ? 's' : ''); ?></option>
                    <?php endfor; ?>
                </select>

                <label for="comment" class="block text-xl text-white">Comment</label>
                <textarea name="comment" id="comment" rows="3" class="w-full rounded-md border-gray-300 text-white bg-black" required></textarea>

                <center>
                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition-all duration-300">
                    Submit Review
                </button>
                </center>
            </form>
        </div> 
      </div>

<?php $__env->stopSection(); ?>

<style>
  @keyframes fadeIn {
      0% {
          opacity: 0;
      }
      100% {
          opacity: 1;
      }
  }
  
  .animate-fade-in {
      animation: fadeIn 1s ease-out forwards;
  }
</style>

<?php echo $__env->make('customer.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/customer/category/viewproduct.blade.php ENDPATH**/ ?>