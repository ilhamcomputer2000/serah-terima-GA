<?php
// Fallback page fragment for 'return'. Reuse admin/return.php if present.
$adminPath = __DIR__ . '/../../admin/return.php';
if (file_exists($adminPath)) {
    include $adminPath;
    return;
}
?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div>
        <?php include __DIR__ . '/../components/return-form.php'; ?>
    </div>
    <div>
        <?php include __DIR__ . '/../components/data-table.php'; ?>
    </div>
</div>

<script src="../assets/js/forms.js"></script>
