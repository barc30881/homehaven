<?php
use Framework\Session;
?>

<?php $successMessage = Session::getFlashMessage('success_message'); ?>
<?php if ($successMessage !== null): ?>

    <div class="badge bg-success ms-2" ><?= $successMessage ?></div>
<?php endif; ?>

<?php $errorMessage = Session::getFlashMessage('error_message'); ?>
<?php if ($errorMessage !== null): ?>
    <div class="badge text-danger bg-danger-subtle ms-2" ><?= $errorMessage ?></div>

<?php endif; ?>