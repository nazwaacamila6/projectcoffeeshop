<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Keranjang - Rimberio Coffee</title>
  <link rel="stylesheet" href="style1.css" />
</head>
<body>
  <div class="navbar">
    <img src="gambar/logo1.png" alt="Logo" class="logo" />
    <h2>RIMBERIO COFFEE</h2>
    <div class="menu">
        <a href="beranda.php">Beranda</a>
        <a href="katalogmenu.php">Katalog</a>
        <a href="keranjang.php" class="active">Keranjang</a>
        <a href="pembayaran.php">Pembayaran</a>
        <a href="akun.php">Akun</a>
    </div>
  </div>

  <div class="container1">
    <div class="header">Keranjang Anda</div>
    <div id="cart-items"></div>
    <div id="cart-empty" style="display: none;"><p>Keranjang kosong!</p></div>
    <button class="buy-button" onclick="window.location.href='pembayaran.php'">Lanjut ke Pembayaran</button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', renderCart);

    function renderCart() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const cartItemsContainer = document.getElementById('cart-items');

      cartItemsContainer.innerHTML = '';

      if (cart.length === 0) {
        document.getElementById('cart-empty').style.display = 'block';
        return;
      }

      cart.forEach((item, index) => {
        const div = document.createElement('div');
        div.classList.add('cart-item');
        div.innerHTML = `
          <div class="cart-info">
            <input type="checkbox" checked disabled />
            <div>
              <div class="item-name">${item.name}</div>
              <div class="item-price">Rp. ${item.price.toLocaleString('id-ID')}</div>
            </div>
          </div>
          <div class="quantity">
            <button class="minus-btn" data-index="${index}">-</button>
            <span>${item.quantity}</span>
            <button class="plus-btn" data-index="${index}">+</button>
          </div>
        `;
        cartItemsContainer.appendChild(div);
      });

      setupQuantityButtons();
    }

    function setupQuantityButtons() {
      document.querySelectorAll('.minus-btn').forEach(button => {
        button.addEventListener('click', () => {
          const index = button.dataset.index;
          updateQuantity(index, -1);
        });
      });
      document.querySelectorAll('.plus-btn').forEach(button => {
        button.addEventListener('click', () => {
          const index = button.dataset.index;
          updateQuantity(index,  1);
        });
      });
    }

    function updateQuantity(index, change) {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      cart[index].quantity += change;

      if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
      }

      localStorage.setItem('cart', JSON.stringify(cart));
      renderCart();
    }
  </script>
</body>
</html>
