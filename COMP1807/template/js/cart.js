// template/js/cart.js

let currentPromoPercent = 0;
const APP_DISCOUNT_PERCENT = 15; // Giảm giá mặc định 15% (US-19)

// Hàm tính tiền live trên giao diện
function calculateLiveTotal() {
    let subtotal = 0;
    let hasSelectedItem = false;
    
    // Quét các checkbox được chọn
    document.querySelectorAll('.item-checkbox:checked').forEach(cb => {
        subtotal += parseFloat(cb.getAttribute('data-price'));
        hasSelectedItem = true;
    });

    // Cập nhật trạng thái nút Checkout
    const checkoutBtn = document.getElementById('checkout_btn');
    if (checkoutBtn) {
        if (!hasSelectedItem) {
            checkoutBtn.disabled = true;
            checkoutBtn.style.backgroundColor = '#ccc';
            checkoutBtn.style.cursor = 'not-allowed';
        } else {
            checkoutBtn.disabled = false;
            checkoutBtn.style.backgroundColor = '#cc0000';
            checkoutBtn.style.cursor = 'pointer';
        }
    }

    // Tính toán các khoản giảm giá
    const appDiscount = subtotal * (APP_DISCOUNT_PERCENT / 100);
    const promoDiscount = subtotal * (currentPromoPercent / 100);
    
    let finalTotal = subtotal - appDiscount - promoDiscount;
    if (finalTotal < 0) finalTotal = 0;

    // Gắn giá trị lên HTML
    const displaySubtotal = document.getElementById('display_subtotal');
    const displayAppDiscount = document.getElementById('display_app_discount');
    const displayFinalTotal = document.getElementById('display_final_total');
    const promoRow = document.getElementById('promo_row');
    const displayPromoDiscount = document.getElementById('display_promo_discount');

    if (displaySubtotal) displaySubtotal.innerText = '£' + subtotal.toFixed(2);
    if (displayAppDiscount) displayAppDiscount.innerText = '- £' + appDiscount.toFixed(2);
    if (displayFinalTotal) displayFinalTotal.innerText = '£' + finalTotal.toFixed(2);

    if (promoRow && displayPromoDiscount) {
        if (currentPromoPercent > 0 && subtotal > 0) {
            promoRow.style.display = 'flex';
            displayPromoDiscount.innerText = '- £' + promoDiscount.toFixed(2);
        } else {
            promoRow.style.display = 'none';
        }
    }
}

// Hàm gửi API gọi file check_promo.php
async function applyPromo() {
    const promoInput = document.getElementById('promo_input');
    const code = promoInput ? promoInput.value.trim() : '';
    const msgDiv = document.getElementById('promo_message');
    
    if (!msgDiv) return;

    if (!code) {
        msgDiv.innerHTML = '<span style="color: #dc3545;">Please enter a promo code.</span>';
        currentPromoPercent = 0;
        calculateLiveTotal();
        return;
    }

    msgDiv.innerHTML = '<span style="color: #666;">Checking code...</span>';

    try {
        const response = await fetch('check_promo.php?code=' + encodeURIComponent(code));
        const data = await response.json();

        if (data.success) {
            currentPromoPercent = data.discount_percent;
            const promoLabel = document.getElementById('promo_label');
            if (promoLabel) promoLabel.innerText = data.discount_percent + '%';
            msgDiv.innerHTML = '<span style="color: #28a745;">✔ ' + data.message + '</span>';
        } else {
            currentPromoPercent = 0;
            msgDiv.innerHTML = '<span style="color: #dc3545;">✖ ' + data.message + '</span>';
        }
        
        calculateLiveTotal();
        
    } catch (error) {
        msgDiv.innerHTML = '<span style="color: #dc3545;">System error checking promo. Please try again later.</span>';
    }
}

// Khởi chạy các Event Listener sau khi web load xong HTML
document.addEventListener('DOMContentLoaded', () => {
    
    // Gắn sự kiện click cho các ô checkbox tính tiền
    document.querySelectorAll('.item-checkbox').forEach(cb => {
        cb.addEventListener('change', calculateLiveTotal);
    });

    // Gắn sự kiện cho nút bấm Apply Promo Code
    const applyBtn = document.getElementById('apply_promo_btn');
    if (applyBtn) {
        applyBtn.addEventListener('click', applyPromo);
    }

    // Gắn sự kiện Enter trong ô nhập mã cũng kích hoạt nút Apply
    const promoInput = document.getElementById('promo_input');
    if (promoInput) {
        promoInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Ngăn chặn form checkout tự động submit
                applyPromo();
            }
        });
    }

    // Chạy hàm tính tiền lần đầu tiên
    calculateLiveTotal();
});