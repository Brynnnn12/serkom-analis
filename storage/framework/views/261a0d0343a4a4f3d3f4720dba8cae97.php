<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'PLN Bayar Listrik'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>

    <main class="container mx-auto">
        <?php echo e($slot); ?>

    </main>

</body>
</html>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>