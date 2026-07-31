// template/js/build_package.js

let currentPromoPercent = 0;

function updateLivePriceAndValidate() {
    let baseTotal = 0;
    
    // 1. Tính tổng tiền gốc
    document.querySelectorAll('.custom-select').forEach(select => {
        let selectedOption = select.options[select.selectedIndex];
        baseTotal += parseFloat(selectedOption.getAttribute('data-price'));
    });

    // 2. Tính tiền giảm giá (nếu có mã)
    let promoDiscount = baseTotal * (currentPromoPercent / 100);
    let finalTotal = baseTotal - promoDiscount;
    if (finalTotal < 0) finalTotal = 0;

    // 3. Hiển thị lên màn hình
    document.getElementById('display_base_price').innerText = '£' + baseTotal.toFixed(2);
    document.getElementById('live_price').innerText = '£' + finalTotal.toFixed(2);

    const promoRow = document.getElementById('promo_row');
    if (currentPromoPercent > 0 && baseTotal > 0) {
        promoRow.style.display = 'flex';
        document.getElementById('display_promo_discount').innerText = '- £' + promoDiscount.toFixed(2);
    } else {
        promoRow.style.display = 'none';
    }

    // 4. Chống "lách luật" (Validation)
    let device = document.querySelector('select[name="device"]').value;
    let data = document.querySelector('select[name="data"]').value;
    
    let btn = document.getElementById('add_custom_btn');
    let warning = document.getElementById('js_warning');
    
    let isValid = true;
    let warningMsg = '';

    if (['Google Pixel 7', 'iPhone 15 Pro'].includes(device)) {
        if (['No Data', '2GB', '5GB'].includes(data)) {
            isValid = false;
            warningMsg = 'Premium devices require at least a 10GB Data plan. Please upgrade your data.';
        }
    }

    if (device === 'Nokia 3310 (Basic)' && data !== 'No Data') {
        isValid = false;
        warningMsg = 'The Nokia 3310 does not support internet connectivity. Please select "No Data".';
    }

    if (!isValid) {
        warning.innerText = warningMsg;
        warning.style.display = 'block';
        btn.disabled = true;
        btn.style.backgroundColor = '#6c757d'; 
        btn.style.cursor = 'not-allowed';
        btn.innerText = 'Invalid Combination';
    } else {
        warning.style.display = 'none';
        btn.disabled = false;
        btn.style.backgroundColor = '#28a745'; 
        btn.style.cursor = 'pointer';
        btn.innerText = 'Add Custom Package to Cart';
    }
}

// Hàm gọi API kiểm tra mã giảm giá
async function applyPromoPreview() {
    const promoInput = document.getElementById('promo_input');
    const code = promoInput ? promoInput.value.trim() : '';
    const msgDiv = document.getElementById('promo_message');
    
    if (!msgDiv) return;

    if (!code) {
        msgDiv.innerHTML = '<span style="color: #dc3545;">Please enter a promo code.</span>';
        currentPromoPercent = 0;
        updateLivePriceAndValidate();
        return;
    }

    msgDiv.innerHTML = '<span style="color: #666;">Checking code...</span>';

    try {
        const response = await fetch('check_promo.php?code=' + encodeURIComponent(code));
        const data = await response.json();

        if (data.success) {
            currentPromoPercent = data.discount_percent;
            document.getElementById('promo_label').innerText = data.discount_percent + '%';
            msgDiv.innerHTML = '<span style="color: #28a745;">✔ ' + data.message + '</span>';
        } else {
            currentPromoPercent = 0;
            msgDiv.innerHTML = '<span style="color: #dc3545;">✖ ' + data.message + '</span>';
        }
        
        updateLivePriceAndValidate();
        
    } catch (error) {
        msgDiv.innerHTML = '<span style="color: #dc3545;">System error. Please try again later.</span>';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Lắng nghe thay đổi dropdown
    document.querySelectorAll('.custom-select').forEach(select => {
        select.addEventListener('change', updateLivePriceAndValidate);
    });

    // Lắng nghe nút Apply Promo
    const applyBtn = document.getElementById('apply_promo_btn');
    if (applyBtn) {
        applyBtn.addEventListener('click', applyPromoPreview);
    }

    // Lắng nghe phím Enter trong ô nhập mã
    const promoInput = document.getElementById('promo_input');
    if (promoInput) {
        promoInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); 
                applyPromoPreview();
            }
        });
    }

    updateLivePriceAndValidate();
});