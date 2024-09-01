
 <nav id="header" class="fixed top-0 left-0 w-full bg-yellow-400 border-gray-200">
 <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
     <a href="home.php">
     <span class="text-white self-center text-2xl font-semibold whitespace-nowrap dark:text-white flex">
      <div id="img-container">
      <img src="img/logo.png"/>
      </div>
      <div id="name">
      Attendance Tracker
      </div>
    </span>
     </a>
     <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg md:hidden hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-red-700 dark:hover:bg-yellow-600 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
         <span class="sr-only">Open main menu</span>
         <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
         </svg>
     </button>
     <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <?php
        //if the USER is logged in
        if(isset($_SESSION['user_id'])){ 
          ?>
          <ul class="bg-yellow-500 font-medium flex flex-col p-2 md:p-0 mt-1 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-yellow-500 dark:bg-yellow-500 md:dark:bg-yellow-500">
              <li class="flex items-center justify-center">
               Hi, <?= $_SESSION['name']?>
              </li>
              <li>
                <a href="logout.php" class="block py-2 px-3 text-white rounded hover:bg-yellow-700 md:hover:bg-yellow-700 md:border-0 md:hover:text-white md:p-0 dark:text-white md:dark:hover:text-white dark:hover:bg-yellow-700 dark:hover:text-white md:dark:hover:bg-yellow-700"><i class="fas fa-sign-out-alt"></i> Logout</a>
              </li>
            </ul>
  
              <?php
        }
        //check if the ADMIN is logged in
        elseif(isset($_SESSION['admin_id'])){
          ?>
          <ul class="font-medium flex flex-col p-2 md:p-0 mt-1 border border-gray-100 rounded-lg bg-yellow-500 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-yellow-500 dark:bg-yellow-500 md:dark:bg-yellow-500">
              <li class="flex items-center justify-center">
               <i class="fa fa-unlock-alt"></i> <?= $_SESSION['admin_name']?>
              </li>
              <li>
                <a href="logout.php" class="block py-2 px-3 text-white rounded hover:bg-yellow-700 md:hover:bg-yellow-700 md:border-0 md:hover:text-white md:p-0 dark:text-white md:dark:hover:text-white dark:hover:bg-yellow-700 dark:hover:text-white md:dark:hover:bg-yellow-700"><i class="fas fa-sign-out-alt"></i> Logout</a>
              </li>
            </ul>
  
              <?php
        }

        else {
          ?>
          <ul class="font-medium flex flex-col p-2 md:p-0 mt-1 border border-gray-100 rounded-lg bg-yellow-500 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-yellow-500 dark:bg-yellow-500 md:dark:bg-yellow-500">
          <li>
            <a data-modal-target="signup-modal" data-modal-toggle="signup-modal" href="#" class="block py-2 px-3 text-white rounded hover:bg-yellow-700 md:bg-transparent md:text-blue-500 md:p-0 dark:text-white md:dark:text-blue-500"><i class="fas fa-user"></i> Signup</a>
          </li>
          <li>
            <a data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" href="#" class="block py-2 px-3 text-white rounded hover:bg-yellow-700 md:hover:bg-yellow-700 md:border-0 md:hover:text-white md:p-0 dark:text-white md:dark:hover:text-white dark:hover:bg-yellow-700 dark:hover:text-white md:dark:hover:bg-yellow-700"><i class="fas fa-sign-in-alt"></i> Login</a>
          </li>
        </ul>
        <?php
        }
        ?>
       </div>
 </div>

</nav>


<?php
include "script.php";
?>


