<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" 
                                       name="name" value="<?php echo e(old('name', $user->name)); ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" 
                                       name="email" value="<?php echo e(old('email', $user->email)); ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" 
                                       name="phone" value="<?php echo e(old('phone', $user->phone)); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label">Address</label>
                            <div class="col-md-6">
                                <textarea id="address" class="form-control" 
                                          name="address"><?php echo e(old('address', $user->address)); ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/oranos/laravel-projects/miniProject/resources/views/profile/edit.blade.php ENDPATH**/ ?>