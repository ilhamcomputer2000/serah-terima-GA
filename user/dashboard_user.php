<?php
session_start();
require_once '../koneksi.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../login.php?error=not_logged_in");
    exit();
}

// Check if user has user role
if ($_SESSION['role'] !== 'user') {
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
    <title>Dashboard User - Serah Terima & Pengembalian Barang</title>
    <link rel="stylesheet" href="../assets/css_index/index.css">
    <link rel="stylesheet" href="../assets/css_index/mobile.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    

</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 h-full bg-white shadow-xl z-50 border-r border-gray-200 sidebar-transition" style="width: 280px;">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center p-6 border-b border-gray-200">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
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
                    <div class="w-10 h-10 bg-orange-500 text-white rounded-full flex items-center justify-center shrink-0">
                        U
                    </div>
                    <div class="flex-1 min-w-0 user-info">
                        <p class="text-sm text-gray-900 truncate">User</p>
                        <p class="text-xs text-gray-500 truncate"><?= htmlspecialchars($_SESSION['nama'] ?? 'User') ?></p>
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
        <header class="bg-gradient-to-r from-orange-500 to-orange-600 border-b border-orange-700 sticky top-0 z-30 shadow-lg">
            <div class="flex items-center justify-between p-4 lg:px-8">
                    <div class="flex items-center gap-4">
                    <button id="toggleSidebar" class="text-white hover:bg-orange-600 hover:text-white p-2 rounded-lg transition-colors">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <div>
                        <h1 class="text-2xl font-bold text-white"></h1>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="relative text-white hover:bg-orange-600 p-2 rounded-lg transition-colors">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full ring-2 ring-orange-500"></span>
                    </button>
                    <div class="relative">
                        <button onclick="toggleHeaderLogout()" class="hidden sm:flex text-white hover:bg-orange-600 p-2 rounded-lg transition-colors">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </button>
                        <!-- Header Logout Button -->
                        <div id="headerLogoutBtn" class="hidden absolute right-0 top-full mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($_SESSION['nama'] ?? 'User') ?></p>
                                <p class="text-xs text-gray-500">User</p>
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

        <!-- Welcome banner (moved out of navbar) -->
        <div class="p-4 lg:p-8">
            <p class="text-sm text-gray-700">Selamat datang kembali!</p>
        </div>

        <!-- Page Content -->
        <main class="p-4 lg:p-8">
            <?php 
            // Fallback: the project currently keeps page fragments in the `admin` folder.
            // Include from there if the original `includes/pages` directory is missing.
            $pagePath = __DIR__ . '/../includes/pages/' . $activeMenu . '.php';
            if (!file_exists($pagePath)) {
                $pagePath = __DIR__ . '/../admin/' . $activeMenu . '.php';
            }
            if (file_exists($pagePath)) {
                include $pagePath;
            } else {
                echo '<div class="text-sm text-red-600">Halaman tidak ditemukan: ' . htmlspecialchars($activeMenu) . '</div>';
            }
            ?>
        </main>
    </div>
    
    <!-- Add Item Modal -->
    <?php
    // Include add-item modal: try original includes path, fallback to admin folder
    $modalPath = __DIR__ . '/../includes/components/add-item-modal.php';
    if (!file_exists($modalPath)) {
        $modalPath = __DIR__ . '/../admin/add-item-modal.php';
    }
    if (file_exists($modalPath)) include $modalPath;
    ?>
    
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
