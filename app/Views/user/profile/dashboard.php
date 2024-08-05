  <?= $this->include('common/dashboard/start.php'); ?>
  <title>Dashboard</title>
  </head>

  <body>
    <nav>
      <h1 class="header"><a href="<?= base_url('/'); ?>">NVS</a></h1>
      <ul>
        <li>
          <a href="#menu">Menu</a>
          <ul class="dropdown">
            <li><a href="<?= base_url('/history'); ?>">History</a></li>
            <li><a href="<?= base_url('/change_password'); ?>">Change password</a></li>
            <li><a href="<?= base_url('/logout'); ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div class="profile-container">
      <h1>Perfil de Usuario</h1>
      <div class="profile-info">
        <p><strong>Name:</strong> <?= session('user')->name; ?></p>
        <p><strong>Email:</strong> <?= session('user')->email; ?></p>
        <p><strong>Account created at:</strong> <?= session('user')->created_at; ?></p>
        <p><strong>verification:</strong> <?= session('user')->verification == 1 ? 'Enabled' : 'Disabled'; ?></p> 
        <button>
          <a href="<?= base_url('verification'); ?>">2 steps verification</a>
        </button>
      </div>
    </div>
  </body> 

  </html>