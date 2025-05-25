
<?php $__env->startSection('title_admin'); ?>
    ConnectingNotes | Admin
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_layout'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


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

    <?php if($certificates->count() > 0): ?>
        <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
                class="max-w-4xl mx-auto my-6 border border-gray-300 rounded-xl shadow-xl p-10 text-center relative animate-fade-in-up bg-[#F9E8E2] print:bg-white page-break">

                <!-- Logo -->
                <div class="flex justify-center mb-2">
                    <img src="<?php echo e(asset('landingpage/img/notes.png')); ?>" alt="Logo" class="w-[90px] h-[90px] object-contain">
                </div>

                <!-- School Info -->
                <h2 class="text-sm font-semibold text-red-700">Herliz Music School</h2>
                <h3 class="text-lg font-medium text-gray-800 mb-4">MUSIC SCHOOL LESSON COMPLETION</h3>

                <!-- Certificate Title -->
                <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold text-red-600 tracking-widest my-4">C E R T I F I C A T E</h1>

                <!-- Recipient -->
                <p class="text-gray-700 text-lg mb-2">This Certificate is Presented to</p>
                <div class="text-2xl font-bold text-red-600 border-b-2 border-gray-500 inline-block px-6 py-1 mb-6">
                    <?php echo e($certificate->name); ?>

                </div>

                <!-- Description -->
                <p class="text-gray-800 text-lg leading-relaxed mb-6 max-w-2xl mx-auto">
                    In recognition of completing lessons.<br>
                    They have successfully mastered skills, showcasing remarkable growth and talent.
                </p>

                <!-- Award Date -->
                <p class="text-gray-700 text-lg mb-1">Awarded on</p>
                <div class="text-base font-semibold border-b-2 border-gray-500 inline-block px-4 py-1 mb-10 text-black">
                    <?php echo e(\Carbon\Carbon::parse($certificate->date)->format('F j, Y')); ?>

                </div>

                <!-- Signatures -->
                <div class="flex justify-between items-end mt-12 px-10 print:flex-col print:gap-10">
                    <!-- Owner -->
                    <div class="flex flex-col items-center relative w-48 h-16">
                        <img src="<?php echo e(asset('landingpage/img/sign.png')); ?>" alt="Owner Signature"
                            class="absolute inset-0 w-full h-full object-contain opacity-30 z-0">
                        <p class="text-base font-semibold text-black relative z-10">
                            <?php echo e($certificate->owner ?? 'Herliz Owner'); ?>

                        </p>
                        <div class="border-b border-black w-full mt-1 mb-1 z-10 relative"></div>
                        <p class="text-sm text-black relative z-10">Owner</p>
                    </div>

                    <!-- Mentor -->
                    <div class="flex flex-col items-center">
                        <p class="text-base font-semibold text-black"><?php echo e($certificate->instructor ?? 'Mentor Name'); ?></p>
                        <div class="border-b border-black w-48 mb-1"></div>
                        <p class="text-sm text-black">Mentor</p>
                    </div>
                </div>

                <!-- Certificate Number -->
                <p class="mt-10 text-sm text-gray-500">Certificate No: <?php echo e($certificate->certificate_no); ?></p>






            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="text-center mt-12 text-lg text-gray-600">
            No certificates issued yet.
        </div>
    <?php endif; ?>


    <script type="module">
        import html2canvas from 'https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/+esm';
        import jsPDF from 'https://cdn.jsdelivr.net/npm/jspdf@2.5.1/+esm';

        document.getElementById('download-btn').addEventListener('click', async () => {
            const cert = document.querySelector('.max-w-4xl');
            const canvas = await html2canvas(cert, {
                scale: 2,
                useCORS: true,
                windowWidth: 1200
            });

            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save("certificate_<?php echo e($certificate->certificate_no); ?>.pdf");
        });
    </script>




<?php $__env->stopSection(); ?>
    
    
    
    
    <?php $__env->startPush('styles'); ?>
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

            @media print {
                @page {
                    size: A4 portrait;
                    margin: 10mm;
                }

                body,
                html {
                    padding: 0;
                    margin: 0;
                    height: auto;
                    background: white;
                }

                #action-buttons,
                .print\:hidden {
                    display: none !important;
                }

                .max-w-4xl {
                    width: 100% !important;
                    max-width: 100% !important;
                    margin: 0 auto !important;
                    padding: 20mm !important;
                    border: none !important;
                    box-shadow: none !important;
                    background: white !important;
                    page-break-after: always;
                }

                .page-break {
                    page-break-after: always;
                }

                img {
                    max-width: 100% !important;
                    height: auto !important;
                }

                h1,
                h2,
                h3,
                h4,
                h5,
                h6,
                p,
                div {
                    break-inside: avoid;
                }
            }
        </style>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\music\resources\views/admin/certificates/view.blade.php ENDPATH**/ ?>