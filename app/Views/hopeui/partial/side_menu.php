<?php 

$uri = service('uri');

?>

<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
  <div class="sidebar-header d-flex align-items-center justify-content-start">
    <a href="<?=base_url('dashboard')?>" class="navbar-brand">
      <!--Logo start-->
      <!--logo End-->

      <!--Logo start-->
      <div class="logo-main">
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
      </div>
      <!--logo End-->

      <h4 class="logo-title">GT Kasir</h4>
    </a>
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
            <a class="nav-link <?php if($uri->getSegment(1) == "data_level"){echo "active";}?>" href="<?=base_url('data_level')?>"><i class="fa-regular fa-layer-group"></i></i><span class="item-name">Data Level</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if($uri->getSegment(1) == "produk"){echo "active";}?>" href="<?=base_url('produk')?>"><i class="fa-regular fa-database"></i><span class="item-name">Data Produk</span>
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
            <a class="nav-link <?php if($uri->getSegment(1) == "kasir"){echo "active";}?>" href="<?=base_url('kasir')?>"><i class="fa-regular fa-cash-register"></i><span class="item-name">Kasir Penjualan</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if($uri->getSegment(1) == "penjualan" && $uri->getSegment(2) !== "menu_laporan" || $uri->getSegment(1) == "detail_penjualan"){echo "active";}?>" href="<?=base_url('penjualan')?>"><i class="fa-duotone fa-arrow-right-arrow-left"></i><span class="item-name">Data Penjualan</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if($uri->getSegment(2) == "menu_laporan"){echo "active";}?>" href="<?=base_url('penjualan/menu_laporan')?>"><i class="fa-light fa-file-invoice"></i><span class="item-name">Laporan Penjualan</span>
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
          <a class="nav-link <?php if($uri->getSegment(1) == "produk"){echo "active";}?>" href="<?=base_url('produk')?>"><i class="fa-regular fa-database"></i><span class="item-name">Data Produk</span>
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
          <a class="nav-link <?php if($uri->getSegment(1) == "kasir"){echo "active";}?>" href="<?=base_url('kasir')?>"><i class="fa-regular fa-cash-register"></i><span class="item-name">Kasir Penjualan</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(1) == "penjualan" && $uri->getSegment(2) !== "menu_laporan" || $uri->getSegment(1) == "detail_penjualan"){echo "active";}?>" href="<?=base_url('penjualan')?>"><i class="fa-duotone fa-arrow-right-arrow-left"></i><span class="item-name">Data Penjualan</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if($uri->getSegment(2) == "menu_laporan"){echo "active";}?>" href="<?=base_url('penjualan/menu_laporan')?>"><i class="fa-light fa-file-invoice"></i><span class="item-name">Laporan Penjualan</span>
          </a>
        </li>

        <li class="nav-item mb-5"></li>

      </ul>
    </li>

  </ul>
</div>
</div>


<?php } ?>