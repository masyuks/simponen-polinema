<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" style="" href="<?= base_url('dashboard') ?>">
				<div class="sidebar-brand-icon">
					<!-- <img src="<?=base_url()?>assets/img/polinema-loss.png" style="width: 45px;"> -->
					Menu Bar
					<!-- <div class="sidebar-brand-text mx-3">SIMASET Polinema</div> -->
				</div>
				<!-- <div class="sidebar-brand-text mx-3">SIMASET Polinema</div> -->
			</a>
			<hr class="sidebar-divider my-0">
			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>

			<?php if ($this->session->login['role'] == 'teknisi') { ?>

			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				Master
			</div>

			<li class="nav-item <?= $aktif == 'barang' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('barang') ?>">
					<i class="fas fa-fw fa-box"></i>
					<span>Master Barang</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'teknisi' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('teknisi') ?>">
					<i class="fas fa-fw fa-user-clock"></i>
					<span>Master Teknisi</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'dosen' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dosen') ?>">
					<i class="fas fa-fw fa-user-tie"></i>
					<span>Master Dosen</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'mk' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('mk') ?>">
					<i class="fas fa-fw fa-book"></i>
					<span>Master Mata Kuliah</span></a>
			</li>

			<?php } ?>

			<!-- Divider -->
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
				Transaksi
			</div>

			<li class="nav-item <?= $aktif == 'peminjaman' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('peminjaman') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Peminjaman Barang</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'rekap' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('peminjaman/rekap') ?>">
					<i class="fas fa-fw fa-file-archive"></i>
					<span>Rekap Peminjaman</span></a>
			</li>

			<hr class="sidebar-divider">
			<?php if ($this->session->login['role'] == 'teknisi'): ?>
				<!-- Heading -->
				<div class="sidebar-heading">
					Pengaturan
				</div>

				<li class="nav-item <?= $aktif == 'pengguna' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('pengguna') ?>">
						<i class="fas fa-fw fa-users"></i>
						<span>Manajemen Mahasiswa</span></a>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">
			<?php endif; ?>

			<li class="nav-item <?= $aktif == 'logout' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('logout') ?>">
					<i class="fas fa-fw fa-sign-out-alt"></i>
					<span>Logout</span></a>
			</li>

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>