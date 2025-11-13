<!-- Modal Backdrop -->
<div id="addItemModal" class="hidden fixed inset-0 z-50 items-center justify-center modal-backdrop" onclick="if(event.target === this) closeModal('addItemModal')">
    <!-- Modal Content -->
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all" onclick="event.stopPropagation()">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Tambah Data Baru</h3>
                <p class="text-sm text-gray-500 mt-1">Isi form di bawah untuk menambahkan data</p>
            </div>
            <button onclick="closeModal('addItemModal')" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <!-- Modal Body -->
        <form onsubmit="submitForm(event)" class="p-6 space-y-4">
            <!-- Type -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Tipe Transaksi</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                    <option value="serah-terima">Serah Terima</option>
                    <option value="pengembalian">Pengembalian</option>
                </select>
            </div>
            
            <!-- Item Name -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Nama Barang *</label>
                <input 
                    type="text" 
                    name="itemName"
                    placeholder="Masukkan nama barang" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                >
            </div>
            
            <!-- Recipient -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Penerima *</label>
                <input 
                    type="text" 
                    name="recipient"
                    placeholder="Masukkan nama penerima" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                >
            </div>
            
            <!-- Dates -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Tanggal *</label>
                    <input 
                        type="date" 
                        name="handoverDate"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                    >
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Tgl Kembali</label>
                    <input 
                        type="date" 
                        name="expectedReturn"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                    >
                </div>
            </div>
            
            <!-- Notes -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea 
                    name="notes"
                    placeholder="Tambahkan catatan (opsional)"
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none resize-none"
                ></textarea>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="button" 
                    onclick="closeModal('addItemModal')" 
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
