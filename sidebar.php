<style>
  #sidebar {
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
    opacity: 1;
  }

  .sidebar-hidden {
    transform: translateX(-100%);
    opacity: 0;
  }
</style>

<div class="p-4">
  <button id="toggleSidebar" class="text-3xl focus:outline-none text-pink-800">
    &#9776;
  </button>
</div>

<div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-pink-100 p-6 shadow-lg sidebar-hidden z-50">
  <h2 class="text-2xl font-bold text-pink-700 mb-8">Menu</h2>
  <ul class="space-y-6">
    <li>
      <a href="dashboard.php" class="flex items-center text-lg text-gray-800 hover:text-pink-600">
        <span class="text-2xl mr-3">📋</span> Dashboard
      </a>
    </li>
    <li>
      <a href="review.php" class="flex items-center text-lg text-gray-800 hover:text-pink-600">
        <span class="text-2xl mr-3">⭐</span> Review Makanan
      </a>
    </li>
    <li>
      <a href="tenant_kantin.php" class="flex items-center text-lg text-gray-800 hover:text-pink-600">
        <span class="text-2xl mr-3">🗳️</span> Tenant
      </a>
    </li>
    <li>
      <a href="tentang.php" class="flex items-center text-lg text-gray-800 hover:text-pink-600">
        <span class="text-2xl mr-3">ℹ️</span> Tentang
      </a>
    </li>
    <li>
      <a href="#" onclick="confirmLogout()" class="flex items-center text-lg text-red-500 font-semibold hover:text-red-700">
        <span class="text-2xl mr-3">🚪</span> Logout
      </a>
    </li>
  </ul>
</div>


<script>
  const btn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const main = document.querySelector('main');

  let isSidebarOpen = false;

  btn.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar-hidden');
    isSidebarOpen = !isSidebarOpen;

    if (main) {
      main.classList.toggle('ml-64');
    }
  });

  document.addEventListener('mousemove', (event) => {
    if (
      isSidebarOpen &&
      !sidebar.contains(event.target) &&
      !btn.contains(event.target)
    ) {
      sidebar.classList.add('sidebar-hidden');
      if (main) {
        main.classList.remove('ml-64');
      }
      isSidebarOpen = false;
    }
  });

  function confirmLogout() {
    if (confirm("Apakah Anda yakin ingin logout?")) {
      window.location.href = "logout.php";
    }
  }
</script>
