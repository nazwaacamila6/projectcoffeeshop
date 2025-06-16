<?php
    require_once "../koneksi.php";
    require_once "../query/pengguna.php";
    session_start();

    if (!isset($_SESSION['idPengguna'])) {
        header("Location: login.php");
        exit();
    }
    
    $db = (new Database())->connection();
    $pengguna = new pengguna($db);

    if(isset($_GET['delete'])) {
        $pengguna->idPengguna = $_GET['delete'];
        $pengguna->delete();
        header("location:akun.php");
        exit;
    }

    $data = $pengguna->readById($_SESSION['idPengguna']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIMBERIO COFFEE</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #f3d59b;
            padding: 20px;
            border-radius: 10px;
        }
        .profile-header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        form label {
            display: block;
            margin-top: 10px;
            font-weight: 600;
        }
        form input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background-color: white;
            margin-bottom: 10px;
        }
        form input:read-only {
            background-color: white;
            cursor: not-allowed;
        }
        .edit-link {
            display: inline-block;
            margin-bottom: 15px;
            color: purple;
            font-weight: bold;
            text-decoration: none;
        }
        .edit-link:hover {
            text-decoration: underline;
        }
    </style>
</head>    
<body>
    <nav class="navbar">
        <div class="brand">
            <img src="gambar/logoo.png" alt="Logo coffeshop" class="logo">
            <div class="name">RIMBERIO COFFEE</div>
        </div>
         <div class="menu">
            <a href="beranda.php" >Beranda</a>
            <a href="katalogmenu.php">Katalog</a>
            <a href="keranjang.php">Keranjang</a>
            <a href="pembayaran.php">Pembayaran</a>
            <a href="akun.php" class="active">Akun</a>
        </div>
    </nav>

        <main class="content">
                <h1 style="text-align : center; margin-left: 15px"> AKUN </h1>
            <section>
                  <div class ="profile-container">
                    <?php if ($row = $data->fetch(PDO::FETCH_ASSOC)) : ?>
                            <a href="daftar.php?edit=<?php echo $row['idPengguna']; ?>" class="edit-link"> ✏Edit </a>
              <form>
                <label>Nama Pengguna</label>
                <input type="text" value="<?= htmlspecialchars($row['namaPengguna']); ?>" readonly>

                <label>Email</label>
                <input type="text" value="<?= htmlspecialchars($row['emailPengguna']); ?>" readonly>

                <label>Member</label>
                <input type="text" value="<?= htmlspecialchars($row['memberPengguna']); ?>" readonly>

                <label>No.Hp</label>
                <input type="text" value="<?= htmlspecialchars($row['nomor']); ?>" readonly>

                <label>Nama Lengkap</label>
                <input type="text" value="<?= htmlspecialchars($row['nama']); ?>" readonly>

                <div class="profile-buttons">
                    <a href="logout.php"><button type="button" class="logout">Logout</button></a>
                </div>
              </form>  
                <?php else: ?>
                    <p>Data tidak ditemukan.</p>
                <?php endif; ?>
                </div>
            </section>
        </main>
</body>
</html>