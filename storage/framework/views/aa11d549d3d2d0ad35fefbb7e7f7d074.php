
<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('seller_layout'); ?>
    <center><h1 class="text-white">Your Revenue</h1></center>
    <hr class="my-4 border-green-500 animate-fade-in-up">
    <center><h2 class="text-white">Total Revenue: ₱<?php echo e(number_format($grossRevenue , 2)); ?></h2></center>

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



<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/payments.blade.php ENDPATH**/ ?>