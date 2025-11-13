<!-- Modal Backdrop -->
<div id="addItemModal" class="hidden fixed inset-0 z-50 items-center justify-center modal-backdrop" onclick="if(event.target === this) closeModal('addItemModal')">
    <!-- Modal Content -->
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all" onclick="event.stopPropagation()">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Tambah Data Baru Test</h3>
                <p class="text-sm text-gray-500 mt-1">Isi form di bawah untuk menambahkan data</p>
            </div>
            <button onclick="closeModal('addItemModal')" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
