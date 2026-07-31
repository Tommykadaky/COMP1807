// template/js/register.js
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form[action="register.php"]');
    
    if (form) {
        form.addEventListener('submit', function(event) {
            const phoneInput = document.querySelector('input[name="phone"]').value.trim();
            const creditCardInput = document.querySelector('input[name="credit_card"]').value.replace(/\s+/g, '');
            
            let isValid = true;
            let errorMsg = "";

            // 1. Kiểm tra số điện thoại UK (Bắt đầu bằng 07, tổng cộng 11 số)
            const phoneRegex = /^07\d{9}$/;
            if (!phoneRegex.test(phoneInput)) {
                isValid = false;
                errorMsg += "- Phone number must be a valid UK mobile (11 digits, starts with 07).\n";
            }

            // 2. Kiểm tra thẻ tín dụng (Đúng 16 số và qua được bài test Luhn)
            const ccRegex = /^\d{16}$/;
            if (!ccRegex.test(creditCardInput)) {
                isValid = false;
                errorMsg += "- Credit card must be exactly 16 digits.\n";
            } else if (!luhnCheck(creditCardInput)) {
                isValid = false;
                errorMsg += "- Invalid credit card number (failed checksum verification).\n";
            }

            // Nếu có lỗi thì chặn không cho form chạy và báo lỗi
            if (!isValid) {
                event.preventDefault(); 
                alert("Please fix the following errors:\n\n" + errorMsg);
            }
        });
    }

    // Hàm thuật toán Luhn để check thẻ tín dụng thật/giả
    function luhnCheck(cardNumber) {
        let sum = 0;
        let shouldDouble = false;

        // Chạy ngược từ số cuối cùng lên đầu
        for (let i = cardNumber.length - 1; i >= 0; i--) {
            let digit = parseInt(cardNumber.charAt(i));

            if (shouldDouble) {
                if ((digit *= 2) > 9) digit -= 9;
            }

            sum += digit;
            shouldDouble = !shouldDouble;
        }
        return (sum % 10) === 0;
    }
});