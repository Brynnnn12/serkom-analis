
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['user' => null, 'guard' => null]));

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

foreach (array_filter((['user' => null, 'guard' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<nav class="bg-cyan-400 p-6 mx-4 my-2 rounded-xl shadow-xl">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <!-- Mobile menu button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden text-white hover:text-gray-200 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <h1 class="text-white text-lg lg:text-xl font-bold">
                PLN Bayar Listrik
                <?php if($guard === 'web'): ?>
                    - Admin
                <?php elseif($guard === 'pelanggan'): ?>
                    - Pelanggan
                <?php endif; ?>
            </h1>
        </div>

        <div class="flex items-center space-x-4">
            <?php if($user): ?>
                <span class="text-white text-sm lg:text-base hidden sm:block">Halo, <?php echo e($user->nama_admin ?? $user->nama_pelanggan); ?></span>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 lg:py-2 lg:px-4 rounded text-sm lg:text-base">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="text-white hover:underline text-sm lg:text-base">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/navbar.blade.php ENDPATH**/ ?>