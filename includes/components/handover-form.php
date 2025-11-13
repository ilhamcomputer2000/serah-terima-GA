<div class="content-card bg-white p-6 rounded-xl shadow-sm">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Form Serah Terima</h3>
    <form id="handoverForm" class="space-y-4" onsubmit="handleHandoverSubmit(event)">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Barang *</label>
                <input type="text" name="itemName" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Contoh: Laptop Dell XPS">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Penerima *</label>
                <input type="text" name="recipient" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Nama penerima">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Serah Terima *</label>
                <input type="date" name="handoverDate" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Kembali (opsional)</label>
                <input type="date" name="expectedReturn" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea name="notes" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Catatan tambahan (opsional)"></textarea>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg"> 
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan
            </button>
            <button type="reset" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Reset</button>
        </div>
    </form>
</div>

<script>
if (typeof lucide !== 'undefined') lucide.createIcons();
</script>