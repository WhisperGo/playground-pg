<?php 

$uri = service('uri');

$db = \Config\Database::connect();
$builder = $db->table('website');
$logo = $builder->select('logo_website')
->where('deleted_at', null)
->get()
->getRow();

?>

<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
  <div class="sidebar-header d-flex align-items-center justify-content-start">

    <!--Logo start-->
    <a href="<?=base_url('dashboard')?>" class="navbar-brand">
      <img src="<?=base_url('logo/logo_website/'.$logo->logo_website)?>" width="35%">
    </a>
    <!--logo End-->

    <!--Logo start-->
<!--       <div class="logo-main">
        <div class="logo-normal">
          <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
          </svg>
        </div>
        <div class="logo-mini">
          <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
          </svg>
        </div>
      </div> -->
      <!--logo End-->

      <!-- <h4 class="logo-title">GT Playground</h4> -->

      <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
        <i class="icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </i>
      </div>
    </div>




    <!-- ------------------------------- MENU ADMIN ------------------------------------- -->

    <?php if (session()->get('level')==1){ ?>
      <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
          <!-- Sidebar Menu Start -->
          <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
            <li class="nav-item static-item">
              <a class="nav-link static-item disabled" tabindex="-1">
                <span class="default-icon">Home</span>
                <!-- <span class="mini-icon">-</span> -->
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "dashboard"){echo "active";}?>" href="<?=base_url('dashboard')?>"><i class="faj-button fa-duotone fa-grid-2"></i><span class="item-name">Dashboard</span>
              </a>
            </li>

            <li><hr class="hr-horizontal"></li>
            <li class="nav-item static-item">
              <a class="nav-link static-item disabled" tabindex="-1">
                <span class="default-icon">Data Master</span>
                <!-- <span class="mini-icon">-</span> -->
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "user"){echo "active";}?>" href="<?=base_url('user')?>"><i class="fa-regular fa-users"></i><span class="item-name">Data User</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "pelanggan"){echo "active";}?>" href="<?=base_url('pelanggan')?>"><i class="fa-regular fa-list"></i><span class="item-name">Data Pelanggan</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "data_level"){echo "active";}?>" href="<?=base_url('data_level')?>"><i class="fa-regular fa-layer-group"></i><span class="item-name">Data Level</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "data_website"){echo "active";}?>" href="<?=base_url('data_website')?>"><i class="fa-regular fa-globe"></i><span class="item-name">Data Website</span>
              </a>
            </li>

            <li><hr class="hr-horizontal"></li>
            <li class="nav-item static-item">
              <a class="nav-link static-item disabled" tabindex="-1">
                <span class="default-icon">Data Playground</span>
                <!-- <span class="mini-icon">-</span> -->
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "permainan"){echo "active";}?>" href="<?=base_url('permainan')?>"><i class="fa-regular fa-gamepad"></i><span class="item-name">Data Permainan</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "paket_permainan"){echo "active";}?>" href="<?=base_url('paket_permainan')?>"><i class="fa-light fa-joystick"></i><span class="item-name">Paket Permainan</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "aktivitas_playground"){echo "active";}?>" href="<?=base_url('aktivitas_playground')?>"><i class="fa-regular fa-chart-line"></i><span class="item-name">Aktivitas Playground</span>
              </a>
            </li>

            <li><hr class="hr-horizontal"></li>
            <li class="nav-item static-item">
              <a class="nav-link static-item disabled" tabindex="-1">
                <span class="default-icon">Data Transaksi</span>
                <!-- <span class="mini-icon">-</span> -->
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "kasir"){echo "active";}?>" href="<?=base_url('kasir')?>"><i class="fa-regular fa-cash-register"></i><span class="item-name">Kasir Pembayaran</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "transaksi" && $uri->getSegment(2) !== "menu_laporan"){echo "active";}?>" href="<?=base_url('transaksi')?>"><i class="fa-duotone fa-arrow-right-arrow-left"></i><span class="item-name">Data Transaksi</span>
              </a>
            </li>

            <!-- <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "durasi_bermain"){echo "active";}?>" href="<?=base_url('durasi_bermain')?>"><i class="fa-regular fa-stopwatch"></i><span class="item-name">Durasi Main</span>
              </a>
            </li> -->

            <li><hr class="hr-horizontal"></li>
            <li class="nav-item static-item">
              <a class="nav-link static-item disabled" tabindex="-1">
                <span class="default-icon">Data Keuangan</span>
                <!-- <span class="mini-icon">-</span> -->
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "pajak"){echo "active";}?>" href="<?=base_url('pajak')?>"><i class="fa-duotone fa-chart-pie"></i><span class="item-name">Data Pajak</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(1) == "pengeluaran"){echo "active";}?>" href="<?=base_url('pengeluaran')?>"><i class="fa-solid fa-chart-line-down"></i><span class="item-name">Data Pengeluaran</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(2) == "menu_laporan" && $uri->getSegment(1) == "transaksi"){echo "active";}?>" href="<?=base_url('transaksi/menu_laporan')?>"><i class="fa-light fa-file-invoice"></i><span class="item-name">Laporan Transaksi</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($uri->getSegment(2) == "menu_laporan" && $uri->getSegment(1) == "laporan_keuangan"){echo "active";}?>" href="<?=base_url('laporan_keuangan/menu_laporan')?>"><i class="fa-light fa-file-invoice"></i><span class="item-name">Laporan Keuangan</span>
              </a>
            </li>

            <li class="nav-item mb-5"></li>

          </ul>
        </li>

      </ul>
    </div>
  </div>




  <!-- ------------------------------- MENU PETUGAS ------------------------------------- -->

<?php }else if (session()->get('level')==2){ ?>
  <div class="sidebar-body pt-0 data-scrollbar">
    <div class="sidebar-list">
      <!-- Sidebar Menu Start -->
      <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Home</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "dashboard"){echo "active";}?>" href="<?=base_url('dashboard')?>"><i class="faj-button fa-duotone fa-grid-2"></i><span class="item-name">Dashboard</span>
          </a>
        </li>

        <li><hr class="hr-horizontal"></li>
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Data Master</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "pelanggan"){echo "active";}?>" href="<?=base_url('pelanggan')?>"><i class="fa-regular fa-list"></i><span class="item-name">Data Pelanggan</span>
          </a>
        </li>

        <li><hr class="hr-horizontal"></li>
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Data Playground</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "aktivitas_playground"){echo "active";}?>" href="<?=base_url('aktivitas_playground')?>"><i class="fa-regular fa-chart-line"></i><span class="item-name">Aktivitas Playground</span>
          </a>
        </li>

        <li><hr class="hr-horizontal"></li>
        <li class="nav-item static-item">
          <a class="nav-link static-item disabled" tabindex="-1">
            <span class="default-icon">Data Transaksi</span>
            <!-- <span class="mini-icon">-</span> -->
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "kasir"){echo "active";}?>" href="<?=base_url('kasir')?>"><i class="fa-regular fa-cash-register"></i><span class="item-name">Kasir Pembayaran</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "transaksi" && $uri->getSegment(2) !== "menu_laporan"){echo "active";}?>" href="<?=base_url('transaksi')?>"><i class="fa-duotone fa-arrow-right-arrow-left"></i><span class="item-name">Data Transaksi</span>
          </a>
        </li>

        <li class="nav-item mb-5"></li>

      </ul>
    </li>

  </ul>
</div>
</div>

<?php } ?>