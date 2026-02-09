<?php if (isset($component)) { $__componentOriginal1a6cca1fb3b05e19b47840b98800a235 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dashboard','data' => ['title' => 'Detail Pembayaran - '.e(auth()->guard('web')->check() ? 'Admin' : 'Pelanggan').'','guard' => ''.e(auth()->guard('web')->check() ? 'web' : 'pelanggan').'','sidebarActive' => 'pembayarans']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Pembayaran - '.e(auth()->guard('web')->check() ? 'Admin' : 'Pelanggan').'','guard' => ''.e(auth()->guard('web')->check() ? 'web' : 'pelanggan').'','sidebarActive' => 'pembayarans']); ?>
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Detail Pembayaran</h2>
        <p class="text-gray-600 mt-2">Informasi lengkap transaksi pembayaran</p>
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
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Informasi Pembayaran</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">ID Pembayaran:</span>
                        <span><?php echo e($pembayaran->id_pembayaran); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Tanggal Bayar:</span>
                        <span><?php echo e(\Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y H:i:s')); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Periode:</span>
                        <span><?php echo e(date('F', mktime(0, 0, 0, $pembayaran->bulan_bayar, 1))); ?> <?php echo e($pembayaran->tahun_bayar); ?></span>
                    </div>
                    <?php if(auth()->guard('web')->check()): ?>
                        <div class="flex justify-between">
                            <span class="font-medium">Petugas:</span>
                            <span><?php echo e($pembayaran->user->nama_admin ?? 'N/A'); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Detail Transaksi</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">Pelanggan:</span>
                        <span><?php echo e($pembayaran->tagihan->pelanggan->nama_pelanggan); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Nomor KWH:</span>
                        <span><?php echo e($pembayaran->tagihan->pelanggan->nomor_kwh); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Jumlah Meter:</span>
                        <span><?php echo e(number_format($pembayaran->tagihan->jumlah_meter, 0, ',', '.')); ?> kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Tarif per kWh:</span>
                        <span>Rp <?php echo e(number_format($pembayaran->tagihan->pelanggan->tarif->tarifperkwh ?? 0, 0, ',', '.')); ?></span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between">
                        <span class="font-medium">Total Tagihan:</span>
                        <span class="font-semibold">Rp <?php echo e(number_format($pembayaran->tagihan->jumlah_meter * ($pembayaran->tagihan->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.')); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Biaya Admin:</span>
                        <span>Rp <?php echo e(number_format($pembayaran->biaya_admin, 0, ',', '.')); ?></span>
                    </div>
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total Bayar:</span>
                        <span class="text-green-600">Rp <?php echo e(number_format($pembayaran->total_bayar, 0, ',', '.')); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Uang Dibayar:</span>
                        <span>Rp <?php echo e(number_format($pembayaran->uang_dibayar, 0, ',', '.')); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Kembalian:</span>
                        <span>Rp <?php echo e(number_format($pembayaran->kembalian, 0, ',', '.')); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-4 text-green-600">Detail Penggunaan</h3>
            <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex justify-between">
                        <span class="font-medium">Meter Awal:</span>
                        <span><?php echo e(number_format($pembayaran->tagihan->penggunaan->meter_awal ?? 0, 0, ',', '.')); ?> kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Meter Akhir:</span>
                        <span><?php echo e(number_format($pembayaran->tagihan->penggunaan->meter_ahir ?? 0, 0, ',', '.')); ?> kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Periode Penggunaan:</span>
                        <span><?php echo e(date('F', mktime(0, 0, 0, $pembayaran->tagihan->penggunaan->bulan ?? 1, 1))); ?> <?php echo e($pembayaran->tagihan->penggunaan->tahun ?? 'N/A'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('pembayarans.index')).'','class' => 'bg-gray-600 hover:bg-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('pembayarans.index')).'','class' => 'bg-gray-600 hover:bg-gray-700']); ?>Kembali ke Riwayat Pembayaran <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            <?php if(auth()->guard('web')->check()): ?>
                <div class="flex gap-2">
                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['onclick' => 'window.print()','class' => 'bg-blue-600 hover:bg-blue-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['onclick' => 'window.print()','class' => 'bg-blue-600 hover:bg-blue-700']); ?>
                        <i class="fas fa-print mr-1"></i>Cetak Struk
                     <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('pembayarans.create')).'','class' => 'bg-green-600 hover:bg-green-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('pembayarans.create')).'','class' => 'bg-green-600 hover:bg-green-700']); ?>
                        <i class="fas fa-plus mr-1"></i>Pembayaran Baru
                     <?php echo $__env->renderComponent(); ?>
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
            <?php endif; ?>
        </div>
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

    <!-- Print Styles -->
    <style media="print">
        @page {
            size: 80mm auto;
            margin: 0;
        }
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.2;
            margin: 0;
            padding: 10px;
        }
        .no-print {
            display: none !important;
        }
        .print-receipt {
            max-width: 80mm;
            margin: 0 auto;
        }
        .receipt-header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .receipt-body {
            margin-bottom: 10px;
        }
        .receipt-footer {
            border-top: 1px dashed #000;
            padding-top: 10px;
            text-align: center;
        }
        .receipt-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .receipt-total {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 5px 0;
            font-weight: bold;
        }
    </style>

    <!-- Print Receipt Template -->
    <div class="no-print hidden">
        <div id="print-receipt" class="print-receipt">
            <div class="receipt-header">
                <h2>STRUK PEMBAYARAN</h2>
                <p>PLN LISTRIK</p>
                <p><?php echo e(\Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y H:i:s')); ?></p>
            </div>

            <div class="receipt-body">
                <div class="receipt-line">
                    <span>ID Pembayaran:</span>
                    <span><?php echo e($pembayaran->id_pembayaran); ?></span>
                </div>
                <div class="receipt-line">
                    <span>Pelanggan:</span>
                    <span><?php echo e($pembayaran->tagihan->pelanggan->nama_pelanggan); ?></span>
                </div>
                <div class="receipt-line">
                    <span>ID Pelanggan:</span>
                    <span><?php echo e($pembayaran->tagihan->pelanggan->id_pelanggan); ?></span>
                </div>
                <div class="receipt-line">
                    <span>Nomor KWH:</span>
                    <span><?php echo e($pembayaran->tagihan->pelanggan->nomor_kwh); ?></span>
                </div>
                <div class="receipt-line">
                    <span>Periode:</span>
                    <span><?php echo e(date('M', mktime(0, 0, 0, $pembayaran->bulan_bayar, 1))); ?>/<?php echo e($pembayaran->tahun_bayar); ?></span>
                </div>
                <div class="receipt-line">
                    <span>Jumlah Meter:</span>
                    <span><?php echo e(number_format($pembayaran->tagihan->jumlah_meter, 0, ',', '.')); ?> kWh</span>
                </div>
                <div class="receipt-line">
                    <span>Tarif/kWh:</span>
                    <span>Rp <?php echo e(number_format($pembayaran->tagihan->pelanggan->tarif->tarifperkwh ?? 0, 0, ',', '.')); ?></span>
                </div>
                <div class="receipt-line">
                    <span>Total Tagihan:</span>
                    <span>Rp <?php echo e(number_format($pembayaran->tagihan->jumlah_meter * ($pembayaran->tagihan->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.')); ?></span>
                </div>
                <div class="receipt-line">
                    <span>Biaya Admin:</span>
                    <span>Rp <?php echo e(number_format($pembayaran->biaya_admin, 0, ',', '.')); ?></span>
                </div>
                <div class="receipt-line receipt-total">
                    <span>TOTAL BAYAR:</span>
                    <span>Rp <?php echo e(number_format($pembayaran->total_bayar, 0, ',', '.')); ?></span>
                </div>
                <div class="receipt-line">
                    <span>Uang Dibayar:</span>
                    <span>Rp <?php echo e(number_format($pembayaran->uang_dibayar, 0, ',', '.')); ?></span>
                </div>
                <div class="receipt-line">
                    <span>Kembalian:</span>
                    <span>Rp <?php echo e(number_format($pembayaran->kembalian, 0, ',', '.')); ?></span>
                </div>
            </div>

            <div class="receipt-footer">
                <p>Terima Kasih</p>
                <p>Telah Membayar Tagihan Listrik</p>
                <?php if(auth()->guard('web')->check()): ?>
                    <p>Petugas: <?php echo e($pembayaran->user->nama_admin ?? 'N/A'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function printReceipt() {
            const printContent = document.getElementById('print-receipt').innerHTML;
            const originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;

            // Reload to restore event listeners
            window.location.reload();
        }

        // Override the default print function
        window.print = function() {
            printReceipt();
        };
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
<?php /**PATH D:\Serkom-2\serkom\resources\views/pembayarans/show.blade.php ENDPATH**/ ?>