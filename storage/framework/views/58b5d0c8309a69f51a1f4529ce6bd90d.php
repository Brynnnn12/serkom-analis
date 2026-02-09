
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['href' => null, 'type' => 'button', 'class' => 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']));

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

foreach (array_filter((['href' => null, 'type' => 'button', 'class' => 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" class="<?php echo e($class); ?>"><?php echo e($slot); ?></a>
<?php else: ?>
    <button type="<?php echo e($type); ?>" class="<?php echo e($class); ?>"><?php echo e($slot); ?></button>
<?php endif; ?>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/button.blade.php ENDPATH**/ ?>