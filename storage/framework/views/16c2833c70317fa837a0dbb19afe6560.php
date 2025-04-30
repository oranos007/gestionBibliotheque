<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Book Details</h4>
                    <div>
                        <a href="<?php echo e(route('books.index')); ?>" class="btn btn-sm btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('books.edit', $book->id)); ?>" class="btn btn-sm btn-primary ms-2">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">ISBN:</div>
                        <div class="col-md-8"><?php echo e($book->isbn); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Title:</div>
                        <div class="col-md-8"><?php echo e($book->title); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Publisher:</div>
                        <div class="col-md-8"><?php echo e($book->publisher); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Year:</div>
                        <div class="col-md-8"><?php echo e($book->year); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Quantity:</div>
                        <div class="col-md-8"><?php echo e($book->quantity); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Category:</div>
                        <div class="col-md-8"><?php echo e($book->category); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Volume:</div>
                        <div class="col-md-8"><?php echo e($book->volume ?? 'N/A'); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Authors:</div>
                        <div class="col-md-8">
                            <ol>
                                <li><?php echo e($book->author1); ?></li>
                                <?php if($book->author2): ?>
                                <li><?php echo e($book->author2); ?></li>
                                <?php endif; ?>
                                <?php if($book->author3): ?>
                                <li><?php echo e($book->author3); ?></li>
                                <?php endif; ?>
                                <?php if($book->author4): ?>
                                <li><?php echo e($book->author4); ?></li>
                                <?php endif; ?>
                            </ol>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Status:</div>
                        <div class="col-md-8">
                            <span class="badge bg-<?php echo e($book->available ? 'success' : 'danger'); ?>">
                                <?php echo e($book->available ? 'Available' : 'Not Available'); ?>

                            </span>
                        </div>
                    </div>
                    
                    <?php if($book->available): ?>
                    <div class="d-grid mt-4">
                        <form action="<?php echo e(route('borrows.borrow', $book->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-bookmark-plus"></i> Borrow This Book
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/oranos/laravel-projects/miniProject/resources/views/books/show.blade.php ENDPATH**/ ?>