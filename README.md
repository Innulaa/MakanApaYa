#  🍽 MakanApaYa – Sistem Review & Voting Kantin Kampus


## 📌 Deskripsi
MakanApaYa adalah aplikasi berbasis web yang membantu mahasiswa memilih makanan terbaik di kantin kampus melalui sistem review dan voting yang interaktif.
Dengan aplikasi ini, pengguna dapat memberikan ulasan, rating, dan mendapatkan rekomendasi kuliner favorit di sekitar kampus.

<img width="1425" alt="Screenshot 2025-06-14 at 12 33 21" src="https://github.com/user-attachments/assets/4aff7e4c-6efa-46be-b96f-ceb26955204d" />



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
- 'rangking' - Data rating  menu harian dan mingguan
- 'location_log' - Data untuk nonaktifkan review berdasarkan lokasi (trigger)
- 
