

<?php $__env->startSection('title_customer'); ?>
ConnectingNotes - Be A Mentor
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <form action="<?php echo e(route('customer.submitform')); ?>" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <?php echo csrf_field(); ?>

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
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Become a Mentor</h2>
    <hr class="my-4 border-green-500 animate-fade-in-up">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block font-semibold mb-1 text-black">Full Name</label>
        <input type="text" name="full_name" required class="text-black w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-black text-black">Email Address</label>
        <input type="email" name="email" required class="text-black w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-black">Phone Number</label>
        <input type="tel" name="phone" required class="text-black w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-black">Business Name/Service Name</label>
        <input type="text" name="business_name" required class="text-black w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-black">Business Type</label>
        <select name="business_type" required class="text-black w-full px-4 py-2 border rounded-md">
          <option value="">--Select Type--</option>
          <option value="sole_proprietor">Sole Proprietor</option>
          <option value="partnership">Partnership</option>
          <option value="corporation">Corporation</option>
          <option value="other">Other</option>
        </select>
      </div>


      <div>
        <label class="block font-semibold mb-1 text-black">Country/Region</label>
        <select name="country" required class="text-black w-full px-4 py-2 border rounded-md">
          <option value="" disabled selected>Select your country</option>
          <option value="ph">🇵🇭 Philippines</option>
          <option value="us">🇺🇸 United States</option>
          <option value="ca">🇨🇦 Canada</option>
          <option value="gb">🇬🇧 United Kingdom</option>
          <option value="au">🇦🇺 Australia</option>
          <option value="jp">🇯🇵 Japan</option>
          <option value="de">🇩🇪 Germany</option>
          <option value="fr">🇫🇷 France</option>
          <option value="in">🇮🇳 India</option>
          <option value="cn">🇨🇳 China</option>
        </select>
      </div>
      

      <div>
        <label class="block font-semibold mb-1 text-black">Business Address</label>
        <textarea name="business_address" rows="1" required class="text-black w-full px-4 py-2 border rounded-md"></textarea>
      </div>

      <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-black">Types of Services You Offer</label>
        <textarea name="product_types" rows="1" required class="text-black w-full px-4 py-2 border rounded-md"></textarea>
      </div>

      <div>
        <label class="block font-semibold mb-1 text-black">Do you manufacture your own products/services?</label>
        <select name="manufacture" class="text-black w-full px-4 py-2 border rounded-md">
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>


      <div>
        <label class="block font-semibold mb-1 text-black">Do you handle your own classes?</label>
        <select name="shipping" class=" text-black w-full px-4 py-2 border rounded-md">
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>


      <div>
        <label class="block font-semibold mb-1 text-black">Preferred Payment Method</label>
        <select name="payment_method" class="text-black w-full px-4 py-2 border rounded-md">
          <option value="bank_transfer">Bank Transfer</option>
          <option value="paypal">PayPal</option>
          <option value="other">Other</option>
        </select>
      </div>

    

      <div>
        <label class="block font-semibold mb-1 text-black">RESUME/CURRICULUM VITAE</label>
        <input type="file" name="business_certificate" accept=".pdf,.jpg,.png" required class="text-black w-full border rounded-md file:px-4 file:py-2 file:bg-green-500 file:text-white">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-black">Upload Government-issued ID</label>
        <input type="file" name="government_id" accept=".pdf,.jpg,.png" required class="text-black w-full border rounded-md file:px-4 file:py-2 file:bg-green-500 file:text-white">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-black">Contract & Agreement | You can download the form on the homepage footer</label>
        <input type="file" name="contract" accept=".pdf,.jpg,.png" required class="text-black w-full border rounded-md file:px-4 file:py-2 file:bg-green-500 file:text-white">
      </div>



      <div class="md:col-span-2 space-y-3">
        <label class="text-black inline-flex items-center">
          <input type="checkbox" name="agree_terms" required class="mr-2">
          I agree to the terms and conditions
        </label>
        <BR></BR>
        <label class="text-black inline-flex items-center">
          <input type="checkbox" name="confirm_info" required class="mr-2">
          I confirm all information is accurate
        </label>
      </div>
    </div>

    <button type="submit" class="text-black w-full mt-6 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-md transition duration-300">
      Submit Application
    </button>
  </form>

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


<?php echo $__env->make('customer.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/customer/become_seller/form.blade.php ENDPATH**/ ?>