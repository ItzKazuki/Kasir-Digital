<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | Preview Cart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">

    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Preview Cart</h1>
        <div id="cartContent" class="space-y-4">
            <p id="emptyCartMessage" class="text-gray-500 text-center">Cart Kosong</p>
        </div>
        <div class="mt-6 border-t pt-4">
            <p class="text-lg font-semibold">Total Belanja: <span id="totalBelanja" class="font-bold">Rp. 0</span></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchCart();
            setInterval(fetchCart, 2000); // Fetch every 2 seconds

            function fetchCart() {
                axios.get("{{ route('dashboard.kasir.cart.show') }}")
                    .then(resCart => {
                        const cartContent = document.getElementById('cartContent');
                        const totalBelanja = document.getElementById('totalBelanja');
                        const emptyCartMessage = document.getElementById('emptyCartMessage');

                        if (resCart.data.message === "Cart is empty") {
                            emptyCartMessage.style.display = 'block';
                            totalBelanja.textContent = 'Rp. 0';
                        } else {
                            emptyCartMessage.style.display = 'none';
                            cartContent.innerHTML = ''; // Clear existing content
                            totalBelanja.textContent = `Rp. ${resCart.data.subtotal.toLocaleString('id-ID')}`;

                            Object.values(resCart.data.cartItems).forEach(item => {
                                const cartItem = `
                        <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                        <div>
                            <p class="font-semibold">${item.name}</p>
                            <p class="text-sm text-gray-500">Qty: ${item.quantity}</p>
                        </div>
                        <p class="font-bold">Rp. ${(item.price * item.quantity).toLocaleString('id-ID')}</p>
                        </div>
                    `;
                                cartContent.insertAdjacentHTML('beforeend', cartItem);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching cart:', error);
                    });
            }
        });
    </script>

</body>

</html>
