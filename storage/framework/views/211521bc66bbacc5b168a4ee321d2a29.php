<?php if (isset($component)) { $__componentOriginal1a6cca1fb3b05e19b47840b98800a235 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dashboard','data' => ['title' => 'Kelola Tagihan - '.e($isAdmin ? 'Admin' : 'Pelanggan').'','guard' => ''.e($isAdmin ? 'web' : 'pelanggan').'','sidebarActive' => 'tagihans']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Tagihan - '.e($isAdmin ? 'Admin' : 'Pelanggan').'','guard' => ''.e($isAdmin ? 'web' : 'pelanggan').'','sidebarActive' => 'tagihans']); ?>
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Kelola Tagihan</h2>
        <p class="text-gray-600 mt-2"><?php echo e($isAdmin ? 'Pantau dan kelola tagihan pelanggan' : 'Lihat dan bayar tagihan listrik Anda'); ?></p>
    </div>

    <?php if(!$isAdmin): ?>
        <!-- Summary Cards untuk Pelanggan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['class' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow']); ?>
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-file-invoice-dollar text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Total Tagihan</h3>
                        <p class="text-2xl font-bold"><?php echo e($tagihans->count()); ?></p>
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

            <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['class' => 'bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow']); ?>
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-exclamation-triangle text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Belum Bayar</h3>
                        <p class="text-2xl font-bold"><?php echo e($tagihans->where('status', 'Belum Bayar')->count()); ?></p>
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

            <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['class' => 'bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow']); ?>
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-money-bill-wave text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Total Hutang</h3>
                        <p class="text-2xl font-bold">Rp <?php echo e(number_format($tagihans->where('status', 'Belum Bayar')->sum(function($tagihan) { return $tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0); }), 0, ',', '.')); ?></p>
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
        </div>
    <?php endif; ?>

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
        <div class="overflow-x-auto">
            <table class="w-full table-auto min-w-full border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <?php if($isAdmin): ?>
                            <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Pelanggan</th>
                        <?php endif; ?>
                        <th class="px-6 py-3 text-left border border-gray-300">Bulan/Tahun</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Jumlah Meter</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Total Tagihan</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Status</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $tagihans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b hover:bg-gray-50 <?php echo e($tagihan->status == 'Belum Bayar' ? 'bg-red-50' : 'bg-green-50'); ?>">
                            <?php if($isAdmin): ?>
                                <td class="px-6 py-4 border border-gray-300"><?php echo e($tagihan->pelanggan->nama_pelanggan ?? 'N/A'); ?></td>
                            <?php endif; ?>
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-medium"><?php echo e(date('F', mktime(0, 0, 0, $tagihan->bulan, 1))); ?></div>
                                <div class="text-sm text-gray-500"><?php echo e($tagihan->tahun); ?></div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-medium"><?php echo e(number_format($tagihan->jumlah_meter, 0, ',', '.')); ?> kWh</div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-semibold text-blue-600">Rp <?php echo e(number_format($tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.')); ?></div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <span class="px-3 py-1 rounded-full text-sm font-medium <?php echo e($tagihan->status == 'Belum Bayar' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'); ?>">
                                    <i class="fas <?php echo e($tagihan->status == 'Belum Bayar' ? 'fa-times-circle' : 'fa-check-circle'); ?> mr-1"></i>
                                    <?php echo e($tagihan->status); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e($isAdmin ? route('tagihans.show', $tagihan) : route('pelanggan.tagihans.show', $tagihan)).'','variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e($isAdmin ? route('tagihans.show', $tagihan) : route('pelanggan.tagihans.show', $tagihan)).'','variant' => 'primary']); ?>
                                    <i class="fas fa-eye mr-1"></i>Detail
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
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e($isAdmin ? 6 : 5); ?>" class="px-6 py-8 text-center text-gray-500 border border-gray-300">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <div>Belum ada data tagihan.</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
<?php /**PATH D:\Serkom-2\serkom\resources\views/tagihans/index.blade.php ENDPATH**/ ?>