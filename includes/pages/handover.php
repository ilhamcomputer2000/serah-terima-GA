<?php
// Handover page: show the input form and the data table side-by-side on large screens.
// If admin fragment still exists, prefer it (keeps backward compatibility).
$adminPath = __DIR__ . '/../../admin/handover.php';
if (file_exists($adminPath)) {
    include $adminPath;
    return;
}
?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div>
        <?php include __DIR__ . '/../components/handover-form.php'; ?>
    </div>
    <div>
        <?php include __DIR__ . '/../components/data-table.php'; ?>
    </div>
</div>

<script src="../assets/js/forms.js"></script>
