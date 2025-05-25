<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f7f9fc; font-family: Arial, sans-serif;">

    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <form method="POST" action="<?php echo e(route('verify')); ?>"
            style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">

            <?php echo csrf_field(); ?>
            <input type="hidden" name="email" value="<?php echo e($user->email); ?>">

            <h2 style="margin-bottom: 20px; text-align: center; color: #333;">Verify Your Email</h2>

            <label for="verification_code"
                style="display: block; margin-bottom: 8px; font-weight: bold; color: #555;">Verification Code</label>
            <input type="text" name="verification_code" id="verification_code" required
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 12px;">

            <?php $__errorArgs = ['verification_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color: red; margin-bottom: 10px;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <button type="submit"
                style="width: 100%; padding: 12px; background-color: #2d89ef; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                Verify
            </button>

        </form>
    </div>

</body>

</html><?php /**PATH C:\music\resources\views/auth/verify.blade.php ENDPATH**/ ?>