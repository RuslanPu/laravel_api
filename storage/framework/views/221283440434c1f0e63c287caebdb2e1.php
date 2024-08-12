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
                    <?php echo e(__("You're logged in!")); ?>

                    <h1 class="text-2xl font-bold mt-2">This is Admin dashboard!</h1>
                </div>
            </div>

            <br>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-2xl font-bold">List Users</h1>
                            <a href="<?php echo e(url('admin/users/create')); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <?php echo e(__('Create')); ?>

                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-900 text-gray-100 rounded-lg shadow-lg">
                                <thead class="bg-gray-700">
                                <tr>
                                    <th scope="col" class="py-3 px-6">ID</th>
                                    <th scope="col" class="py-3 px-6">Name</th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6">Type</th>
                                    <th scope="col" class="py-3 px-6">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-gray-800 border-b border-gray-700">
                                        <td class="py-3 px-6"><?php echo e($user->id); ?></td>
                                        <td class="py-3 px-6"><?php echo e($user->name); ?></td>
                                        <td class="py-3 px-6"><?php echo e($user->email); ?></td>
                                        <td class="py-3 px-6"><?php echo e($user->type); ?></td>
                                        <td class="py-3 px-6 flex space-x-2">
                                            <a href="<?php echo e(url('admin/users/'.$user->id.'/edit')); ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                            <form action="<?php echo e(url('admin/users/'.$user->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
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
<?php /**PATH /home/drop/web/BusinessProjects/laravel_api/resources/views/admin/adminDashboard.blade.php ENDPATH**/ ?>