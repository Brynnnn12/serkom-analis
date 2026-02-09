
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

<aside class="sidebar-mobile fixed inset-y-0 left-0 z-50 w-72 bg-blue-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none border-r border-blue-800/50">
    <div class="p-6 flex items-center justify-between border-b border-blue-800/50">
        <div class="flex items-center space-x-3">
            <div class="bg-blue-600 p-2 rounded-lg shadow-inner">
                <i class="fas fa-user-shield text-xl text-white"></i>
            </div>
            <span class="text-xl font-bold tracking-wider uppercase">Portal Admin</span>
        </div>
        <button onclick="closeMobileMenu()" class="lg:hidden p-2 rounded-md hover:bg-blue-800 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
        <?php
            $menus = [
                ['id' => 'dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'route' => 'admin.dashboard'],
                ['id' => 'tarifs', 'icon' => 'fa-dollar-sign', 'label' => 'Kelola Tarif', 'route' => 'tarifs.index'],
                ['id' => 'users', 'icon' => 'fa-users-cog', 'label' => 'Kelola Admin', 'route' => 'users.index'],
                ['id' => 'pelanggans', 'icon' => 'fa-user-friends', 'label' => 'Kelola Pelanggan', 'route' => 'pelanggans.index'],
                ['id' => 'penggunaans', 'icon' => 'fa-bolt', 'label' => 'Input Penggunaan', 'route' => 'penggunaans.index'],
                ['id' => 'tagihans', 'icon' => 'fa-file-invoice-dollar', 'label' => 'Lihat Tagihan', 'route' => 'tagihans.index'],
                ['id' => 'pembayarans', 'icon' => 'fa-credit-card', 'label' => 'Proses Pembayaran', 'route' => 'pembayarans.index'],
            ];
        ?>

        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route($menu['route'])); ?>"
               class="flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 group <?php echo e($active === $menu['id'] ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-blue-800/50 hover:text-white'); ?>">
                <div class="w-8 flex justify-center">
                    <i class="fas <?php echo e($menu['icon']); ?> text-lg transition-transform group-hover:scale-110"></i>
                </div>
                <span class="ml-3 font-medium"><?php echo e($menu['label']); ?></span>
                <?php if($active === $menu['id']): ?>
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-[0_0_8px_white]"></span>
                <?php endif; ?>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    <div class="p-4 border-t border-blue-800/50 bg-blue-950/30 text-xs text-blue-400 text-center uppercase tracking-widest font-semibold">
        PLN Bayar Listrik v2.0
    </div>
</aside>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/sidebar-admin.blade.php ENDPATH**/ ?>