#  🍽 MakanApaYa – Sistem Review & Voting Kantin Kampus


## 📌 Deskripsi
MakanApaYa adalah aplikasi berbasis web yang membantu mahasiswa memilih makanan terbaik di kantin kampus melalui sistem review dan voting yang interaktif.
Dengan aplikasi ini, pengguna dapat memberikan ulasan, rating, dan mendapatkan rekomendasi kuliner favorit di sekitar kampus.

- `tampilan dashboard`
- <img width="1438" alt="Screenshot 2025-06-14 at 13 08 24" src="https://github.com/user-attachments/assets/363a0ce8-120a-4d8a-ae80-71a48a9563b0" />
- <img width="1427" alt="Screenshot 2025-06-14 at 13 11 19" src="https://github.com/user-attachments/assets/017d0fa9-7898-42f1-91a2-c859da74204d" />


- `tampilan tenant`
- <img width="1425" alt="Screenshot 2025-06-14 at 12 33 21" src="https://github.com/user-attachments/assets/4aff7e4c-6efa-46be-b96f-ceb26955204d" />

- `Tampilan login`
<img width="940" alt="Screenshot 2025-06-14 at 21 45 11" src="https://github.com/user-attachments/assets/4d92e6d2-2bc2-486a-8749-312943628841" />

- `Tampilan Register`
<img width="1208" alt="Screenshot 2025-06-14 at 21 46 21" src="https://github.com/user-attachments/assets/3118adb2-4fc1-44fa-837a-f616ff88d310" />

- `Tampilan Voting`
<img width="1434" alt="Screenshot 2025-06-14 at 21 48 37" src="https://github.com/user-attachments/assets/96dbf74b-d0f7-4aab-9ad7-7c8e7728b113" />

<img width="1429" alt="Screenshot 2025-06-14 at 21 49 06" src="https://github.com/user-attachments/assets/a1ecb05e-d94c-4cf9-9997-33495cb80cb6" />

- `Tampilan Review & Tentang`
<img width="1418" alt="Screenshot 2025-06-14 at 21 49 48" src="https://github.com/user-attachments/assets/458e57de-5323-442e-86bf-b75543614818" />

<img width="1125" alt="Screenshot 2025-06-14 at 21 50 31" src="https://github.com/user-attachments/assets/6e7b79f1-be4b-4215-976f-d0c2384c93a0" />

  
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

Peran stored procedure, trigger, transaction, dan stored function dalam proyek ini dirancang khusus untuk kebutuhan sistem MakanApaYa. Penerapannya bisa berbeda pada sistem lain, tergantung arsitektur dan kebutuhan masing-masing sistem. Proyek MakanApaYa juga mengimplementasikan fitur-fitur penting pada database MySQL untuk mendukung logika bisnis dan integritas data. Berikut adalah implementasi dan penjelasannya:


## 🧠 Stored Procedure
<img width="744" alt="Screenshot 2025-06-14 at 12 57 35" src="https://github.com/user-attachments/assets/bfba11ca-b213-4eaa-b48c-a6bdc735673b" />

<img width="474" alt="image" src="https://github.com/user-attachments/assets/c54bf1bd-4082-4f5d-a07f-abc33c4e84e9" />


Stored Procedure ini digunakan untuk menghitung rata-rata rating setiap menu per hari. Data akan dikelompokkan berdasarkan tanggal dan menu, lalu ditampilkan rata-rata rating-nya. Ini sangat berguna untuk laporan performa harian tiap menu.

## 🚨 Trigger
<img width="441" alt="image" src="https://github.com/user-attachments/assets/0dd92e8e-1639-415e-a2c2-8539e3f6e20d" />

<img width="766" alt="Screenshot 2025-06-14 at 12 58 15" src="https://github.com/user-attachments/assets/28bd37f5-02f6-432d-9588-1efea3b7640f" />
Trigger ini otomatis aktif setelah data user diperbarui, khususnya ketika status user diubah menjadi "keluar". Semua review milik user tersebut akan otomatis di-nonaktifkan agar tidak memengaruhi rating menu secara tidak relevan.

## 📺 Stored Function
<img width="582" alt="image" src="https://github.com/user-attachments/assets/804721b1-c83c-4547-9f43-1cbc691d3d55" />

<img width="642" alt="Screenshot 2025-06-14 at 13 00 25" src="https://github.com/user-attachments/assets/d5dc78e6-b99e-43b6-aa14-4b62f3db1ec1" />

Function ini akan mengembalikan 3 nama menu dengan rating tertinggi dalam satu string yang dipisahkan koma. Fungsinya cocok dipanggil pada halaman statistik atau laporan mingguan.
Fungsi ini digunakan untuk mengambil 3 menu dengan rating tertinggi dari tabel reviews. Fungsi ini mengembalikan hasil berupa string teks yang berisi nama-nama menu tersebut, dipisahkan dengan koma.

## 🔍 Langkah-langkahnya:

- `Menghitung rata-rata rating dari setiap menu (yang aktif).`

- `Mengurutkan hasil berdasarkan rata-rata rating dari yang tertinggi.`

- `Mengambil 3 teratas.`

- `Menggabungkan nama menu tersebut menjadi satu teks dengan GROUP_CONCAT().`

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

## Fitur Transaction digunakan untuk menjaga integritas data saat user melakukan proses voting.
Langkah-langkahnya adalah:

- `Transaksi dimulai dengan mysqli_begin_transaction().`

- `Sistem mengecek apakah user sudah pernah voting minggu ini.`

- `Jika belum, sistem menyimpan data voting ke database.`

- `Jika semua proses berhasil, transaksi dikomit (mysqli_commit()).`

- `Jika terjadi kesalahan atau user sudah voting, maka proses dibatalkan dengan mysqli_rollback().`

✅ Ini memastikan tidak terjadi duplikasi voting dan menjaga database tetap konsisten bahkan jika terjadi error di tengah proses.`

## 🔄 Backup Otomatis
<img width="1431" alt="Screenshot 2025-06-14 at 13 10 10" src="https://github.com/user-attachments/assets/263c0d02-dab2-4aee-8511-2fad057fb8f8" />






