// Hàm mở bảng Modal cho các chức năng cài đặt
function openSettingModal(settingType) {
    // Xóa modal cũ nếu đang mở
    const existingModal = document.getElementById('settingModal');
    if (existingModal) existingModal.remove();

    let modalContent = '';

    // Tùy theo mục được bấm mà hiển thị nội dung khác nhau
    if (settingType === 'Account Settings') {
        modalContent = `
            <div style="text-align: left; margin-bottom: 1rem;">
                <label style="font-size: 0.8rem; color: #6b7280;">Full Name</label>
                <input type="text" value="Huynh Minh Tam" style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.25rem; outline: none;">
                
                <label style="font-size: 0.8rem; color: #6b7280;">Email</label>
                <input type="email" value="tam.huynh@email.com" style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.25rem; outline: none;">
            </div>
            <button onclick="closeModal('settingModal')" style="width: 100%; padding: 0.75rem; background-color: #2563eb; color: white; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer;">Save Changes</button>
        `;
    } 
    else if (settingType === 'Payment Methods') {
        modalContent = `
            <div style="text-align: left; margin-bottom: 1rem;">
                <div style="padding: 1rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; margin-bottom: 0.5rem; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.9rem;">💳 Visa ending in 4242</span>
                    <span style="color: #ef4444; font-size: 0.8rem; cursor: pointer;">Remove</span>
                </div>
                <button style="width: 100%; padding: 0.75rem; border: 1px dashed #9ca3af; background: none; color: #6b7280; border-radius: 0.5rem; cursor: pointer;">+ Add New Card</button>
            </div>
        `;
    } 
    else if (settingType === 'Notifications') {
        modalContent = `
            <div style="text-align: left; margin-bottom: 1rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; align-items: center;">
                    <span style="font-size: 0.9rem;">Order Updates</span>
                    <input type="checkbox" checked style="transform: scale(1.2);">
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; align-items: center;">
                    <span style="font-size: 0.9rem;">Promotions & Offers</span>
                    <input type="checkbox" style="transform: scale(1.2);">
                </div>
            </div>
        `;
    } 
    else if (settingType === 'Help & Support') {
        modalContent = `
            <div style="text-align: center; margin-bottom: 1rem;">
                <p style="font-size: 0.9rem; color: #374151; margin-bottom: 0.5rem;">Need help? Contact us:</p>
                <p style="font-size: 0.9rem; color: #2563eb; margin-bottom: 0.25rem;">📧 support@eshop.com</p>
                <p style="font-size: 0.9rem; color: #2563eb;">📞 1900 1234 56</p>
            </div>
        `;
    }

    // Tạo khung Modal
    const modal = document.createElement('div');
    modal.id = 'settingModal';
    modal.style.cssText = `
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.5); display: flex; align-items: center;
        justify-content: center; z-index: 1000;
    `;

    // Lắp ghép nội dung vào khung
    modal.innerHTML = `
        <div style="background: white; padding: 1.5rem; border-radius: 1rem; width: 90%; max-width: 20rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 1.25rem; font-size: 1.1rem; color: #1f2937;">${settingType}</h3>
            ${modalContent}
            <button onclick="closeModal('settingModal')" style="width: 100%; padding: 0.5rem; margin-top: 0.75rem; background: none; color: #6b7280; border: none; cursor: pointer;">Cancel</button>
        </div>
    `;

    document.body.appendChild(modal);
}

// Hàm đóng Modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.remove();
}

// Logic Đăng xuất
function logoutUser() {
    // Hỏi xác nhận trước khi đăng xuất
    if(confirm("Are you sure you want to log out?")) {
        
        // Xóa dữ liệu Giỏ hàng và Đơn hàng khỏi trình duyệt khi đăng xuất
        localStorage.removeItem('myCart');
        localStorage.removeItem('myOrders');
        
        alert("Logged out successfully!");
        
        // Chuyển hướng người dùng về trang login
        window.location.href = "login.html"; 
    }
}