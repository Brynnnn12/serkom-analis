<?php if (isset($component)) { $__componentOriginal1a6cca1fb3b05e19b47840b98800a235 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dashboard','data' => ['title' => 'Profil Pelanggan - PLN Bayar Listrik','guard' => 'pelanggan','sidebarActive' => 'profil']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profil Pelanggan - PLN Bayar Listrik','guard' => 'pelanggan','sidebarActive' => 'profil']); ?>
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Profil Saya</h2>
        <p class="text-gray-600 mt-2">Informasi akun dan data pribadi Anda</p>
    </div>

    <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Informasi Pribadi','class' => 'p-6 bg-white rounded-lg shadow-md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Informasi Pribadi','class' => 'p-6 bg-white rounded-lg shadow-md']); ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="p-4 bg-gray-50 rounded-lg">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                <p class="text-lg text-gray-900"><?php echo e(Auth::guard('pelanggan')->user()->nama_pelanggan); ?></p>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor KWH</label>
                <p class="text-lg text-gray-900"><?php echo e(Auth::guard('pelanggan')->user()->nomor_kwh); ?></p>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                <p class="text-lg text-gray-900"><?php echo e(Auth::guard('pelanggan')->user()->alamat); ?></p>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tarif</label>
                <p class="text-lg text-gray-900"><?php echo e(Auth::guard('pelanggan')->user()->tarif->daya ?? 'N/A'); ?> VA - Rp <?php echo e(number_format(Auth::guard('pelanggan')->user()->tarif->tarifperkwh ?? 0)); ?>/kWh</p>
            </div>
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
<?php /**PATH D:\Serkom-2\serkom\resources\views/pelanggan/profil.blade.php ENDPATH**/ ?>