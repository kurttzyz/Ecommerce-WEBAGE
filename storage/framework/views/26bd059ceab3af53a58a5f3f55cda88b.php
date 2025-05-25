<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>

        <div class="mt-8 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Mentor Overview</h2>
            <canvas id="overviewChart" height="100"></canvas>
        </div>


        <script>
            const totalSessions = <?php echo e($totalSessions); ?>;
            const totalStudents = <?php echo e($totalStudents); ?>;

            new Chart(document.getElementById('overviewChart'), {
                type: 'bar',
                data: {
                    labels: ['Total Sessions', 'Total Students'],
                    datasets: [{
                        label: 'Overview',
                        data: [totalSessions, totalStudents],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 99, 132, 0.6)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Total Sessions vs Students Enrolled'
                        }
                    }
                }
            });
        </script>



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

<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/dashboard.blade.php ENDPATH**/ ?>