<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Packages List</h1>
                </div>
            </div>

            <br>
            <?php
                $can = Auth()->user()->type === 2;
            ?>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <?php if($can): ?>
                            <a href="<?php echo e(url('admin/packages/create')); ?>">
                                <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Create')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                            </a>
                        <?php endif; ?>
                        <div>
                            <div class="container-sm mt-5">
                                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                ID:
                                                <span class="badge text-bg-success"><?php echo e($package->id); ?></span>
                                            </h5>

                                            <p class="card-text">
                                                Name:
                                                <span class="badge text-bg-success"><?php echo e($package->name); ?> </span>

                                            </p>
                                            <p class="card-text">
                                                Description:
                                            <div class="alert alert-dark"><?php echo e($package->description); ?></div>
                                            </p>

                                            <br>

                                            <h6>Managers</h6>
                                            <div class="m-3 flex-grow-1">
                                                <?php $__currentLoopData = $package->managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="mb-lg-1 badge rounded-pill text-bg-primary"><?php echo e($manager->name); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                            <br>

                                            <h6>Services</h6>
                                            <div class="m-3 flex-grow-1">
                                                <?php $__currentLoopData = $package->packageApiServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packageApiService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="mb-2 badge bg-gray-100 dark:bg-gray-900 text-start p-2 w-100 text-wrap">
                                                        <p class="mb-1"><strong>Name:</strong> <?php echo e($packageApiService->service->name); ?></p>
                                                        <p class="mb-1"><strong>Type:</strong> <?php echo e($packageApiService->service->type); ?></p>
                                                        <?php if($quantity = $packageApiService->quantity): ?>
                                                            <p class="mb-1"><strong>Quantity:</strong> <?php echo e($quantity); ?></p>
                                                        <?php endif; ?>
                                                        <?php if($comments = $packageApiService->comments): ?>
                                                            <p class="mb-1"><strong>Comments:</strong> <?php echo e($comments); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                            <?php if($can): ?>
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-primary m-1" href="<?php echo e(url('admin/packages/edit/'.$package->id)); ?>">Edit</a>

                                                    <form action="<?php echo e(url('admin/packages/delete/'.$package->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this package?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="m-1 btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /home/drop/web/BusinessProjects/laravel_api/resources/views/admin/packages/index.blade.php ENDPATH**/ ?>