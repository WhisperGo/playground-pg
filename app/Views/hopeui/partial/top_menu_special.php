<?php
$db         = \Config\Database::connect();

$level      = session()->get('level');
$on         = 'user.level=level.id_level';
$namalevel  = $db->table('user')->join('level', $on, 'left')->where('level.id_level', $level)->get()->getRow();

$id_user = session()->get('id');
$user = $db->table('user')->where('id_user', $id_user)->get()->getRow();

// if (!empty($user->foto)) {
//   $foto = base_url('images/' . $user->foto);
// } else {
//   $foto = base_url('images/default.png');
// }

$builder = $db->table('website');
$logo = $builder->select('logo_website')
->where('deleted_at', null)
->get()
->getRow();

?>

<div class="sidebar-footer"></div>
</aside>    <main class="main-content">
  <div class="position-relative iq-banner">
    <!--Nav Start-->
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
      <div class="container-fluid navbar-inner">

       <!--Logo start-->
       <a href="<?=base_url('dashboard')?>" class="navbar-brand">
        <img src="<?=base_url('logo/logo_website/'.$logo->logo_website)?>" width="35%">
      </a>
      <!--logo End-->

      <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
        <i class="icon">
         <svg  width="20px" class="icon-20" viewBox="0 0 24 24">
          <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
        </svg>
      </i>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-left: 315px;">
      <span class="navbar-toggler-icon">
        <span class="mt-2 navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
        
      </ul>
    </li>
  </ul>
</div>
</div>
</nav>          <!-- Nav Header Component Start -->

<div class="iq-navbar-header" style="height: 215px;">
 <div class="container-fluid iq-container">
   <div class="row">
     <div class="col-md-12">
       <div class="flex-wrap d-flex justify-content-between align-items-center">
         <div>
           <h1><?=$title?></h1>
           <p><?=$desc?></p>
         </div>
       </div>
     </div>
   </div>
 </div>
 <div class="iq-header-img">
   <img src="<?=base_url('assets/images/dashboard/top-header.png')?>" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header1.png')?>" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header2.png')?>" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header3.png')?>" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header4.png')?>" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header5.png')?>" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
 </div>
</div>          <!-- Nav Header Component End -->
<!--Nav End-->
</div>