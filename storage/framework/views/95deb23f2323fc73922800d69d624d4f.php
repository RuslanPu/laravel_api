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
            <?php echo e(__('Services API')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>List Services API</h1>

                    <div>
                        <h4>Followers</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->category == 3): ?>

                                <tr>
                                    <td><?php echo e(isset($service->service) && $service->service != null ? $service->service : '-'); ?></td>
                                    <td><?php echo e($service->name ?? '-'); ?></td>
                                    <td><?php echo e($service->type ?? '-'); ?></td>
                                    <td><?php echo e(isset($service->refill) && $service->refill != null ? $service->refill : '-'); ?></td>
                                    <td><?php echo e($service->rate ?? '-'); ?></td>
                                    <td><?php echo e($service->min ?? '-'); ?></td>
                                    <td><?php echo e($service->max ?? '-'); ?></td>
                                    <td><?php echo e($service->drops ?? '-'); ?></td>
                                    <td><?php echo e($service->speed_per_hour ?? '-'); ?></td>
                                    <td><?php echo e($service->max_done_count_day ?? '-'); ?></td>
                                    <td><?php echo e($service->limit ?? '-'); ?></td>
                                    <td><?php echo e($service->queue_time_minutes ?? '-'); ?></td>
                                    <td><?php echo e($service->cancel ?? '-'); ?></td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </tbody>

                        </table>

                        <h4>Likes</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->category == 4): ?>

                                    <tr>
                                        <td><?php echo e($service->service ?? '-'); ?></td>
                                        <td><?php echo e($service->name ?? '-'); ?></td>
                                        <td><?php echo e($service->type ?? '-'); ?></td>
                                        <td><?php echo e(isset($service->refill) && $service->refill != null ? $service->refill : '-'); ?></td>
                                        <td><?php echo e($service->rate ?? '-'); ?></td>
                                        <td><?php echo e($service->min ?? '-'); ?></td>
                                        <td><?php echo e($service->max ?? '-'); ?></td>
                                        <td><?php echo e($service->drops ?? '-'); ?></td>
                                        <td><?php echo e($service->speed_per_hour ?? '-'); ?></td>
                                        <td><?php echo e($service->max_done_count_day ?? '-'); ?></td>
                                        <td><?php echo e($service->limit ?? '-'); ?></td>
                                        <td><?php echo e($service->queue_time_minutes ?? '-'); ?></td>
                                        <td><?php echo e($service->cancel ?? '-'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

                        <h4>Comments</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->category == 6): ?>

                                    <tr>
                                        <td><?php echo e($service->service ?? '-'); ?></td>
                                        <td><?php echo e($service->name ?? '-'); ?></td>
                                        <td><?php echo e($service->type ?? '-'); ?></td>
                                        <td><?php echo e(isset($service->refill) && $service->refill != null ? $service->refill : '-'); ?></td>
                                        <td><?php echo e($service->rate ?? '-'); ?></td>
                                        <td><?php echo e($service->min ?? '-'); ?></td>
                                        <td><?php echo e($service->max ?? '-'); ?></td>
                                        <td><?php echo e($service->drops ?? '-'); ?></td>
                                        <td><?php echo e($service->speed_per_hour ?? '-'); ?></td>
                                        <td><?php echo e($service->max_done_count_day ?? '-'); ?></td>
                                        <td><?php echo e($service->limit ?? '-'); ?></td>
                                        <td><?php echo e($service->queue_time_minutes ?? '-'); ?></td>
                                        <td><?php echo e($service->cancel ?? '-'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

                        <h4>Views</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->category == 5): ?>

                                    <tr>
                                        <td><?php echo e($service->service ?? '-'); ?></td>
                                        <td><?php echo e($service->name ?? '-'); ?></td>
                                        <td><?php echo e($service->type ?? '-'); ?></td>
                                        <td><?php echo e(isset($service->refill) && $service->refill != null ? $service->refill : '-'); ?></td>
                                        <td><?php echo e($service->rate ?? '-'); ?></td>
                                        <td><?php echo e($service->min ?? '-'); ?></td>
                                        <td><?php echo e($service->max ?? '-'); ?></td>
                                        <td><?php echo e($service->drops ?? '-'); ?></td>
                                        <td><?php echo e($service->speed_per_hour ?? '-'); ?></td>
                                        <td><?php echo e($service->max_done_count_day ?? '-'); ?></td>
                                        <td><?php echo e($service->limit ?? '-'); ?></td>
                                        <td><?php echo e($service->queue_time_minutes ?? '-'); ?></td>
                                        <td><?php echo e($service->cancel ?? '-'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

                        <h4>Statistics</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">type</th>
                                <th scope="col">refill</th>
                                <th scope="col">rate</th>
                                <th scope="col">min</th>
                                <th scope="col">max</th>
                                <th scope="col">drops</th>
                                <th scope="col">speed per hour</th>
                                <th scope="col">max done count day</th>
                                <th scope="col">limit</th>
                                <th scope="col">queue time minutes</th>
                                <th scope="col">cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->category == 7): ?>

                                    <tr>
                                        <td><?php echo e($service->service ?? '-'); ?></td>
                                        <td><?php echo e($service->name ?? '-'); ?></td>
                                        <td><?php echo e($service->type ?? '-'); ?></td>
                                        <td><?php echo e(isset($service->refill) && $service->refill != null ? $service->refill : '-'); ?></td>
                                        <td><?php echo e($service->rate ?? '-'); ?></td>
                                        <td><?php echo e($service->min ?? '-'); ?></td>
                                        <td><?php echo e($service->max ?? '-'); ?></td>
                                        <td><?php echo e($service->drops ?? '-'); ?></td>
                                        <td><?php echo e($service->speed_per_hour ?? '-'); ?></td>
                                        <td><?php echo e($service->max_done_count_day ?? '-'); ?></td>
                                        <td><?php echo e($service->limit ?? '-'); ?></td>
                                        <td><?php echo e($service->queue_time_minutes ?? '-'); ?></td>
                                        <td><?php echo e($service->cancel ?? '-'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

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
<?php /**PATH /home/drop/web/BusinessProjects/laravel_api/resources/views/admin/services.blade.php ENDPATH**/ ?>