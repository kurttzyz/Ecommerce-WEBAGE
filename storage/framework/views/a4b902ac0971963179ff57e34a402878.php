

<?php $__env->startSection('title_seller'); ?>
    ConnectingNotes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seller_layout'); ?>

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


        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <center><h2 class="text-xl font-bold mb-4">Mark Attendance - <?php echo e($course->title); ?></h2></center>
            <hr class="my-4 border-black animate-fade-in-up">

            <form action="<?php echo e(url('mentor/courses/' . $course->id . '/attendance')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-black">Date</label>
                    <input type="date" name="date" class="border p-2 rounded text-black" required>
                </div>

                <table class="w-full mb-4 text-left border">
                    <thead>
                        <tr>
                            <th class="p-2 border-b text-black">Student</th>
                            <th class="p-2 border-b text-black">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="p-2 border-b text-black">

                                    <select id="active-student" class="border p-2 rounded text-black">
                                        <option value="">Select a student</option>
                                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($student->id); ?>"><?php echo e($student->full_name ?? 'Name not available'); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>

                                <td class="p-2 border-b text-black">
                                    <select name="status[<?php echo e($student->id); ?>]" class="border p-2 mb-2 rounded text-black">
                                        <option value="">Select a status</option>
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late">Late</option>
                                        <option value="excused">Excused</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <center><button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Attendance</button></center>
            </form>
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

<script>
    document.getElementById('active-student').addEventListener('change', function () {
        const selectedId = this.value;
        const rows = document.querySelectorAll('.student-row');

        rows.forEach(row => {
            if (row.dataset.studentId === selectedId) {
                row.classList.add('bg-yellow-100');
            } else {
                row.classList.remove('bg-yellow-100');
            }
        });
    });
</script>
<?php echo $__env->make('seller.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/seller/attendance/create.blade.php ENDPATH**/ ?>