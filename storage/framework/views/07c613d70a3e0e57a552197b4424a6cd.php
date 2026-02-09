
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'guard' => 'web', 'sidebarActive' => '']));

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

foreach (array_filter((['title', 'guard' => 'web', 'sidebarActive' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'Dashboard - PLN Bayar Listrik'); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans antialiased text-gray-900">

    <div id="mobile-menu-overlay"
         class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300 opacity-0"
         onclick="closeMobileMenu()"></div>

    <div class="flex min-h-screen">
        
        <aside class="z-50">
            <?php if($guard === 'web'): ?>
                <?php if (isset($component)) { $__componentOriginal257baafdfbcbd9e6d63f040030148322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal257baafdfbcbd9e6d63f040030148322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-admin','data' => ['active' => $sidebarActive]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sidebarActive)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal257baafdfbcbd9e6d63f040030148322)): ?>
<?php $attributes = $__attributesOriginal257baafdfbcbd9e6d63f040030148322; ?>
<?php unset($__attributesOriginal257baafdfbcbd9e6d63f040030148322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal257baafdfbcbd9e6d63f040030148322)): ?>
<?php $component = $__componentOriginal257baafdfbcbd9e6d63f040030148322; ?>
<?php unset($__componentOriginal257baafdfbcbd9e6d63f040030148322); ?>
<?php endif; ?>
            <?php elseif($guard === 'pelanggan'): ?>
                <?php if (isset($component)) { $__componentOriginalfff14c7a5031171705bb5c712eab0552 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfff14c7a5031171705bb5c712eab0552 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-pelanggan','data' => ['active' => $sidebarActive]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-pelanggan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sidebarActive)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfff14c7a5031171705bb5c712eab0552)): ?>
<?php $attributes = $__attributesOriginalfff14c7a5031171705bb5c712eab0552; ?>
<?php unset($__attributesOriginalfff14c7a5031171705bb5c712eab0552); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfff14c7a5031171705bb5c712eab0552)): ?>
<?php $component = $__componentOriginalfff14c7a5031171705bb5c712eab0552; ?>
<?php unset($__componentOriginalfff14c7a5031171705bb5c712eab0552); ?>
<?php endif; ?>
            <?php endif; ?>
        </aside>

        
        <div class="flex-1 flex flex-col min-w-0 lg:pl-72 transition-all duration-300">

            
            <header class="sticky top-0 z-30">
                <?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => ['user' => auth()->user(),'guard' => $guard]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(auth()->user()),'guard' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($guard)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $attributes = $__attributesOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__attributesOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $component = $__componentOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__componentOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>
            </header>

            
            <main class="flex-1 px-4 lg:px-6 pb-12">
                <div class="container mx-auto">
                    <?php echo e($slot); ?>

                </div>
            </main>

            
            <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
        </div>
    </div>

    <script>
        /**
         * Logic untuk Mobile Menu
         * Pastikan di Sidebar Component Anda memiliki class 'sidebar-mobile'
         */
        const getElements = () => ({
            sidebar: document.querySelector('.sidebar-mobile'),
            overlay: document.getElementById('mobile-menu-overlay')
        });

        function toggleMobileMenu() {
            const { sidebar, overlay } = getElements();

            if (sidebar && overlay) {
                const isOpen = sidebar.classList.contains('translate-x-0');

                if (isOpen) {
                    closeMobileMenu();
                } else {
                    sidebar.classList.replace('-translate-x-full', 'translate-x-0');
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.add('opacity-100'), 10);
                    document.body.classList.add('overflow-hidden');
                }
            }
        }

        function closeMobileMenu() {
            const { sidebar, overlay } = getElements();

            if (sidebar && overlay) {
                sidebar.classList.replace('translate-x-0', '-translate-x-full');
                overlay.classList.remove('opacity-100');
                document.body.classList.remove('overflow-hidden');

                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300); // Sesuai durasi transisi
            }
        }

        // Handle link clicks inside mobile sidebar
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.sidebar-mobile a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
        });
    </script>
</body>
</html>
<?php /**PATH D:\Serkom-2\serkom\resources\views/components/layouts/dashboard.blade.php ENDPATH**/ ?>