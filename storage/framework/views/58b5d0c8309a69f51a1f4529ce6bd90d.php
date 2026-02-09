
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['href' => null, 'type' => 'button', 'variant' => 'primary', 'class' => '']));

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

foreach (array_filter((['href' => null, 'type' => 'button', 'variant' => 'primary', 'class' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $baseClasses = 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2';

    $variantClasses = match($variant) {
        'primary' => 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-gray-500',
        'success' => 'bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:ring-green-500',
        'warning' => 'bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:ring-yellow-500',
        'danger' => 'bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:ring-red-500',
        default => 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500'
    };

    $allClasses = $baseClasses . ' ' . $variantClasses . ' ' . $class;
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" class="<?php echo e($allClasses); ?>"><?php echo e($slot); ?></a>
<?php else: ?>
    <button type="<?php echo e($type); ?>" class="<?php echo e($allClasses); ?>"><?php echo e($slot); ?></button>
<?php endif; ?>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/button.blade.php ENDPATH**/ ?>