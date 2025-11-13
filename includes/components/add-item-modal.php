<!-- Modal Backdrop -->
<div id="addItemModal" class="hidden fixed inset-0 z-50 items-center justify-center modal-backdrop" onclick="if(event.target === this) closeModal('addItemModal')">
    <!-- Modal Content -->
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-6xl mx-4 transform transition-all" onclick="event.stopPropagation()">
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
        <form onsubmit="submitForm(event)" class="p-6 space-y-6">
            <!-- Row 1: Create By + Waktu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php
                $karyawan_id = isset($_SESSION['Id_karyawan']) ? $_SESSION['Dd_Karyawan'] : '';
                $karyawan_nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : '';
                ?>
                <div class="space-y-2">
                    <label class="inline-block text-sm font-medium text-gray-700 min-w-[120px]">Create By *</label>
                    <input 
                        type="text" 
                        name="id_karyawan"
                        value="<?php echo htmlspecialchars($karyawan_id) . ' - ' . htmlspecialchars($karyawan_nama); ?>"
                        readonly
                        class="w-auto max-w-[300px] px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                    >
                </div>

                <div class="space-y-2">
                    <label class="inline-block text-sm font-medium text-gray-700 min-w-[120px]">Waktu Tambah Data *</label>
                    <input 
                        type="datetime-local" 
                        name="handoverTime"
                        id="handoverTime"
                        required
                        readonly
                        class="w-auto max-w-[300px] px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                    >
                </div>
            </div>

            <!-- Row 2: Nama Barang (Dropdown + Tombol Tambah) -->
            <div class="space-y-2">
                <label class="inline-block text-sm font-medium text-gray-700 min-w-[120px]">Nama Barang *</label>
                <div class="relative flex items-center">
                    <select 
                        name="itemName" 
                        id="itemNameSelect"
                        required 
                        class="w-auto max-w-[300px] px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none appearance-none"
                    >
                        <option value="">Pilih nama barang...</option>
                        <?php
                        // Ganti dengan query dari database Anda
                        $barang_list = [
                            ['id_barang' => 1, 'nama_barang' => 'Laptop XYZ'],
                            ['id_barang' => 2, 'nama_barang' => 'Mouse Wireless'],
                            ['id_barang' => 3, 'nama_barang' => 'Keyboard Gaming'],
                        ];

                        if (count($barang_list) > 0) {
                            foreach ($barang_list as $item) {
                                echo '<option value="'.htmlspecialchars($item['nama_barang']).'">'.htmlspecialchars($item['nama_barang']).'</option>';
                            }
                        } else {
                            echo '<option value="">Tidak ada data barang</option>';
                        }
                        ?>
                    </select>
                    <button 
                        type="button" 
                        onclick="openAddBarangModal()"
                        class="absolute right-2 bg-gray-100 hover:bg-gray-200 text-gray-700 p-1 rounded-md text-sm transition-colors"
                        title="Tambah Barang Baru"
                    >
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Row 3: Penerima + Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="inline-block text-sm font-medium text-gray-700 min-w-[120px]">Penerima *</label>
                    <input 
                        type="text" 
                        name="recipient"
                        placeholder="Masukkan nama penerima" 
                        required
                        class="w-auto max-w-[300px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                    >
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="inline-block text-sm font-medium text-gray-700 min-w-[100px]">Tanggal *</label>
                        <input 
                            type="date" 
                            name="handoverDate"
                            required
                            class="w-auto max-w-[180px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                        >
                    </div>
                    <div class="space-y-2">
                        <label class="inline-block text-sm font-medium text-gray-700 min-w-[100px]">Tgl Kembali</label>
                        <input 
                            type="date" 
                            name="expectedReturn"
                            class="w-auto max-w-[180px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                        >
                    </div>
                </div>
            </div>

            <!-- Row 4: Catatan -->
            <div class="space-y-2">
                <label class="inline-block text-sm font-medium text-gray-700 min-w-[120px]">Catatan</label>
                <textarea 
                    name="notes"
                    placeholder="Tambahkan catatan (opsional)"
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none resize-none"
                ></textarea>
            </div>

            <!-- Row 5: Contoh 3 Field Tambahan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="inline-block text-sm font-medium text-gray-700 min-w-[120px]">Field 4</label>
                    <input type="text" name="field4" class="w-auto max-w-[300px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="inline-block text-sm font-medium text-gray-700 min-w-[120px]">Field 5</label>
                    <input type="text" name="field5" class="w-auto max-w-[300px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="inline-block text-sm font-medium text-gray-700 min-w-[120px]">Field 6</label>
                    <input type="text" name="field6" class="w-auto max-w-[300px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                </div>
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

<!-- Modal Tambah Barang Baru -->
<div id="addBarangModal" class="hidden fixed inset-0 z-50 items-center justify-center modal-backdrop" onclick="if(event.target === this) closeModal('addBarangModal')">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-900">Tambah Barang Baru</h3>
            <button onclick="closeModal('addBarangModal')" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="p-6">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Nama Barang Baru</label>
                <input 
                    type="text" 
                    id="newItemName"
                    placeholder="Masukkan nama barang baru"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none"
                >
            </div>
            <div class="flex gap-3 pt-4">
                <button 
                    type="button" 
                    onclick="closeModal('addBarangModal')" 
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                >
                    Batal
                </button>
                <button 
                    type="button" 
                    onclick="addNewBarang()"
                    class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                >
                    Tambahkan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Fungsi untuk membuka modal utama
    function openAddItemModal() {
        document.getElementById('addItemModal').classList.remove('hidden');
        setDefaultDateTime();
    }

    // Fungsi untuk membuka modal tambah barang
    function openAddBarangModal() {
        document.getElementById('addBarangModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Fungsi untuk mengisi waktu otomatis
    function setDefaultDateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        const datetimeLocal = `${year}-${month}-${day}T${hours}:${minutes}`;
        const timeInput = document.getElementById('handoverTime');

        if (timeInput) {
            timeInput.value = datetimeLocal;
            console.log("Waktu otomatis diisi:", datetimeLocal);
        } else {
            console.error("Input #handoverTime tidak ditemukan.");
        }
    }

    // Fungsi untuk menambah barang baru ke dropdown
    function addNewBarang() {
        const input = document.getElementById('newItemName');
        const select = document.getElementById('itemNameSelect');
        const newName = input.value.trim();

        if (!newName) {
            alert('Nama barang tidak boleh kosong.');
            return;
        }

        // Buat opsi baru
        const option = document.createElement('option');
        option.value = newName;
        option.text = newName;
        option.selected = true; // Pilih item baru

        // Tambahkan ke dropdown
        select.appendChild(option);

        // Kosongkan input dan tutup modal
        input.value = '';
        closeModal('addBarangModal');
    }

    setTimeout(setDefaultDateTime, 100);
</script>