#  🍽 MakanApaYa – Sistem Review & Voting Kantin Kampus


## 📌 Deskripsi
MakanApaYa adalah aplikasi berbasis web yang membantu mahasiswa memilih makanan terbaik di kantin kampus melalui sistem review dan voting yang interaktif.
Dengan aplikasi ini, pengguna dapat memberikan ulasan, rating, dan mendapatkan rekomendasi kuliner favorit di sekitar kampus.

- `tampilan dashboard`
- <img width="1438" alt="Screenshot 2025-06-14 at 13 08 24" src="https://github.com/user-attachments/assets/363a0ce8-120a-4d8a-ae80-71a48a9563b0" />
- <img width="1427" alt="Screenshot 2025-06-14 at 13 11 19" src="https://github.com/user-attachments/assets/017d0fa9-7898-42f1-91a2-c859da74204d" />


- `tampilan tenant`
- <img width="1425" alt="Screenshot 2025-06-14 at 12 33 21" src="https://github.com/user-attachments/assets/4aff7e4c-6efa-46be-b96f-ceb26955204d" />



## ✨ Fitur Utama
- 🔐 Login user & manajemen session
- 🗳️ Voting menu terenak per minggu (1x per user per minggu)
- 🧾 Daftar voter minggu ini
- 🌐 UI responsif dengan Tailwind CSS
- 🧠 Validasi user sudah voting atau belum berdasarkan mingguan
-  💬 Review dan komentar pengguna

## 🛠️ Teknologi

- **PHP Native**
- **MySQL**
- **Tailwind CSS**
- **Chart.js**
- **XAMPP / phpMyAdmin**

## 🗃️ Struktur Database

- `users` – Data pengguna
- `menus` – Data menu makanan
- `tenant_kantin` – Data tenant
- `voting` – Data voting mingguan
- `reviews` – Komentar makanan
- `rangking` - Data rating  menu harian dan mingguan
- `location_log` - Data untuk nonaktifkan review berdasarkan lokasi (trigger)


## ⚠️ Disclaimer

Peran stored procedure, trigger, transaction, dan stored function dalam proyek ini dirancang khusus untuk kebutuhan sistem MakanApaYa. Penerapannya bisa berbeda pada sistem lain, tergantung arsitektur dan kebutuhan masing-masing sistem.

## 🧠 Stored Procedure
<img width="744" alt="Screenshot 2025-06-14 at 12 57 35" src="https://github.com/user-attachments/assets/bfba11ca-b213-4eaa-b48c-a6bdc735673b" />

## 🚨 Trigger
<img width="766" alt="Screenshot 2025-06-14 at 12 58 15" src="https://github.com/user-attachments/assets/28bd37f5-02f6-432d-9588-1efea3b7640f" />

## 📺 Stored Function
<img width="642" alt="Screenshot 2025-06-14 at 13 00 25" src="https://github.com/user-attachments/assets/d5dc78e6-b99e-43b6-aa14-4b62f3db1ec1" />

## 🔄 Transaction (Transaksi)

$msg = '';
$showStats = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $menu_id = intval($_POST['menu_id']);

  mysqli_begin_transaction($conn);

  try {
    $cek_vote = mysqli_query($conn,
      "SELECT * FROM voting 
       WHERE user_id = $user_id AND minggu_ke = $minggu AND tahun = $tahun");

    if (!$cek_vote) {
      throw new Exception("Gagal mengecek data voting.");
    }

    if (mysqli_num_rows($cek_vote) === 0) {
      $insert = mysqli_query($conn,
        "INSERT INTO voting (user_id, menu_id, minggu_ke, tahun)
         VALUES ($user_id, $menu_id, $minggu, $tahun)");

      if (!$insert) {
        throw new Exception("Gagal menyimpan data voting.");
      }

      mysqli_commit($conn);
      $msg = "Terima kasih! Suara kamu telah tercatat.";
    } else {
      mysqli_rollback($conn);
      $msg = "Kamu sudah voting minggu ini! Tunggu minggu depan ya 🍽";
    }

  } catch (Exception $e) {
    mysqli_rollback($conn);
    $msg = "Terjadi kesalahan: " . $e->getMessage();
  }

  $showStats = true;
}

## 🔄 Backup Otomatis
<img width="1431" alt="Screenshot 2025-06-14 at 13 10 10" src="https://github.com/user-attachments/assets/263c0d02-dab2-4aee-8511-2fad057fb8f8" />






