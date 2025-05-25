<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">

    
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

    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                <table cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <tr>
                        <td style="padding: 30px; text-align: center;">
                            <h2 style="margin-bottom: 10px; color: #333;">Email Verification</h2>
                            <p style="font-size: 16px; color: #555;">Hello <strong><?php echo e($user->full_name); ?></strong>,</p>
                            <p style="font-size: 16px; color: #555;">Please use the code below to verify your email
                                address:</p>
                            <p style="font-size: 24px; font-weight: bold; color: #2d89ef; margin: 20px 0;">
                                <?php echo e($user->verification_code); ?>

                            </p>
                            <p style="font-size: 14px; color: #888;">If you did not request this, please ignore this
                                message.</p>
                            <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
                            <p style="font-size: 12px; color: #aaa;">&copy; <?php echo e(date('Y')); ?> ConnectingNotes. All rights
                                reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html><?php /**PATH C:\music\resources\views/emails/verify_code.blade.php ENDPATH**/ ?>