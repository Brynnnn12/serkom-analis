<?php if (isset($component)) { $__componentOriginal1a6cca1fb3b05e19b47840b98800a235 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dashboard','data' => ['title' => 'Input Penggunaan - Admin','guard' => 'web','sidebarActive' => 'penggunaans']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Input Penggunaan - Admin','guard' => 'web','sidebarActive' => 'penggunaans']); ?>
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Input Penggunaan Meteran Baru</h2>
        <p class="text-gray-600 mt-2">Catat penggunaan meteran bulanan pelanggan</p>
    </div>

    <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['class' => 'p-6 bg-white rounded-lg shadow-md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'p-6 bg-white rounded-lg shadow-md']); ?>
        <form action="<?php echo e(route('penggunaans.store')); ?>" method="POST" id="penggunaanForm">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="id_pelanggan" class="block text-gray-700 text-sm font-bold mb-2">Pelanggan</label>
                    <select id="id_pelanggan" name="id_pelanggan" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Pelanggan</option>
                        <?php $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pelanggan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pelanggan->id_pelanggan); ?>" <?php echo e(old('id_pelanggan') == $pelanggan->id_pelanggan ? 'selected' : ''); ?>>
                                <?php echo e($pelanggan->nama_pelanggan); ?> - <?php echo e($pelanggan->nomor_kwh); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['id_pelanggan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-4">
                    <label for="bulan" class="block text-gray-700 text-sm font-bold mb-2">Bulan</label>
                    <select id="bulan" name="bulan" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Bulan</option>
                        <?php for($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e(old('bulan') == $i ? 'selected' : ''); ?>>
                                <?php echo e(date('F', mktime(0, 0, 0, $i, 1))); ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                    <?php $__errorArgs = ['bulan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-4">
                    <label for="tahun" class="block text-gray-700 text-sm font-bold mb-2">Tahun</label>
                    <select id="tahun" name="tahun" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Tahun</option>
                        <?php for($i = date('Y'); $i <= date('Y') + 1; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e(old('tahun', date('Y')) == $i ? 'selected' : ''); ?>>
                                <?php echo e($i); ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                    <?php $__errorArgs = ['tahun'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-4">
                    <label for="meter_ahir" class="block text-gray-700 text-sm font-bold mb-2">Meter Akhir</label>
                    <input type="number" step="0.01" id="meter_ahir" name="meter_ahir" value="<?php echo e(old('meter_ahir')); ?>" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    <?php $__errorArgs = ['meter_ahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p class="text-sm text-gray-600 mt-1" id="meterInfo">Meter awal akan diambil otomatis dari bulan sebelumnya</p>
                </div>
            </div>

            <!-- Preview Section -->
            <div id="previewSection" class="mt-6 p-4 bg-gray-50 rounded-lg hidden">
                <h3 class="text-lg font-semibold mb-3">Pratinjau Perhitungan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="font-medium">Meter Awal:</span>
                        <span id="previewMeterAwal">-</span>
                    </div>
                    <div>
                        <span class="font-medium">Meter Akhir:</span>
                        <span id="previewMeterAkhir">-</span>
                    </div>
                    <div>
                        <span class="font-medium">Jumlah Meter:</span>
                        <span id="previewJumlahMeter">-</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>Simpan & Buat Tagihan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('penggunaans.index')).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('penggunaans.index')).'','variant' => 'secondary']); ?>Batal <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            </div>
        </form>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pelangganSelect = document.getElementById('id_pelanggan');
            const bulanSelect = document.getElementById('bulan');
            const tahunSelect = document.getElementById('tahun');
            const meterAkhirInput = document.getElementById('meter_ahir');
            const meterInfo = document.getElementById('meterInfo');
            const previewSection = document.getElementById('previewSection');
            const previewMeterAwal = document.getElementById('previewMeterAwal');
            const previewMeterAkhir = document.getElementById('previewMeterAkhir');
            const previewJumlahMeter = document.getElementById('previewJumlahMeter');

            function updatePreview() {
                const pelangganId = pelangganSelect.value;
                const bulan = bulanSelect.value;
                const tahun = tahunSelect.value;
                const meterAkhir = parseFloat(meterAkhirInput.value);

                if (pelangganId && bulan && tahun) {
                    // Get CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                                    document.querySelector('input[name="_token"]')?.value;

                    // Make AJAX call to get previous meter reading
                    fetch('<?php echo e(route("penggunaans.getPreviousMeter")); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            id_pelanggan: pelangganId,
                            bulan: bulan,
                            tahun: tahun
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const meterAwal = data.meter_awal;
                        const bulanSebelumnya = data.bulan_sebelumnya;

                        if (meterAwal > 0) {
                            meterInfo.textContent = `Meter awal dari ${bulanSebelumnya}: ${meterAwal}`;
                        } else {
                            meterInfo.textContent = 'Meter awal: 0 (penggunaan pertama)';
                        }

                        if (!isNaN(meterAkhir) && meterAkhir > meterAwal) {
                            const jumlahMeter = meterAkhir - meterAwal;
                            previewMeterAwal.textContent = meterAwal;
                            previewMeterAkhir.textContent = meterAkhir;
                            previewJumlahMeter.textContent = jumlahMeter.toFixed(2);
                            previewSection.classList.remove('hidden');
                        } else if (!isNaN(meterAkhir) && meterAkhir <= meterAwal) {
                            previewSection.classList.add('hidden');
                            if (meterAkhir <= meterAwal) {
                                meterInfo.textContent += ' - Meter akhir harus lebih besar dari meter awal!';
                                meterInfo.style.color = 'red';
                            }
                        } else {
                            previewSection.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        meterInfo.textContent = 'Error memuat data meter awal';
                        previewSection.classList.add('hidden');
                    });
                } else {
                    meterInfo.textContent = 'Meter awal akan diambil otomatis dari bulan sebelumnya';
                    meterInfo.style.color = '';
                    previewSection.classList.add('hidden');
                }
            }

            pelangganSelect.addEventListener('change', updatePreview);
            bulanSelect.addEventListener('change', updatePreview);
            tahunSelect.addEventListener('change', updatePreview);
            meterAkhirInput.addEventListener('input', updatePreview);
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a6cca1fb3b05e19b47840b98800a235)): ?>
<?php $attributes = $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235; ?>
<?php unset($__attributesOriginal1a6cca1fb3b05e19b47840b98800a235); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a6cca1fb3b05e19b47840b98800a235)): ?>
<?php $component = $__componentOriginal1a6cca1fb3b05e19b47840b98800a235; ?>
<?php unset($__componentOriginal1a6cca1fb3b05e19b47840b98800a235); ?>
<?php endif; ?>
<?php /**PATH D:\Serkom-2\serkom\resources\views/penggunaans/create.blade.php ENDPATH**/ ?>