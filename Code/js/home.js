const products = [
    { id: 1, name: "ProPhone 15 (100GB Data)", price: "£999", category: "Mobile", image: "📱" },
    { id: 2, name: "Galaxy Fold (Unlimited Data)", price: "£1299", category: "Mobile", image: "📱" },
    { id: 3, name: "Lite Phone SE (10GB Data)", price: "£399", category: "Mobile", image: "📱" },
    { id: 4, name: "Pixel 8 Pro (50GB Data)", price: "£849", category: "Mobile", image: "📱" },
    { id: 5, name: "Tab Ultra 12 inch", price: "£699", category: "Tablet", image: "💻" },
    { id: 6, name: "Tab Mini 8 inch", price: "£399", category: "Tablet", image: "💻" },
    { id: 7, name: "Home Fiber 1Gbps", price: "£50 / month", category: "Broadband", image: "⚡" },
    { id: 8, name: "Home Hub 500Mbps", price: "£35 / month", category: "Broadband", image: "📡" }
];

let currentCategory = 'all';
let cart = JSON.parse(localStorage.getItem('myCart')) || [];

function renderProducts() {
    const grid = document.getElementById('productGrid');
    if (!grid) return;
    grid.innerHTML = ''; 

    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';

    let filteredProducts = products;
    
    if (currentCategory !== 'all') {
        filteredProducts = filteredProducts.filter(p => p.category === currentCategory);
    }

    if (searchTerm !== '') {
        filteredProducts = filteredProducts.filter(p => p.name.toLowerCase().includes(searchTerm));
    }

    if (filteredProducts.length === 0) {
        grid.innerHTML = `<p style="grid-column: span 2; text-align: center; color: #6b7280; padding: 2rem 0;">No products found.</p>`;
        return;
    }

    filteredProducts.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        // Ép cấu trúc chuẩn, thêm style trực tiếp để bao bọc hình ảnh không bị tràn
        card.innerHTML = `
            <div class="product-image">${product.image}</div>
            <div class="product-title">${product.name}</div>
            <div class="product-price">${product.price}</div>
            <button class="add-btn" onclick="openDetails('${product.name}', '${product.price}')">View Details</button>
        `;
        grid.appendChild(card);
    });
}

function filterProducts(category, clickedButton) {
    currentCategory = category;
    const buttons = document.querySelectorAll('.cat-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    
    if (clickedButton) clickedButton.classList.add('active');
    renderProducts();
}

document.addEventListener('DOMContentLoaded', () => {
    renderProducts();
    updateCartBadge();

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', renderProducts);
    }
});

function openDetails(productName, price) {
    const existingModal = document.getElementById('productModal');
    if (existingModal) existingModal.remove();

    const modal = document.createElement('div');
    modal.id = 'productModal';
    modal.style.cssText = `
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.5); display: flex; align-items: center;
        justify-content: center; z-index: 1000;
    `;

    modal.innerHTML = `
        <div style="background: white; padding: 1.5rem; border-radius: 1rem; width: 90%; max-width: 20rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 0.5rem; font-size: 1.1rem; color: #1f2937;">${productName}</h3>
            <p style="color: #2563eb; font-weight: bold; margin-bottom: 1.25rem;">${price}</p>
            <button onclick="addToCart('${productName}', '${price}')" style="width: 100%; padding: 0.75rem; background-color: #f3f4f6; color: #374151; border: none; border-radius: 0.5rem; font-weight: 600; margin-bottom: 0.5rem; cursor: pointer;">Add to Cart</button>
            <button onclick="buyNow('${productName}')" style="width: 100%; padding: 0.75rem; background-color: #2563eb; color: white; border: none; border-radius: 0.5rem; font-weight: 600; margin-bottom: 0.5rem; cursor: pointer;">Buy Now</button>
            <button onclick="closeModal('productModal')" style="width: 100%; padding: 0.5rem; background: none; color: #6b7280; border: none; cursor: pointer;">Cancel</button>
        </div>
    `;

    document.body.appendChild(modal);
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.remove();
}

function addToCart(productName, price) {
    cart.push({ name: productName, price: price });
    localStorage.setItem('myCart', JSON.stringify(cart));
    updateCartBadge();
    closeModal('productModal');
}

function updateCartBadge() {
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

function buyNow(productName) {
    const newOrder = {
        name: productName,
        status: "Preparing",
        date: new Date().toLocaleDateString()
    };
    
    let orders = JSON.parse(localStorage.getItem('myOrders')) || [];
    orders.push(newOrder);
    localStorage.setItem('myOrders', JSON.stringify(orders));
    
    alert(`Successfully bought ${productName}! Check your Orders page.`);
    closeModal('productModal');
}