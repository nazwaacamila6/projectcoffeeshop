<?php
session_start();
require_once "../koneksi.php";

$db = (new Database())->connection();

$error = "";
$sukses = "";

// Atur langkah awal jika belum ada
$step = $_POST['step'] ?? $_SESSION['step'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step == 1) {
        $emailPengguna = $_POST['emailPengguna'];
        $stmt = $db->prepare("SELECT * FROM tpengguna WHERE emailPengguna = ?");
        $stmt->execute([$emailPengguna]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['otp_email'] = $emailPengguna;
            $_SESSION['otp_code'] = rand(100000, 999999);
            $_SESSION['step'] = 2;
            $sukses = "Kode OTP Anda: <b>{$_SESSION['otp_code']}</b>"; // Ganti nanti dengan email
        } else {
            $error = "Email tidak ditemukan!";
        }

    } elseif ($step == 2) {
        $otp_input = $_POST['otp'];
        if ($otp_input == $_SESSION['otp_code']) {
            $_SESSION['step'] = 3;
            $sukses = "OTP berhasil diverifikasi!";
        } else {
            $error = "OTP salah. Coba lagi!";
        }

    } elseif ($step === '3') {
        $pw = $_POST['pw'];
        $conf = $_POST['konfirmasi'];

        if ($pw !== $conf) {
            $error = "Konfirmasi sandi tidak cocok.";
        } else {
            $stmt = $db->prepare("UPDATE tpengguna SET pw = ? WHERE emailPengguna = ?");
            $stmt->execute([$pw, $_SESSION['otp_email']]);

            $sukses = "Password berhasil diubah. Silakan login kembali.";
            session_destroy();
            header("Location: login.php");
            exit;
        }
    }
}

$currentStep = $_SESSION['step'] ?? 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password - Rimberio</title>
  <link rel="gambar" href="../gambar/logo1.png" sizes="16x16">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: rgb(235, 207, 153);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .main-container {
        width: 400px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .logo {
        text-align: center;
        margin-bottom: 20px;
    }
    .logo img {
        width: 50px;
    }
    .logo h1 {
        margin: 10px 0;
        font-size: 24px;
        color: #8b4513;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }
    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-group input {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #8b4513;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
    button:hover {
        background-color: #5a2d0c;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
    .sukses {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="logo">

      <h1>RIMBERIO</h1>
    </div>

    <h2 style="text-align:center;">Lupa Password</h2>

    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($sukses): ?>
      <div class="sukses"><?= $sukses ?></div>
    <?php endif; ?>

    <?php if ($currentStep == 1): ?>
      <form method="post">
        <input type="hidden" name="step" value="1">
        <div class="form-group">
          <label for="emailPengguna">Email</label>
          <input type="email" name="emailPengguna" required>
        </div>
        <button type="submit">Kirim OTP</button>
      </form>

    <?php elseif ($currentStep == 2): ?>
      <form method="post">
        <input type="hidden" name="step" value="2">
        <div class="form-group">
          <label for="otp">Masukkan Kode OTP</label>
          <input type="text" name="otp" maxlength="6" required>
        </div>
        <button type="submit">Verifikasi</button>
      </form>

    <?php elseif ($currentStep == 3): ?>
      <form method="post">
        <input type="hidden" name="step" value="3">
        <div class="form-group">
          <label for="pw">Password Baru</label>
          <input type="password" name="pw" required>
        </div>
        <div class="form-group">
          <label for="konfirmasi">Konfirmasi Password</label>
          <input type="password" name="konfirmasi" required>
        </div>
        <button type="submit">Simpan Password</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
<?php
session_start();
require_once "../koneksi.php";

$db = (new Database())->connection();

$error = "";
$sukses = "";

// Atur langkah awal jika belum ada
$step = $_POST['step'] ?? $_SESSION['step'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step == 1) {
        $emailPengguna = $_POST['emailPengguna'];
        $stmt = $db->prepare("SELECT * FROM tpengguna WHERE emailPengguna = ?");
        $stmt->execute([$emailPengguna]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['otp_email'] = $emailPengguna;
            $_SESSION['otp_code'] = rand(100000, 999999);
            $_SESSION['step'] = 2;
            $sukses = "Kode OTP Anda: <b>{$_SESSION['otp_code']}</b>"; // Ganti nanti dengan email
        } else {
            $error = "Email tidak ditemukan!";
        }

    } elseif ($step == 2) {
        $otp_input = $_POST['otp'];
        if ($otp_input == $_SESSION['otp_code']) {
            $_SESSION['step'] = 3;
            $sukses = "OTP berhasil diverifikasi!";
        } else {
            $error = "OTP salah. Coba lagi!";
        }

    } elseif ($step === '3') {
        $pw = $_POST['pw'];
        $conf = $_POST['konfirmasi'];

        if ($pw !== $conf) {
            $error = "Konfirmasi sandi tidak cocok.";
        } else {
            $stmt = $db->prepare("UPDATE tpengguna SET pw = ? WHERE emailPengguna = ?");
            $stmt->execute([$pw, $_SESSION['otp_email']]);

            $sukses = "Password berhasil diubah. Silakan login kembali.";
            session_destroy();
            header("Location: login.php");
            exit;
        }
    }
}

$currentStep = $_SESSION['step'] ?? 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password - Rimberio</title>
  <link rel="gambar" href="../gambar/logo1.png" sizes="16x16">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: rgb(235, 207, 153);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .main-container {
        width: 400px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .logo {
        text-align: center;
        margin-bottom: 20px;
    }
    .logo img {
        width: 50px;
    }
    .logo h1 {
        margin: 10px 0;
        font-size: 24px;
        color: #8b4513;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }
    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-group input {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #8b4513;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
    button:hover {
        background-color: #5a2d0c;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
    .sukses {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="logo">

      <h1>RIMBERIO</h1>
    </div>

    <h2 style="text-align:center;">Lupa Password</h2>

    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($sukses): ?>
      <div class="sukses"><?= $sukses ?></div>
    <?php endif; ?>

    <?php if ($currentStep == 1): ?>
      <form method="post">
        <input type="hidden" name="step" value="1">
        <div class="form-group">
          <label for="emailPengguna">Email</label>
          <input type="email" name="emailPengguna" required>
        </div>
        <button type="submit">Kirim OTP</button>
      </form>

    <?php elseif ($currentStep == 2): ?>
      <form method="post">
        <input type="hidden" name="step" value="2">
        <div class="form-group">
          <label for="otp">Masukkan Kode OTP</label>
          <input type="text" name="otp" maxlength="6" required>
        </div>
        <button type="submit">Verifikasi</button>
      </form>

    <?php elseif ($currentStep == 3): ?>
      <form method="post">
        <input type="hidden" name="step" value="3">
        <div class="form-group">
          <label for="pw">Password Baru</label>
          <input type="password" name="pw" required>
        </div>
        <div class="form-group">
          <label for="konfirmasi">Konfirmasi Password</label>
          <input type="password" name="konfirmasi" required>
        </div>
        <button type="submit">Simpan Password</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
