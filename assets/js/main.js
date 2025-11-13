// Sidebar Toggle
let sidebarCollapsed = false;

const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleBtn = document.getElementById('toggleSidebar');
const menuLabel = document.getElementById('menuLabel');
const navLabels = document.querySelectorAll('.nav-label');
const userInfo = document.querySelector('.user-info');
const badges = document.querySelectorAll('.badge');

function isMobile() {
    return window.innerWidth < 640;
}

toggleBtn.addEventListener('click', () => {
    // Mobile behavior: toggle overlay and slide-in sidebar
    if (window.innerWidth < 640) {
        const isOpen = sidebar.classList.toggle('mobile-open');
        document.body.classList.toggle('sidebar-open', isOpen);

        if (isOpen) {
            // show sidebar (slide in)
            let overlay = document.querySelector('.mobile-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.className = 'mobile-overlay';
                document.body.appendChild(overlay);
                
                // Handle overlay click
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('mobile-open');
                    document.body.classList.remove('sidebar-open');
                    overlay.classList.remove('show');
                });
            }
            overlay.classList.add('show');
        } else {
            const overlay = document.querySelector('.mobile-overlay');
            if (overlay) {
                overlay.classList.remove('show');
            }
        }

        return;
    }

    // Desktop behavior: collapse/expand sidebar
    sidebarCollapsed = !sidebarCollapsed;

    if (sidebarCollapsed) {
        sidebar.style.width = '88px';
        mainContent.style.marginLeft = '88px';
        if (menuLabel) menuLabel.style.display = 'none';
        navLabels.forEach(label => label.style.display = 'none');
        if (userInfo) userInfo.style.display = 'none';
        badges.forEach(badge => badge.style.display = 'none');

        // Center nav icons
        document.querySelectorAll('.nav-link').forEach(link => {
            link.style.justifyContent = 'center';
            link.style.padding = '1rem';
        });
    } else {
        sidebar.style.width = '280px';
        mainContent.style.marginLeft = '280px';
        if (menuLabel) menuLabel.style.display = 'block';
        navLabels.forEach(label => label.style.display = 'block');
        if (userInfo) userInfo.style.display = 'block';
        badges.forEach(badge => badge.style.display = 'inline-flex');

        // Reset nav style
        document.querySelectorAll('.nav-link').forEach(link => {
            link.style.justifyContent = 'flex-start';
            link.style.padding = '0.75rem 1rem';
        });
    }
});

// Modal Functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Toast Notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const icon = type === 'success' ? 
        '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
        '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
    
    toast.innerHTML = `
        ${icon}
        <span class="text-sm font-medium text-gray-900">${message}</span>
    `;
    
    document.getElementById('toastContainer').appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Toggle Logout Button (Sidebar)
function toggleLogout() {
    const logoutBtn = document.getElementById('logoutBtn');
    logoutBtn.classList.toggle('hidden');
}

// Toggle Header Logout Button
function toggleHeaderLogout() {
    const headerLogoutBtn = document.getElementById('headerLogoutBtn');
    headerLogoutBtn.classList.toggle('hidden');
}

// Close logout when clicking outside
document.addEventListener('click', function(event) {
    const userProfile = document.getElementById('userProfile');
    const logoutBtn = document.getElementById('logoutBtn');
    const headerLogoutBtn = document.getElementById('headerLogoutBtn');
    
    // Close sidebar logout if click is outside
    if (userProfile && !userProfile.contains(event.target)) {
        if (logoutBtn) logoutBtn.classList.add('hidden');
    }
    
    // Close header logout if click is outside
    if (!event.target.closest('[onclick="toggleHeaderLogout()"]') && headerLogoutBtn) {
        headerLogoutBtn.classList.add('hidden');
    }
});

// Add animation for slideOut
const style = document.createElement('style');
style.textContent = `
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(400px); opacity: 0; }
    }
    
    #logoutBtn {
        z-index: 50;
        transition: all 0.2s ease-in-out;
    }
    
    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        transition: all 0.2s;
        color: #4b5563;
        text-decoration: none;
        position: relative;
    }
    
    .nav-link:hover {
        background: #fff7ed;
        color: #ea580c;
    }
    
    .nav-link.active {
        background: #f97316;
        color: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .nav-link .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        background: #ef4444;
        color: white;
        border-radius: 9999px;
        margin-left: auto;
    }
    
    .nav-link.active .badge {
        background: rgba(255, 255, 255, 0.3);
    }
`;
document.head.appendChild(style);

// Search functionality
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('dataTable');
    const rows = table.getElementsByTagName('tr');
    
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let found = false;
        
        for (let j = 0; j < cells.length; j++) {
            const cell = cells[j];
            if (cell) {
                const textValue = cell.textContent || cell.innerText;
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        
        rows[i].style.display = found ? '' : 'none';
    }
}

// Filter by status
function filterByStatus(status) {
    const table = document.getElementById('dataTable');
    const rows = table.getElementsByTagName('tr');
    
    for (let i = 1; i < rows.length; i++) {
        const statusCell = rows[i].querySelector('.status-badge');
        if (status === 'all' || !statusCell) {
            rows[i].style.display = '';
        } else {
            const cellStatus = statusCell.textContent.trim();
            rows[i].style.display = cellStatus === status ? '' : 'none';
        }
    }
}

// Form submission
function submitForm(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
    
    // Here you would normally send data to server via AJAX
    // For now, just show success message
    
    showToast(
        data.type === 'serah-terima' 
            ? 'Data serah terima berhasil ditambahkan!' 
            : 'Data pengembalian berhasil ditambahkan!',
        'success'
    );
    
    closeModal('addItemModal');
    event.target.reset();
}

// View item details
function viewItem(id) {
    alert('Menampilkan detail item: ' + id);
    // You can implement a detail modal here
}

// Switch tabs
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab content
    const selectedContent = document.getElementById(tabName + 'Tab');
    if (selectedContent) {
        selectedContent.classList.remove('hidden');
    }
    
    // Add active class to clicked tab
    event.target.classList.add('active');
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to cards
    const cards = document.querySelectorAll('.stat-card, .content-card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.animation = `fadeIn 0.5s ease-out ${index * 0.1}s forwards`;
            card.style.opacity = '0';
        }, 0);
    });
});
