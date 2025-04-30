<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Books Reportee</h2>
        <div class="btn-group">
            <a href="<?php echo e(route('reports.books')); ?>?sort=popular" 
               class="btn btn-outline-primary <?php echo e(request('sort') == 'popular' ? 'active' : ''); ?>">
                Most Popular
            </a>
            <a href="<?php echo e(route('reports.books')); ?>?sort=available" 
               class="btn btn-outline-success <?php echo e(request('sort') == 'available' ? 'active' : ''); ?>">
                Available
            </a>
            <a href="<?php echo e(route('reports.books')); ?>" 
               class="btn btn-outline-secondary">
                Reset
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Borrow Count</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($book->title); ?></td>
                            <td><?php echo e($book->author1); ?></td>
                            <td><?php echo e($book->isbn); ?></td>
                            <td><?php echo e($book->borrows_count); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($book->available ? 'success' : 'danger'); ?>">
                                    <?php echo e($book->available ? 'Available' : 'Checked Out'); ?>

                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">No books found</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <?php echo e($books->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/oranos/laravel-projects/miniProject/resources/views/reports/books.blade.php ENDPATH**/ ?>