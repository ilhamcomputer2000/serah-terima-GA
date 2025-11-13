<?php
// Fallback page fragment for 'settings'. Reuse admin/settings.php if present.
$adminPath = __DIR__ . '/../../admin/settings.php';
if (file_exists($adminPath)) {
    include $adminPath;
    return;
}
?>
<div class="content-card bg-white p-6 rounded-xl shadow-sm fade-in">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Pengaturan</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola pengaturan aplikasi</p>
        </div>
    </div>

    <div class="rounded-lg border border-gray-200 overflow-hidden p-4 text-sm text-gray-700">Halaman pengaturan belum tersedia. Mohon tambahkan <code>admin/settings.php</code> atau <code>includes/pages/settings.php</code>.</div>
</div>

<script>
if (typeof lucide !== 'undefined') lucide.createIcons();
</script>
