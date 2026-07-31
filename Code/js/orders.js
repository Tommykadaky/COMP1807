// Biến toàn cục để dùng chung
let cart = JSON.parse(localStorage.getItem('myCart')) || [];

document.addEventListener('DOMContentLoaded', () => {
    renderOrders(); // Chạy hàm render đơn hàng
    updateCartBadge(); // Chạy hàm cập nhật chấm đỏ giỏ hàng

    // Lắng nghe sự kiện gõ tìm kiếm
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', renderOrders);
    }
});

function renderOrders() {
    const orders = JSON.parse(localStorage.getItem('myOrders')) || [];
    const history = JSON.parse(localStorage.getItem('myHistory')) || [];
    
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';

    // Lọc dữ liệu theo từ khóa tìm kiếm
    const filteredOrders = orders.filter(o => o.name.toLowerCase().includes(searchTerm));
    const filteredHistory = history.filter(h => h.name.toLowerCase().includes(searchTerm));

    // --- RENDER ACTIVE ORDERS ---
    const activeList = document.getElementById('activeOrdersList');
    if (activeList) {
        activeList.innerHTML = '';
        if (filteredOrders.length === 0) {
            activeList.innerHTML = `<p style="text-align: center; color: #6b7280; font-size: 0.85rem; padding: 2rem 0;">No active orders found.</p>`;
        } else {
            filteredOrders.forEach(order => {
                activeList.innerHTML += `
                    <div class="product-card" style="margin-bottom: 0.75rem; border-left: 4px solid #f59e0b;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                            <strong style="font-size: 0.875rem; color: #1f2937;">${order.name}</strong>
                            <span style="color: #f59e0b; font-weight: bold; font-size: 0.75rem; background: #fffbeb; padding: 0.2rem 0.5rem; border-radius: 0.25rem;">${order.status}</span>
                        </div>
                        <p style="font-size: 0.75rem; color: #6b7280;">Date: ${order.date}</p>
                    </div>
                `;
            });
        }
    }

    // --- RENDER PURCHASE HISTORY ---
    const historyList = document.getElementById('purchaseHistoryList');
    if (historyList) {
        historyList.innerHTML = '';
        if (filteredHistory.length === 0) {
            historyList.innerHTML = `<p style="text-align: center; color: #6b7280; font-size: 0.85rem; padding: 2rem 0;">No purchase history found.</p>`;
        } else {
            filteredHistory.forEach(item => {
                historyList.innerHTML += `
                    <div class="product-card" style="margin-bottom: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                            <strong style="font-size: 0.875rem; color: #1f2937;">${item.name}</strong>
                            <span style="color: #6b7280; font-size: 0.75rem;">Completed</span>
                        </div>
                        <p style="font-size: 0.75rem; color: #6b7280;">Purchased: ${item.date}</p>
                    </div>
                `;
            });
        }
    }
}

// --- LOGIC GIỎ HÀNG (Đồng bộ với Home) ---
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