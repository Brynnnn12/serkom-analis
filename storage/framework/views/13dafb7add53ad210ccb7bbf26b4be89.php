
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active' => '']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['active' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<aside class="sidebar-mobile fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none">
    <div class="p-6 flex items-center justify-between border-b border-slate-800">
        <div class="flex items-center space-x-3">
            <div class="bg-emerald-500 p-2 rounded-lg shadow-lg">
                <i class="fas fa-home text-xl text-white"></i>
            </div>
            <span class="text-xl font-bold tracking-tight">Pelanggan Area</span>
        </div>
        <button onclick="closeMobileMenu()" class="lg:hidden p-2 rounded-md hover:bg-slate-800 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <?php
            $menus = [
                ['id' => 'dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'route' => 'pelanggan.dashboard'],
                ['id' => 'tagihans', 'icon' => 'fa-file-invoice-dollar', 'label' => 'Tagihan Saya', 'route' => 'pelanggan.tagihans.index'],
                ['id' => 'pembayarans', 'icon' => 'fa-history', 'label' => 'Riwayat Bayar', 'route' => 'pelanggan.pembayarans.index'],
                ['id' => 'profil', 'icon' => 'fa-user-circle', 'label' => 'Profil Saya', 'route' => 'pelanggan.profil'],
            ];
        ?>

        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route($menu['route'])); ?>"
               class="flex items-center px-4 py-3.5 rounded-xl transition-all duration-300 group <?php echo e($active === $menu['id'] ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/40' : 'text-slate-400 hover:bg-slate-800 hover:text-emerald-400'); ?>">
                <div class="w-8 flex justify-center text-lg">
                    <i class="fas <?php echo e($menu['icon']); ?> transition-transform group-hover:rotate-12"></i>
                </div>
                <span class="ml-3 font-semibold"><?php echo e($menu['label']); ?></span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    <div class="m-4 p-4 bg-slate-800/50 rounded-2xl border border-slate-700">
        <p class="text-xs text-slate-400 mb-2">Butuh Bantuan?</p>
        <a href="#" class="text-xs text-emerald-400 hover:underline flex items-center">
            <i class="fas fa-headset mr-2"></i> Hubungi CS
        </a>
    </div>
</aside>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/sidebar-pelanggan.blade.php ENDPATH**/ ?>