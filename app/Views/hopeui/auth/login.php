<div class="wrapper">
   <section class="login-content">
      <div class="row m-0 align-items-center bg-white vh-100">            
         <div class="col-md-6">
            <div class="row justify-content-center">
               <div class="col-md-10">
                  <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                     <div class="card-body">
                        <a href="dashboard/index.html" class="navbar-brand d-flex align-items-center mb-3">
                           <!--Logo start-->
                           <!--logo End-->

                           <!--Logo start-->
                           <div class="logo-main">
                             <div class="logo-normal">
                               <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                 <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                 <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                 <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                              </svg>
                           </div>
                           <div class="logo-mini">
                            <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                              <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                              <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                              <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                           </svg>
                        </div>
                     </div>
                     <!--logo End-->

                     <h4 class="logo-title ms-3">GT Kasir</h4>
                  </a>
                  <h2 class="mb-2 text-center">Sign In</h2>
                  <p class="text-center">Login to stay connected.</p>

                  <?php if (session()->has('error')): ?>
                  <div class="alert alert-danger d-flex align-items-center" role="alert"><i class="faj-button fa-regular fa-circle-exclamation"></i>
                     <?= session('error') ?></div>
                  <?php endif; ?>

                  <form action="<?= base_url('login/aksi_login')?>" method="post">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="text" class="form-label">Username</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                           </div>
                        </div>

                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="password" class="form-label" style="flex: 1;">Password</label>
                            <div style="position: relative; flex: 1;">
                              <input type="password" class="form-control" id="password-input" placeholder="Masukkan Password" name="password">
                              <button type="button" class="btn btn-outline-primary" id="show-password-btn" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%);">
                                <i class="fa-solid fa-eye"></i>
                             </button>
                          </div>
                       </div>
                    </div>

                    <div class="col-lg-12 d-flex justify-content-between">
                     <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                     </div>
                     <!-- <a href="recoverpw.html">Forgot Password?</a> -->
                  </div>
               </div>
               <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">Sign In</button>
               </div>
                     <!-- <p class="text-center my-3">or sign in with other accounts?</p>
                     <div class="d-flex justify-content-center">
                        <ul class="list-group list-group-horizontal list-group-flush">
                           <li class="list-group-item border-0 pb-0">
                              <a href="#"><img src="<?=base_url('assets/images/brands/fb.svg')?>" alt="fb"></a>
                           </li>
                           <li class="list-group-item border-0 pb-0">
                              <a href="#"><img src="<?=base_url('assets/images/brands/gm.svg')?>" alt="gm"></a>
                           </li>
                           <li class="list-group-item border-0 pb-0">
                              <a href="#"><img src="<?=base_url('assets/images/brands/im.svg')?>" alt="im"></a>
                           </li>
                           <li class="list-group-item border-0 pb-0">
                              <a href="#"><img src="<?=base_url('assets/images/brands/li.svg')?>" alt="li"></a>
                           </li>
                        </ul>
                     </div> -->
                     <!-- <p class="mt-3 text-center">
                        Don’t have an account? <a href="<?=base_url('register')?>" class="text-underline">Click here to sign up.</a>
                     </p> -->
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="sign-bg">
         <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g opacity="0.05">
               <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
               <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
               <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
               <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
            </g>
         </svg>
      </div>
   </div>
   <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
      <img src="<?=base_url('assets/images/auth/01.png')?>" class="img-fluid gradient-main animated-scaleX" alt="images">
   </div>
</div>
</section>
</div>

<script>
   // Saat halaman dimuat
   document.addEventListener("DOMContentLoaded", function() {
  // Cek apakah ada cookie dengan nama "remember_me"
      if (getCookie("remember_me")) {
    // Jika ada, tandai checkbox "Ingat Saya"
         document.getElementById("flexCheckDefault").checked = true;
    // Dan isi field username dan password dengan nilai cookie
         var cookie = JSON.parse(getCookie("remember_me"));
         if (cookie && cookie.username && cookie.password) {
            document.getElementsByName("username")[0].value = cookie.username;
            document.getElementsByName("password")[0].value = cookie.password;
         }
      }
   });

// Saat form login disubmit
   document.querySelector("form").addEventListener("submit", function() {
  // Cek apakah checkbox "Ingat Saya" di-tick
      if (document.getElementById("flexCheckDefault").checked) {
    // Jika iya, buat cookie dengan nama "remember_me" yang berisi nilai username dan password
         var username = document.getElementsByName("username")[0].value;
         var password = document.getElementsByName("password")[0].value;
         if (username && password) {
            var cookie = {
               username: username,
               password: password
            };
            setCookie("remember_me", JSON.stringify(cookie), 30);
         }
      } else {
    // Jika tidak, hapus cookie dengan nama "remember_me" (jika ada)
         deleteCookie("remember_me");
      }
   });

// Fungsi untuk membuat cookie
   function setCookie(name, value, days) {
      var expires = "";
      if (days) {
         var date = new Date();
         date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
         expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "") + expires + "; path=/";
   }

// Fungsi untuk membaca nilai cookie
   function getCookie(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
         var c = ca[i];
         while (c.charAt(0) == ' ') c = c.substring(1, c.length);
         if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
   }

// Fungsi untuk menghapus cookie
   function deleteCookie(name) {
      document.cookie = name + '=; Max-Age=-99999999;';
   }


   $(document).ready(function() {
      $('#show-password-btn').click(function() {
         var passwordInput = $('#password-input');
         var passwordInputType = passwordInput.attr('type');
         var showPasswordBtn = $('#show-password-btn');
         if (passwordInputType === 'password') {
            passwordInput.attr('type', 'text');
            showPasswordBtn.html('<i class="fa-solid fa-eye-slash"></i>');
         } else {
            passwordInput.attr('type', 'password');
            showPasswordBtn.html('<i class="fa-solid fa-eye"></i>');
         }
      });
   });

</script>