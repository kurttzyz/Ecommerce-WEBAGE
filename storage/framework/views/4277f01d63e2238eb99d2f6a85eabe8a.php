

<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_layout'); ?>
    <h1>Manage Your Site Revenues</h1>

    <form method="GET" action="<?php echo e(route('admin.manage.revenues')); ?>" class="mb-4">
        <label for="month">Month:</label>
        <select name="month" id="month">
            <option value="">-- All Months --</option>
            <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(str_pad($m, 2, '0', STR_PAD_LEFT)); ?>" <?php echo e(request('month') == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : ''); ?>>
                    <?php echo e(date('F', mktime(0, 0, 0, $m, 1))); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <label for="choice">Session:</label>
        <select name="choice" id="choice">
            <option value="">-- All Sessions --</option>
            <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($session->session_id); ?>" <?php echo e(request('choice') == $session->session_id ? 'selected' : ''); ?>>
                    <?php echo e($session->title); ?> <!-- Adjust this if the session name is stored in a different column -->
                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <button type="submit">Filter</button>
    </form>

    <canvas id="revenueChart" width="600" height="300"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels, 15, 512) ?>,
                datasets: [{
                    label: 'Revenue (₱)',
                    data: <?php echo json_encode($revenueData, 15, 512) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/manage/revenues.blade.php ENDPATH**/ ?>