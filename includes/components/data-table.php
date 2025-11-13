<?php
// Fallback data-table include. Prefer the project-level includes/components, but reuse admin/data-table.php if present.
$adminTable = __DIR__ . '/../../admin/data-table.php';
if (file_exists($adminTable)) {
    include $adminTable;
    return;
}

// Minimal fallback table if admin data-table is missing
?>
<div class="rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto p-4 text-sm text-gray-700">Data table tidak tersedia. Mohon tambahkan file <code>admin/data-table.php</code> atau <code>includes/components/data-table.php</code>.</div>
</div>
