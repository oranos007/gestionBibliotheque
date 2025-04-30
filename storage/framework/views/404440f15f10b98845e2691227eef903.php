<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Books Management</h2>
        <?php if(auth()->user()->isAdmin()): ?>
        <a href="<?php echo e(route('books.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Book
        </a>
        <?php endif; ?>
    </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('books.index')); ?>" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search by title, author or category" name="search" value="<?php echo e(request('search')); ?>">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" name="category">
                            <option value="all">All Categories</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category); ?>" <?php echo e(request('category') == $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Year</th>
                            <th>Category</th>
                            <th>Available</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($book->isbn); ?></td>
                            <td><?php echo e($book->title); ?></td>
                            <td><?php echo e($book->author1); ?></td>
                            <td><?php echo e($book->publisher); ?></td>
                            <td><?php echo e($book->year); ?></td>
                            <td><?php echo e($book->category); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($book->available ? 'success' : 'danger'); ?>">
                                    <?php echo e($book->available ? 'Yes' : 'No'); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('books.show', $book->id)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <?php if(auth()->user()->isAdmin()): ?>
                                <a href="<?php echo e(route('books.edit', $book->id)); ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('books.destroy', $book->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                                <?php if($book->available): ?>
                                <form action="<?php echo e(route('borrows.borrow', $book->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-bookmark-plus"></i> Borrow
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">No books found</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                <?php echo e($books->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/oranos/laravel-projects/miniProject/resources/views/books/index.blade.php ENDPATH**/ ?>