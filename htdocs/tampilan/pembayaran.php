<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pembayaran - Rimberio Coffee</title>
  <link rel="stylesheet" href="style1.css" />
</head>
<body>
  <div class="navbar">
    <img src="gambar/logo1.png" alt="Logo" class="logo" />
    <h2>RIMBERIO COFFEE</h2>
    <div class="menu">
        <a href="beranda.php">Beranda</a>
        <a href="katalogmenu.php">Katalog</a>
        <a href="keranjang.php">Keranjang</a>
        <a href="pembayaran.php" class="active">Pembayaran</a>
        <a href="akun.php" >Akun</a>
    </div>
  </div>

  <div class="container1">
    <div class="section-title">PEMBAYARAN</div>
    <div id="order-summary"></div>
    <div class="total-box">
      <p class="total-container"></p>
    </div>

    <div class="payment-method">
      <div class="section-title">Metode Pembayaran</div>
      <label><input type="radio" name="payment" /> Transfer Bank</label><br/>
      <label><input type="radio" name="payment" /> COD (Bayar di Tempat)</label>
      <br><button class="button">Selesai</button><br/>
      <div id="payment-details" style="margin-top: 20px;"></div>
    </div>
  </div>

  <script>
    function renderOrderSummary() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const orderSummary = document.getElementById('order-summary');
      const totalContainer = document.querySelector('.total-container');

      orderSummary.innerHTML = '';

      if (cart.length === 0) {
        orderSummary.innerHTML = '<p>Keranjang Kosong!</p>';
        totalContainer.textContent = '';
        return;
      }

      let total = 0;

      cart.forEach(item => {
        const div = document.createElement('div');
        div.classList.add('box');
        div.innerHTML = `
          <h3>${item.name}</h3>
          <p>Harga: Rp. ${item.price.toLocaleString('id-ID')}</p>
          <p>Jumlah: ${item.quantity}</p>
        `;
        orderSummary.appendChild(div);
        total += item.price * item.quantity;
      });

      totalContainer.textContent = `Total Pembayaran: Rp. ${total.toLocaleString('id-ID')}`;
    }

  document.addEventListener('DOMContentLoaded', renderOrderSummary);

  const button = document.querySelector('.button');
  const paymentDetails = document.getElementById('payment-details');

  button.addEventListener('click', () => {
    const selected = document.querySelector('input[name="payment"]:checked');
    paymentDetails.innerHTML = '';

    if (!selected) {
      alert("Pilih metode pembayaran terlebih dahulu!");
      return;
    }

    if (selected.nextSibling.textContent.includes("Transfer")) {
      paymentDetails.innerHTML = `
        <h3>Transfer Bank</h3>
        <p>Silakan transfer ke rekening berikut:</p>
        <ul>
          <li>Bank: BCA</li>
          <li>Nomor Rekening: 1234567890</li>
          <li>Atas Nama: Rimberio Coffee</li>
        </ul>
        <label for="bukti">Unggah Bukti Transfer:</label><br/>
        <input type="file" id="bukti" name="bukti"><br/><br/>
        <button onclick="konfirmasiPembayaran()">Konfirmasi</button>
      `;
    } else {
      paymentDetails.innerHTML = `
        <h3>Pembayaran di Tempat (COD)</h3>
        <p>Pesanan Anda akan dibayar saat diterima.</p>
        <button onclick="konfirmasiPembayaran()">Konfirmasi</button>
      `;
    }
  });

  function konfirmasiPembayaran() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (cart.length === 0) {
      alert("Keranjang kosong, tidak bisa memproses pembayaran.");
      return;
    }

    fetch('proses_pembayaran.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ cart: cart })
    })
    .then(response => response.text())
    .then(data => {
      console.log("Response dari server:", data);
      try {
        const json = JSON.parse(data);
      if (data.status === 'success') {
        alert("Terima kasih! Pesanan Anda telah dikonfirmasi.");
        localStorage.removeItem('cart');
        window.location.href = "Beranda.php";
      } else {
        alert("Gagal menyimpan transaksi.");
      }
    } catch (e) {
      alert("Terima kasih! Pesanan Anda telah dikonfirmasi.");
    }
    })
    .catch(error => {
      console.error('Error:', error);
      alert("Terjadi kesalahan saat memproses pembayaran.");
    });
  }
  </script>
</body>
</html>