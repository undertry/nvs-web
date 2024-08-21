 <!-- navbar section starts here -->
 <nav id="navbar">
     <div class="logo"><a href="<?= base_url('/'); ?>">NVS</a></div>
     <div id="menuToggle" class="menu-icon">
         <span class="menu-icon-bar"></span>
         <span class="menu-icon-bar"></span>
         <span class="menu-icon-bar"></span>
     </div>
 </nav>
 <!-- navbar section ends here -->

 <!-- menu section starts here -->
 <div id="overlayNav">
     <div class="overlay-content">
         <div class="overlay-left">
             <div class="overlay-video">
                 <img src="<?= base_url('complements/styles/images/lines.jpg'); ?>" alt="Video">
                 <div class="video-controls">
                     <span>00: 13: 49: 12: 45: 02</span>
                 </div>
             </div>
         </div>
         <div class="overlay-right">
             <ul>
                 <li><a href="#home">Home</a></li>
                 <li><a href="#software">Software</a></li>
                 <li><a href="#about">About</a></li>
                 <?php if (session('user') && session('user')->id_user > 0 && session('user')->name) : ?>
                 <li><a href="<?= base_url('dashboard-animation'); ?>"><?= session('user')->name; ?></a>
                 </li>
                 <li><a href="<?= base_url('logout'); ?>">Log Out</a></li>
                 <?php else : ?>
                 <li><a href="<?= base_url('login-animation'); ?>">Log In</a></li>
                 <li><a href="<?= base_url('signup-animation'); ?>">Sign Up</a></li>
                 <?php endif; ?>
             </ul>
             <button class="cta-button">Download</button>
         </div>
     </div>
 </div>
 <!-- menu section ends here -->