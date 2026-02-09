<?php if (isset($component)) { $__componentOriginal1a6cca1fb3b05e19b47840b98800a235 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dashboard','data' => ['title' => 'Detail Tagihan - '.e(auth()->guard('web')->check() ? 'Admin' : 'Pelanggan').'','guard' => ''.e(auth()->guard('web')->check() ? 'web' : 'pelanggan').'','sidebarActive' => 'tagihans']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Tagihan - '.e(auth()->guard('web')->check() ? 'Admin' : 'Pelanggan').'','guard' => ''.e(auth()->guard('web')->check() ? 'web' : 'pelanggan').'','sidebarActive' => 'tagihans']); ?>
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Detail Tagihan</h2>
        <p class="text-gray-600 mt-2">Informasi lengkap tagihan listrik</p>
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
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Informasi Tagihan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">ID Tagihan:</span>
                        <span><?php echo e($tagihan->id_tagihan); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Pelanggan:</span>
                        <span><?php echo e($tagihan->pelanggan->nama_pelanggan); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Nomor KWH:</span>
                        <span><?php echo e($tagihan->pelanggan->nomor_kwh); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Alamat:</span>
                        <span><?php echo e($tagihan->pelanggan->alamat); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Periode:</span>
                        <span><?php echo e(date('F', mktime(0, 0, 0, $tagihan->bulan, 1))); ?> <?php echo e($tagihan->tahun); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Status:</span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium <?php echo e($tagihan->status == 'Belum Bayar' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'); ?>">
                            <?php echo e($tagihan->status); ?>

                        </span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Detail Penggunaan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">Meter Awal:</span>
                        <span><?php echo e(number_format($tagihan->penggunaan->meter_awal ?? 0, 0, ',', '.')); ?> kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Meter Akhir:</span>
                        <span><?php echo e(number_format($tagihan->penggunaan->meter_ahir ?? 0, 0, ',', '.')); ?> kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Jumlah Pemakaian:</span>
                        <span class="font-semibold"><?php echo e(number_format($tagihan->jumlah_meter, 0, ',', '.')); ?> kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Tarif per kWh:</span>
                        <span>Rp <?php echo e(number_format($tagihan->pelanggan->tarif->tarifperkwh ?? 0, 0, ',', '.')); ?></span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total Tagihan:</span>
                        <span class="text-blue-600">Rp <?php echo e(number_format($tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.')); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <?php if($tagihan->pembayaran): ?>
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-4 text-green-600">Riwayat Pembayaran</h3>
                <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex justify-between">
                            <span class="font-medium">Tanggal Bayar:</span>
                            <span><?php echo e(\Carbon\Carbon::parse($tagihan->pembayaran->tanggal_pembayaran)->format('d/m/Y')); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Biaya Admin:</span>
                            <span>Rp <?php echo e(number_format($tagihan->pembayaran->biaya_admin ?? 0, 0, ',', '.')); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Total Bayar:</span>
                            <span class="font-semibold">Rp <?php echo e(number_format($tagihan->pembayaran->total_bayar ?? 0, 0, ',', '.')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-6 flex justify-between">
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('tagihans.index')).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('tagihans.index')).'','variant' => 'secondary']); ?>Kembali ke Daftar Tagihan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
            <?php if(auth()->guard('web')->check() && $tagihan->status == 'Belum Bayar'): ?>
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('pembayarans.create', ['tagihan_id' => $tagihan->id_tagihan])).'','variant' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('pembayarans.create', ['tagihan_id' => $tagihan->id_tagihan])).'','variant' => 'success']); ?>Proses Pembayaran <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
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
<?php /**PATH D:\Serkom-2\serkom\resources\views/tagihans/show.blade.php ENDPATH**/ ?>