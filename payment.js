(function() {
    'use strict';
    
    window.addEventListener('load', function() {
        const productNameFromSession = sessionStorage.getItem('productName');
        const productPriceFromSession = sessionStorage.getItem('productPrice');

        const elProductName = document.getElementById('sidebarProduct');
        const elProductPrice = document.getElementById('sidebarPrice');
        const elTotalPrice = document.getElementById('sidebarTotal');
        const hiddenName = document.getElementById('hiddenProductName');
        const hiddenPrice = document.getElementById('hiddenProductPrice');

        let productName = productNameFromSession || (hiddenName ? hiddenName.value : '');
        let productPrice = productPriceFromSession || (hiddenPrice ? hiddenPrice.value : '');
        productPrice = productPrice ? parseInt(productPrice, 10) : 0;

        if (!productName || !productPrice) {
            alert('No product selected. Redirecting to store...');
            window.location.href = 'merchandise.php';
            return;
        }
        
        function formatRupiah(amount) {
            return 'Rp ' + parseInt(amount, 10).toLocaleString('id-ID');
        }

        if (elProductName) elProductName.textContent = productName;
        if (elProductPrice) elProductPrice.textContent = formatRupiah(productPrice);
        const shippingCost = 15000;
        const total = productPrice + shippingCost;
        if (elTotalPrice) elTotalPrice.textContent = formatRupiah(total);

        if (hiddenName) hiddenName.value = productName;
        if (hiddenPrice) hiddenPrice.value = productPrice;

        loadSavedAddress();
    });

    function loadSavedAddress() {
        const savedAddress = localStorage.getItem('savedAddress');
        if (!savedAddress) return;
        try {
            const addressData = JSON.parse(savedAddress);
            const displayText = `${addressData.address}, ${addressData.city}, ${addressData.province} ${addressData.postalCode}`;
            const displayEl = document.getElementById('displayAddress');
            if (displayEl) displayEl.textContent = displayText;

            document.getElementById('address').value = addressData.address || '';
            document.getElementById('city').value = addressData.city || '';
            document.getElementById('province').value = addressData.province || '';
            document.getElementById('postalCode').value = addressData.postalCode || '';
        } catch (err) {
            console.error('Saved address parsing error', err);
        }
    }

    window.toggleAddressForm = function() {
        const checkbox = document.getElementById('useSavedAddress');
        const savedAddressDisplay = document.getElementById('savedAddressDisplay');
        const addressFormFields = document.getElementById('addressFormFields');
        const savedAddress = localStorage.getItem('savedAddress');

        if (checkbox.checked && savedAddress) {
            savedAddressDisplay.style.display = 'block';
            addressFormFields.style.display = 'none';
            const inputs = addressFormFields.querySelectorAll('input, textarea');
            inputs.forEach(input => input.removeAttribute('required'));
        } else {
            savedAddressDisplay.style.display = 'none';
            addressFormFields.style.display = 'block';
            document.getElementById('address').setAttribute('required', '');
            document.getElementById('city').setAttribute('required', '');
            document.getElementById('province').setAttribute('required', '');
            document.getElementById('postalCode').setAttribute('required', '');
            if (!savedAddress) checkbox.checked = false;
        }
    };

    const paymentForm = document.getElementById('paymentForm');

    if (paymentForm) {
        paymentForm.addEventListener('submit', async function(e) {
            e.preventDefault(); 

            const hiddenName = document.getElementById('hiddenProductName');
            const hiddenPrice = document.getElementById('hiddenProductPrice');
            const sessionName = sessionStorage.getItem('productName');
            const sessionPrice = sessionStorage.getItem('productPrice');

            if (hiddenName && sessionName) hiddenName.value = sessionName;
            if (hiddenPrice && sessionPrice) hiddenPrice.value = sessionPrice;

            const formData = new FormData(paymentForm);

            try {
            
                const response = await fetch("process_payment.php", {
                    method: "POST",
                    body: formData
                });

                const result = await response.text();
                console.log("Server response:", result);

                // Notif sukses
                showPaymentNotification("✅ Payment Success! Order has been saved.", "success");

                // Clear product data
                sessionStorage.removeItem('productName');
                sessionStorage.removeItem('productPrice');

            } catch (err) {
                console.error("AJAX error:", err);
                showPaymentNotification("❌ Payment failed! Try again.", "error");
            }
        });
    }

    //   PAYMENT NOTIFICATION BANNER
    function showPaymentNotification(message, type) {
        const oldNotif = document.querySelector('.notification-banner');
        if (oldNotif) oldNotif.remove();

        const notif = document.createElement('div');
        notif.className = 'notification-banner';
        notif.innerHTML = message;

        Object.assign(notif.style, {
            position: 'fixed',
            top: '0',
            left: '0',
            right: '0',
            width: '100%',
            padding: '18px',
            textAlign: 'center',
            fontSize: '18px',
            fontWeight: 'bold',
            color: 'white',
            zIndex: '999999',
            boxShadow: '0 2px 10px rgba(0,0,0,0.3)',
            transform: 'translateY(-100%)',
            transition: 'transform 0.4s ease-out'
        });

        notif.style.backgroundColor = type === 'success' ? '#aeffa1ff' : '#e74c3c';
        document.body.appendChild(notif);

        setTimeout(() => notif.style.transform = 'translateY(0)', 10);

        setTimeout(() => {
            notif.style.transform = 'translateY(-100%)';
            setTimeout(() => notif.remove(), 500);
        }, 2500);
    }

})();
