<?php
// Dashboard fragment used by admin/user dashboards.
// Expects $stats, $handoverData, $recentActivities to be available from the parent scope.
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <?php foreach ($stats as $s): ?>
    <div class="content-card bg-white p-4 rounded-xl shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500"><?= htmlspecialchars($s['title']) ?></p>
                <p class="text-2xl font-bold text-gray-900 mt-1"><?= htmlspecialchars($s['value']) ?></p>
                <?php if (!empty($s['trend'])): ?>
                    <p class="text-xs text-gray-400 mt-1"><?= htmlspecialchars($s['trend']) ?></p>
                <?php endif; ?>
            </div>
            <div class="w-12 h-12 rounded-lg flex items-center justify-center bg-<?= htmlspecialchars($s['color']) ?>-100">
                <i data-lucide="<?= htmlspecialchars($s['icon']) ?>" class="w-6 h-6 text-<?= htmlspecialchars($s['color']) ?>-600"></i>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="content-card bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Serah Terima Terbaru</h2>
            <a href="?menu=handover" class="text-sm text-orange-600">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="px-3 py-2">ID</th>
                        <th class="px-3 py-2">Nama Barang</th>
                        <th class="px-3 py-2">Penerima</th>
                        <th class="px-3 py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach (array_slice($handoverData, 0, 5) as $h): ?>
                    <tr>
                        <td class="px-3 py-2 text-gray-700"><?= htmlspecialchars($h['id']) ?></td>
                        <td class="px-3 py-2 text-gray-700"><?= htmlspecialchars($h['itemName']) ?></td>
                        <td class="px-3 py-2 text-gray-700"><?= htmlspecialchars($h['recipient']) ?></td>
                        <td class="px-3 py-2">
                            <span class="px-2 py-1 rounded-full text-xs <?php
                                switch ($h['status']){
                                    case 'Dipinjam': echo 'bg-blue-100 text-blue-700'; break;
                                    case 'Dikembalikan': echo 'bg-green-100 text-green-700'; break;
                                    case 'Terlambat': echo 'bg-red-100 text-red-700'; break;
                                    default: echo 'bg-gray-100 text-gray-700';
                                }
                            ?>"><?= htmlspecialchars($h['status']) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="content-card bg-white p-6 rounded-xl shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h2>
            <a href="#" class="text-sm text-orange-600">Lihat Semua</a>
        </div>
        <ul class="space-y-3">
            <?php foreach (array_slice($recentActivities, 0, 6) as $a): ?>
            <li class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-700">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-800"><?php echo htmlspecialchars($a['item']) ?> — <span class="text-xs text-gray-500"><?= htmlspecialchars($a['time']) ?></span></p>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
if (typeof lucide !== 'undefined') lucide.createIcons();
</script>
