
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

<nav class="bg-blue-600 p-8 mx-6 my-4 rounded-3xl shadow-2xl">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <!-- Mobile menu button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden text-white hover:text-blue-100 focus:outline-none p-2">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <h1 class="text-white text-xl lg:text-2xl font-bold">
                <i class="fas fa-bolt text-yellow-300 mr-3"></i>
                PLN Bayar Listrik
                <?php if($guard === 'web'): ?>
                    - Admin
                <?php elseif($guard === 'pelanggan'): ?>
                    - Pelanggan
                <?php endif; ?>
            </h1>
        </div>

        <div class="flex items-center space-x-6">
            <?php if($user): ?>
                <span class="text-white text-sm lg:text-base hidden sm:block font-medium">Halo, <?php echo e($user->nama_admin ?? $user->nama_pelanggan); ?></span>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 lg:py-3 lg:px-6 rounded-lg text-sm lg:text-base transition duration-200 shadow-md">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="text-white hover:text-blue-100 hover:underline text-sm lg:text-base transition duration-200 font-medium py-2 px-4 rounded-lg hover:bg-blue-700">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/navbar.blade.php ENDPATH**/ ?>