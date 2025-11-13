<?php
session_start();
require_once '../koneksi.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../login.php?error=not_logged_in");
    exit();
}

// Check if user has super_admin role
if ($_SESSION['role'] !== 'super_admin') {
    header("Location: ../login.php?error=unauthorized");
    exit();
}

// Data statistik (nanti bisa diganti dengan query database)
$stats = [
    [
        'title' => 'Total Barang Diserahkan',
        'value' => '248',
        'icon' => 'package',
        'trend' => '+12% dari bulan lalu',
        'color' => 'blue'
    ],
    [
        'title' => 'Barang Dikembalikan',
        'value' => '186',
        'icon' => 'package-check',
        'trend' => '+8% dari bulan lalu',
        'color' => 'green'
    ],
    [
        'title' => 'Sedang Dipinjam',
        'value' => '62',
        'icon' => 'clock',
        'trend' => '',
        'color' => 'orange'
    ],
    [
        'title' => 'Total Item Terdaftar',
        'value' => '450',
        'icon' => 'package',
        'trend' => '+5% dari bulan lalu',
        'color' => 'purple'
    ]
];

// Data serah terima (nanti bisa diganti dengan query database)
$handoverData = [
    [
        'id' => 'HO-001',
        'itemName' => 'Laptop Dell XPS 15',
        'recipient' => 'Ahmad Fauzi',
        'handoverDate' => '2025-11-01',
        'expectedReturn' => '2025-11-15',
        'status' => 'Dipinjam',
        'notes' => 'Untuk presentasi klien'
    ],
    [
        'id' => 'HO-002',
        'itemName' => 'Proyektor Epson EB-X41',
        'recipient' => 'Siti Nurhaliza',
        'handoverDate' => '2025-10-28',
        'expectedReturn' => '2025-11-05',
        'status' => 'Dikembalikan',
        'notes' => 'Training karyawan'
    ],
    [
        'id' => 'HO-003',
        'itemName' => 'Kamera Canon EOS M50',
        'recipient' => 'Budi Santoso',
        'handoverDate' => '2025-10-20',
        'expectedReturn' => '2025-11-01',
        'status' => 'Terlambat',
        'notes' => 'Dokumentasi event'
    ],
    [
        'id' => 'HO-004',
        'itemName' => 'iPad Pro 12.9',
        'recipient' => 'Dewi Lestari',
        'handoverDate' => '2025-11-05',
        'expectedReturn' => '2025-11-20',
        'status' => 'Dipinjam',
        'notes' => 'Demo produk'
    ],
    [
        'id' => 'HO-005',
        'itemName' => 'Printer Canon Pixma',
        'recipient' => 'Eko Prasetyo',
        'handoverDate' => '2025-10-15',
        'expectedReturn' => '2025-10-30',
        'status' => 'Dikembalikan',
        'notes' => 'Cetak dokumen'
    ]
];

// Data aktivitas terbaru
$recentActivities = [
    [
        'type' => 'handover',
        'item' => 'Laptop Dell XPS 15',
        'person' => 'Ahmad Fauzi',
        'time' => '2 jam yang lalu'
    ],
    [
        'type' => 'return',
        'item' => 'Proyektor Epson EB-X41',
        'person' => 'Siti Nurhaliza',
        'time' => '5 jam yang lalu'
    ],
    [
        'type' => 'overdue',
        'item' => 'Kamera Canon EOS M50',
        'person' => 'Budi Santoso',
        'time' => '1 hari yang lalu'
    ],
    [
        'type' => 'handover',
        'item' => 'iPad Pro 12.9',
        'person' => 'Dewi Lestari',
        'time' => '2 hari yang lalu'
    ],
    [
        'type' => 'return',
        'item' => 'Printer Canon Pixma',
        'person' => 'Eko Prasetyo',
        'time' => '3 hari yang lalu'
    ]
];

