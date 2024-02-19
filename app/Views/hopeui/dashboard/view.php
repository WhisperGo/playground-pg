<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card" data-aos="fade-up" data-aos-delay="200">
            <div class="card-body">
               <h2 class="text-center mb-2">Selamat Datang, <?= session()->get('username')?> di website GT Kasir</h2>
               <p class="text-center">Selamat bekerja! Semoga aplikasi ini dapat membantu pekerjaan Anda :)</p>
            </div>
         </div>
      </div>

      <div class="overflow-hidden d-slider1 ">
         <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">

            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="200">
               <div class="card-body">
                  <div class="progress-widget">
                     <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="100" data-type="percent">
                        <i class="fa-regular fa-database fa-xl card-slie-arrow" style="top: 55px;"></i>
                     </div>
                     <div class="progress-detail">
                        <p class="mb-2">Total Produk</p>
                        <h4 class="counter"><?= $jumlah_produk ?></h4>
                     </div>
                  </div>
                  <div class="text-center">
                     <a href="<?=base_url('produk')?>" class="btn btn-outline-primary rounded-pill mt-3">Detail Produk</a>
                  </div>
               </div>
            </li>

            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="200">
               <div class="card-body">
                  <div class="progress-widget">
                     <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="100" data-type="percent">
                        <i class="fa-regular fa-user fa-xl card-slie-arrow" style="top: 55px;"></i>
                     </div>
                     <div class="progress-detail">
                        <p class="mb-2">Total Pelanggan</p>
                        <h4 class="counter"><?= $jumlah_pelanggan ?></h4>
                     </div>
                  </div>
                  <div class="text-center">
                     <a href="<?=base_url('pelanggan')?>" class="btn btn-outline-info rounded-pill mt-3">Detail Pelanggan</a>
                  </div>
               </div>
            </li>

            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="200">
               <div class="card-body">
                  <div class="progress-widget">
                     <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-success" data-min-value="0" data-max-value="100" data-value="100" data-type="percent">
                        <i class="fa-regular fa-user fa-xl card-slie-arrow" style="top: 55px;"></i>
                     </div>
                     <div class="progress-detail">
                        <p class="mb-2">Total Penjualan</p>
                        <h4 class="counter"><?= $jumlah_penjualan ?></h4>
                     </div>
                  </div>
                  <div class="text-center">
                     <a href="<?=base_url('penjualan')?>" class="btn btn-outline-success rounded-pill mt-3">Detail Penjualan</a>
                  </div>
               </div>
            </li>
         </ul>

      </div>
   </div>