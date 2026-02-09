
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

<div class="sidebar-mobile bg-blue-800 text-white w-64 min-h-screen p-4 fixed lg:static inset-y-0 left-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:flex lg:flex-col">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-center flex-1">Menu Admin</h2>
        <button onclick="closeMobileMenu()" class="lg:hidden text-white hover:text-gray-200">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    <nav class="space-y-2 flex-1">
        <a href="<?php echo e(route('admin.dashboard')); ?>"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 <?php echo e($active === 'dashboard' ? 'bg-blue-600' : 'hover:bg-blue-700'); ?>">
            <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
        </a>
        <a href="<?php echo e(route('tarifs.index')); ?>"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 <?php echo e($active === 'tarifs' ? 'bg-blue-600' : 'hover:bg-blue-700'); ?>">
            <i class="fas fa-dollar-sign mr-3"></i>Kelola Tarif
        </a>
        <a href="<?php echo e(route('users.index')); ?>"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 <?php echo e($active === 'users' ? 'bg-blue-600' : 'hover:bg-blue-700'); ?>">
            <i class="fas fa-users mr-3"></i>Kelola Admin
        </a>
        <a href="<?php echo e(route('pelanggans.index')); ?>"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 <?php echo e($active === 'pelanggans' ? 'bg-blue-600' : 'hover:bg-blue-700'); ?>">
            <i class="fas fa-user-friends mr-3"></i>Kelola Pelanggan
        </a>
        <a href="<?php echo e(route('penggunaans.index')); ?>"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 <?php echo e($active === 'penggunaans' ? 'bg-blue-600' : 'hover:bg-blue-700'); ?>">
            <i class="fas fa-chart-line mr-3"></i>Input Penggunaan
        </a>
        <a href="<?php echo e(route('tagihans.index')); ?>"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 <?php echo e($active === 'tagihans' ? 'bg-blue-600' : 'hover:bg-blue-700'); ?>">
            <i class="fas fa-file-invoice-dollar mr-3"></i>Lihat Tagihan
        </a>
        <a href="<?php echo e(route('pembayarans.index')); ?>"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 <?php echo e($active === 'pembayarans' ? 'bg-blue-600' : 'hover:bg-blue-700'); ?>">
            <i class="fas fa-credit-card mr-3"></i>Proses Pembayaran
        </a>
    </nav>
</div>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/sidebar-admin.blade.php ENDPATH**/ ?>