<div class="content-card bg-white p-6 rounded-xl shadow-sm fade-in">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Pengembalian Barang</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data pengembalian barang</p>
        </div>
        <button onclick="openModal('addItemModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Data
        </button>
    </div>
    
    <?php include __DIR__ . '/../includes/components/data-table.php'; ?>
</div>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
