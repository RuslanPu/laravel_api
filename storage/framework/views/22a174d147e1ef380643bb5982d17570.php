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
            <?php echo e(__('Create Package')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo e(url('admin/packages/store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Package Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>

                        <br>

                        <h6>Managers</h6>

                        <div class="mb-3">
                            <label for="managers">Assign managers for this package:</label>
                            <select multiple class="form-select" name="managers[]" id="managers">
                                <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($manager->id); ?>"><?php echo e($manager->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <br>

                        <h6>Services</h6>

                        <h3>Services</h3>
                        <div id="service-form-group">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" onchange="updateServices()">
                                    <option value="">Select Category</option>
                                    <?php $__currentLoopData = $servicesByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $services): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="service" class="form-label">Service</label>
                                <select class="form-select" id="service" onchange="updateServiceFields()">
                                    <option value="">Select Service</option>
                                </select>
                            </div>

                            <div id="service-fields"></div>

                            <button type="button" class="btn btn-secondary" onclick="addService()">Add Service</button>
                        </div>

                        <div id="services-container" class="mt-4">
                            <!-- Динамически добавляемые услуги будут появляться здесь -->
                        </div>

                        <div class="flex items-center justify-end mt-4">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const servicesByCategory = <?php echo json_encode($servicesByCategory, 15, 512) ?>;

        function updateServices() {
            const category = document.getElementById('category').value;
            const serviceSelect = document.getElementById('service');
            serviceSelect.innerHTML = '<option value="">Select Service</option>';

            if (category && servicesByCategory[category]) {
                servicesByCategory[category].forEach(service => {
                    serviceSelect.innerHTML += `<option value="${service.id}" data-type="${service.type}">${service.name}</option>`;
                });
            }
        }

        function updateServiceFields() {
            const serviceSelect = document.getElementById('service');
            const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
            const serviceType = selectedService.getAttribute('data-type');
            const serviceFields = document.getElementById('service-fields');
            serviceFields.innerHTML = '';

            if (serviceType === 'Default') {
                serviceFields.innerHTML = `
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity">
                    </div>
                `;
            } else if (serviceType === 'Custom Comments') {
                serviceFields.innerHTML = `
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments</label>
                        <textarea class="form-control" id="comments"></textarea>
                    </div>
                `;
            }
        }

        function addService() {
            const serviceSelect = document.getElementById('service');
            const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
            const serviceId = selectedService.value;
            const serviceName = selectedService.text;
            const serviceType = selectedService.getAttribute('data-type');
            const quantity = document.getElementById('quantity') ? document.getElementById('quantity').value : '';
            const comments = document.getElementById('comments') ? document.getElementById('comments').value : '';

            if (serviceId) {
                const servicesContainer = document.getElementById('services-container');
                const serviceBlock = document.createElement('div');
                serviceBlock.className = 'card mb-3';
                serviceBlock.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title text-primary">Name: ${serviceName}</h5>
                        <p class="card-text text-muted">Type: ${serviceType}</p>
                        ${quantity ? `
                        <div class="mb-3">
                            <label for="quantities" class="form-label">Quantity:</label>
                            <input type="number" class="form-control" name="quantities[${serviceId}]" value="${quantity}">
                        </div>` : ''}
                        ${comments ? `
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments:</label>
                            <input type="text" class="form-control" name="comments[${serviceId}]" value="${comments}">
                        </div>` : ''}
                        <input type="hidden" name="services[]" value="${serviceId}">
                        <button type="button" class="btn btn-danger" onclick="removeService(this)">Remove</button>
                    </div>
                `;
                servicesContainer.appendChild(serviceBlock);
            }
        }

        function removeService(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
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
<?php /**PATH /home/drop/web/BusinessProjects/laravel_api/resources/views/admin/packages/create.blade.php ENDPATH**/ ?>