$activeMenu = isset($_GET['menu']) ? $_GET['menu'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - Serah Terima & Pengembalian Barang</title>
    <link rel="stylesheet" href="../assets/css_index/index.css">
    <link rel="stylesheet" href="../assets/css_index/mobile.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#f97316', // orange-500
                            600: '#ea580c', // orange-600
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 h-full bg-white shadow-xl z-50 border-r border-gray-200 sidebar-transition" style="width: 280px;">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center p-6 border-b border-gray-200">
                <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="package" class="w-8 h-8 text-white"></i>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <div id="menuLabel" class="text-xs uppercase tracking-wider text-gray-400 px-4 mb-3 mt-2">
                    Main Menu
                </div>

                <a href="?menu=dashboard" class="nav-link has-tooltip <?= $activeMenu === 'dashboard' ? 'active' : '' ?>" data-menu="dashboard">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span class="nav-label">Dashboard</span>
                    <span class="tooltip">Dashboard</span>
                </a>

                <a href="?menu=handover" class="nav-link has-tooltip <?= $activeMenu === 'handover' ? 'active' : '' ?>" data-menu="handover">
                    <i data-lucide="package" class="w-5 h-5"></i>
                    <span class="nav-label">Serah Terima</span>
                    <span class="badge">3</span>
                    <span class="tooltip">Serah Terima</span>
                </a>

                <a href="?menu=return" class="nav-link has-tooltip <?= $activeMenu === 'return' ? 'active' : '' ?>" data-menu="return">
                    <i data-lucide="package-check" class="w-5 h-5"></i>
                    <span class="nav-label">Pengembalian</span>
                    <span class="tooltip">Pengembalian</span>
                </a>

                <a href="?menu=settings" class="nav-link has-tooltip <?= $activeMenu === 'settings' ? 'active' : '' ?>" data-menu="settings">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    <span class="nav-label">Pengaturan</span>
                    <span class="tooltip">Pengaturan</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-200">
                <div id="userProfile" onclick="toggleLogout()" class="flex items-center gap-3 p-3 rounded-xl bg-orange-50 hover:bg-orange-100 transition-colors cursor-pointer relative">
                    <div class="w-10 h-10 bg-primary-500 text-white rounded-full flex items-center justify-center shrink-0">
                        SA
                    </div>
                    <div class="flex-1 min-w-0 user-info">
                        <p class="text-sm text-gray-900 truncate">Super Admin</p>
                        <p class="text-xs text-gray-500 truncate"><?= htmlspecialchars($_SESSION['nama'] ?? 'Super Admin') ?></p>
                    </div>
                    <!-- Logout Button -->
                    <div id="logoutBtn" class="hidden absolute right-0 top-full mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i data-lucide="log-out" class="w-4 h-4 inline-block mr-2"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div id="mainContent" class="content-transition" style="margin-left: 280px;">
        <!-- Header -->
        <header class="bg-gradient-to-r from-primary-500 to-primary-600 border-b border-primary-700 sticky top-0 z-30 shadow-lg">
            <div class="flex items-center justify-between p-4 lg:px-8">
                <div class="flex items-center gap-4">
                    <button id="toggleSidebar" class="text-white hover:bg-primary-600 hover:text-white p-2 rounded-lg transition-colors">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                </div>
                <div class="flex items-center gap-3">
                    <button class="relative text-white hover:bg-primary-600 p-2 rounded-lg transition-colors">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full ring-2 ring-primary-500"></span>
                    </button>
                    <div class="relative">
                        <button onclick="toggleHeaderLogout()" class="hidden sm:flex text-white hover:bg-primary-600 p-2 rounded-lg transition-colors">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </button>
                        <!-- Header Logout Button -->
                        <div id="headerLogoutBtn" class="hidden absolute right-0 top-full mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($_SESSION['nama'] ?? 'Super Admin') ?></p>
                                <p class="text-xs text-gray-500">Super Admin</p>
                            </div>
                            <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i data-lucide="log-out" class="w-4 h-4 inline-block mr-2"></i>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 lg:p-8">
            <?php if ($activeMenu === 'dashboard'): ?>
            <!-- Dashboard Content -->
            <!-- Welcome Banner -->
            <div class="mb-8 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-2xl shadow-lg p-6 lg:p-8">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Dashboard Super Admin</h1>
                <p class="text-primary-100 text-base md:text-lg">Selamat datang kembali, <?= htmlspecialchars($_SESSION['nama'] ?? 'Super Admin') ?>! Mari kita kelola sistem dengan baik.</p>
            </div>

            <div class="grid gap-4 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <?php foreach ($stats as $stat): ?>
                    <div class="p-4 bg-white rounded-lg shadow flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($stat['title']) ?></p>
                            <p class="text-2xl font-bold"><?= htmlspecialchars($stat['value']) ?></p>
                            <?php if ($stat['trend']): ?>
                            <p class="text-xs text-green-600">
                                <i data-lucide="trending-up" class="inline w-3 h-3"></i>
                                <?= htmlspecialchars($stat['trend']) ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="p-3 rounded-full bg-<?= $stat['color'] ?>-100">
                            <i data-lucide="<?= $stat['icon'] ?>" class="w-6 h-6 text-<?= $stat['color'] ?>-600"></i>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Recent Handovers Table -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Data Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="p-4">ID</th>
                                    <th class="p-4">Nama Barang</th>
                                    <th class="p-4">Penerima</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($handoverData as $item): ?>
                                <tr class="border-t">
                                    <td class="p-4"><?= htmlspecialchars($item['id']) ?></td>
                                    <td class="p-4"><?= htmlspecialchars($item['itemName']) ?></td>
                                    <td class="p-4"><?= htmlspecialchars($item['recipient']) ?></td>
                                    <td class="p-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            <?= $item['status'] === 'Dipinjam' ? 'bg-blue-100 text-blue-700' :
                                               ($item['status'] === 'Dikembalikan' ? 'bg-green-100 text-green-700' :
                                                'bg-red-100 text-red-700') ?>">
                                            <?= htmlspecialchars($item['status']) ?>
                                        </span>
                                    </td>
                                    <td class="p-4"><?= htmlspecialchars($item['handoverDate']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h3>
                    <div class="space-y-4">
                        <?php foreach ($recentActivities as $activity): ?>
                        <div class="flex items-center gap-4">
                            <div class="p-2 rounded-full
                                <?= $activity['type'] === 'handover' ? 'bg-blue-100' :
                                   ($activity['type'] === 'return' ? 'bg-green-100' : 'bg-red-100') ?>">
                                <i data-lucide="<?= $activity['type'] === 'handover' ? 'package' :
                                                  ($activity['type'] === 'return' ? 'package-check' : 'clock') ?>"
                                   class="w-5 h-5 <?= $activity['type'] === 'handover' ? 'text-blue-600' :
                                                    ($activity['type'] === 'return' ? 'text-green-600' : 'text-red-600') ?>"></i>
                            </div>
                            <div>
                                <p class="text-sm">
                                    <span class="font-medium"><?= htmlspecialchars($activity['person']) ?></span>
                                    <?= $activity['type'] === 'handover' ? 'meminjam' :
                                       ($activity['type'] === 'return' ? 'mengembalikan' : 'terlambat mengembalikan') ?>
                                    <span class="font-medium"><?= htmlspecialchars($activity['item']) ?></span>
                                </p>
                                <p class="text-xs text-gray-500"><?= htmlspecialchars($activity['time']) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php elseif ($activeMenu === 'handover'): ?>
            <!-- Handover Content -->
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Serah Terima Barang</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-4">ID</th>
                                <th class="p-4">Nama Barang</th>
                                <th class="p-4">Penerima</th>
                                <th class="p-4">Tanggal Pinjam</th>
                                <th class="p-4">Tanggal Kembali</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($handoverData as $item): ?>
                            <tr class="border-t">
                                <td class="p-4"><?= htmlspecialchars($item['id']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($item['itemName']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($item['recipient']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($item['handoverDate']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($item['expectedReturn']) ?></td>
                                <td class="p-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        <?= $item['status'] === 'Dipinjam' ? 'bg-blue-100 text-blue-700' :
                                           ($item['status'] === 'Dikembalikan' ? 'bg-green-100 text-green-700' :
                                            'bg-red-100 text-red-700') ?>">
                                        <?= htmlspecialchars($item['status']) ?>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php elseif ($activeMenu === 'return'): ?>
            <!-- Return Content -->
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-xl font-bold mb-4">Pengembalian Barang</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-4">ID</th>
                                <th class="p-4">Nama Barang</th>
                                <th class="p-4">Penerima</th>
                                <th class="p-4">Tgl Pinjam</th>
                                <th class="p-4">Tgl Kembali</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($handoverData as $item): ?>
                            <?php if ($item['status'] !== 'Dikembalikan'): ?>
                            <tr class="border-t">
                                <td class="p-4"><?= htmlspecialchars($item['id']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($item['itemName']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($item['recipient']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($item['handoverDate']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($item['expectedReturn']) ?></td>
                                <td class="p-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        <?= $item['status'] === 'Dipinjam' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' ?>">
                                        <?= htmlspecialchars($item['status']) ?>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <button onclick="returnItem('<?= htmlspecialchars($item['id']) ?>')"
                                            class="text-green-600 hover:text-green-800">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php elseif ($activeMenu === 'settings'): ?>
            <!-- Settings Content -->
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-xl font-bold mb-4">Pengaturan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Profile Settings -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Profil</h3>
                        <div>
                            <label class="block text-sm font-medium mb-2">Nama</label>
                            <input type="text" value="Super Admin" class="w-full p-2 border rounded focus:ring focus:ring-orange-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" value="admin@inv.com" class="w-full p-2 border rounded focus:ring focus:ring-orange-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Password Baru</label>
                            <input type="password" class="w-full p-2 border rounded focus:ring focus:ring-orange-200">
                        </div>
                    </div>

                    <!-- Notification Settings -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Notifikasi</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" checked class="w-4 h-4 text-orange-600 focus:ring-orange-500">
                                <span>Email notifikasi ketika barang dipinjam</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" checked class="w-4 h-4 text-orange-600 focus:ring-orange-500">
                                <span>Email notifikasi ketika barang mendekati tenggat waktu</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" checked class="w-4 h-4 text-orange-600 focus:ring-orange-500">
                                <span>Email notifikasi ketika barang dikembalikan</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button class="px-4 py-2 text-gray-600 border rounded hover:bg-gray-50">
                        Batal
                    </button>
                    <button class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </main>
    </div>

    <!-- Add Item Modal -->
    <div id="addItemModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-semibold">Tambah Data Baru</h3>
                    <button onclick="closeModal('addItemModal')" class="text-gray-400 hover:text-gray-600">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <form action="process_handover.php" method="POST" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Nama Barang</label>
                        <input type="text" name="itemName" class="w-full p-2 border rounded focus:ring focus:ring-orange-200" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Penerima</label>
                        <input type="text" name="recipient" class="w-full p-2 border rounded focus:ring focus:ring-orange-200" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Tanggal Pinjam</label>
                            <input type="date" name="handoverDate" class="w-full p-2 border rounded focus:ring focus:ring-orange-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Tanggal Kembali</label>
                            <input type="date" name="expectedReturn" class="w-full p-2 border rounded focus:ring focus:ring-orange-200" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Catatan</label>
                        <textarea name="notes" class="w-full p-2 border rounded focus:ring focus:ring-orange-200" rows="3"></textarea>
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" onclick="closeModal('addItemModal')"
                                class="px-4 py-2 text-gray-600 border rounded hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer"></div>

    <!-- JavaScript -->
    <script src="../assets/js/main.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>