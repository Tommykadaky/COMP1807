const dataProducts = [
    { id: 1, name: "Fiber Max 1Gbps", price: "£50 / month", category: "Broadband", image: "⚡", desc: "Ultra-fast home internet connection." },
    { id: 2, name: "10GB Data Boost", price: "£10", category: "MobileAddOn", image: "📱", desc: "Extra data for your current plan." },
    { id: 3, name: "Home Hub 500Mbps", price: "£35 / month", category: "Broadband", image: "📡", desc: "Reliable home WiFi plan." },
    { id: 4, name: "Roaming Pass 7 Days", price: "£15", category: "Roaming", image: "🌐", desc: "Stay connected while traveling abroad." },
    { id: 5, name: "Unlimited 5G Plan", price: "£25 / month", category: "MobileAddOn", image: "📶", desc: "Unlimited 5G data everywhere you go." }
];

let currentCategory = 'all';
let cart = JSON.parse(localStorage.getItem('myCart')) || [];

// Chạy các chức năng khi trang Data vừa load xong
document.addEventListener('DOMContentLoaded', () => {
    renderDataProducts();
    updateCartBadge();

    // Lắng nghe sự kiện tìm kiếm trên trang Data
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', renderDataProducts);
    }
});

// --- HÀM HIỂN THỊ VÀ LỌC GÓI DATA ---
function renderDataProducts() {
    const grid = document.getElementById('dataGrid');
    if (!grid) return;
    
    grid.innerHTML = ''; 

    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';

    let filteredProducts = dataProducts;
    
    // Lọc theo nhóm danh mục
    if (currentCategory !== 'all') {
        filteredProducts = filteredProducts.filter(p => p.category === currentCategory);
    }

    // Lọc theo từ khóa tìm kiếm
    if (searchTerm !== '') {
        filteredProducts = filteredProducts.filter(p => p.name.toLowerCase().includes(searchTerm));
    }

    if (filteredProducts.length === 0) {
        grid.innerHTML = `<p style="grid-column: span 2; text-align: center; color: #6b7280; padding: 2rem 0;">No data plans found.</p>`;
        return;
    }

    filteredProducts.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <div class="product-image">${product.image}</div>
            <div class="product-title">${product.name}</div>
            <div class="product-price">${product.price}</div>
            <button class="add-btn" onclick="buyDataPackage('${product.name}')">Buy Now</button>
        `;
        grid.appendChild(card);
    });
}

// --- HÀM XỬ LÝ KHI BẤM CÁC NÚT NHÓM (CATEGORIES) ---
function filterData(category, clickedButton) {
    currentCategory = category;
    
    const buttons = document.querySelectorAll('.cat-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    if (clickedButton) clickedButton.classList.add('active');

    renderDataProducts();
}

// --- MUA GÓI DATA (Lưu vào Lịch sử mua hàng) ---
function buyDataPackage(packageName) {
    const newItem = {
        name: packageName,
        date: new Date().toLocaleDateString()
    };
    
    let history = JSON.parse(localStorage.getItem('myHistory')) || [];
    history.push(newItem);
    localStorage.setItem('myHistory', JSON.stringify(history));
    
    alert(`Successfully bought ${packageName}! Check your Purchase History in Orders.`);
}

// --- LOGIC GIỎ HÀNG DÙNG CHUNG ---
function updateCartBadge() {
    cart = JSON.parse(localStorage.getItem('myCart')) || [];
    const badge = document.getElementById('cartBadge');
    if (badge) {
        if (cart.length > 0) {
            badge.textContent = cart.length;
            badge.style.display = 'block';
        } else {
            badge.style.display = 'none';
        }
    }
}

function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('myCart', JSON.stringify(cart));
    updateCartBadge();
    openCart();
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.remove();
}

function openCart() {
    const existingModal = document.getElementById('cartModal');
    if (existingModal) existingModal.remove();

    const modal = document.createElement('div');
    modal.id = 'cartModal';
    modal.style.cssText = `
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.5); display: flex; align-items: center;
        justify-content: center; z-index: 1000;
    `;

    let cartItemsHtml = '';
    if (cart.length === 0) {
        cartItemsHtml = '<p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 1rem; text-align: center;">Your cart is empty.</p>';
    } else {
        cart.forEach((item, index) => {
            cartItemsHtml += `
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 0.75rem;">
                    <div style="display: flex; flex-direction: column; text-align: left;">
                        <span style="font-size: 0.85rem; color: #1f2937; font-weight: 600;">${item.name}</span>
                        <span style="font-size: 0.85rem; color: #2563eb; font-weight: bold;">${item.price}</span>
                    </div>
                    <button onclick="removeFromCart(${index})" style="background: none; border: none; color: #ef4444; font-size: 1.5rem; cursor: pointer; padding: 0 0.5rem;">&times;</button>
                </div>
            `;
        });
    }

    modal.innerHTML = `
        <div style="background: white; padding: 1.5rem; border-radius: 1rem; width: 90%; max-width: 24rem; max-height: 80vh; overflow-y: auto; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 1.25rem; font-size: 1.25rem; color: #1f2937;">Shopping Cart</h3>
            ${cartItemsHtml}
            <button onclick="closeModal('cartModal')" style="width: 100%; padding: 0.75rem; margin-top: 1rem; background-color: #f3f4f6; color: #374151; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer;">Close</button>
        </div>
    `;

    document.body.appendChild(modal);
}