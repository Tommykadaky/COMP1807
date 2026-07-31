// template/js/global.js

// SCRIPT GIỮ VỊ TRÍ CUỘN TRANG (CHỐNG VĂNG LÊN ĐẦU)
document.addEventListener("DOMContentLoaded", function() {
    // 1. Kiểm tra xem có lưu vị trí cuộn cũ không
    let scrollpos = sessionStorage.getItem('scrollpos');
    if (scrollpos) {
        // Tự động cuộn mượt mà về vị trí cũ
        window.scrollTo({
            top: scrollpos,
            behavior: 'instant' 
        });
        // Xóa đi để tránh ảnh hưởng khi bấm menu chuyển trang khác
        sessionStorage.removeItem('scrollpos');
    }
});

// 2. Bắt sự kiện mỗi khi rời khỏi trang (vd: bấm nút submit form)
window.addEventListener("beforeunload", function (e) {
    sessionStorage.setItem('scrollpos', window.scrollY);
});