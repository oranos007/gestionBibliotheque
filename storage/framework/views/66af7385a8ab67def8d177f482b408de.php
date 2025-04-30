<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Borrowed Books</h2>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $borrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($borrow->book->title); ?></td>
                            <td><?php echo e($borrow->borrow_date->format('Y-m-d')); ?></td>
                            <td><?php echo e($borrow->return_date->format('Y-m-d')); ?></td>
                            <td>
                                <?php if($borrow->returned): ?>
                                    <span class="badge bg-success">Returned</span>
                                <?php elseif($borrow->return_date->isPast()): ?>
                                    <span class="badge bg-danger">Overdue</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Borrowed</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(!$borrow->returned): ?>
                                <form action="<?php echo e(route('borrows.return', $borrow->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-arrow-return-left"></i> Return
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">You haven't borrowed any books yet.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                <?php echo e($borrows->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/oranos/laravel-projects/miniProject/resources/views/borrows/index.blade.php ENDPATH**/ ?>