<?php
require "includes/database_connect.php";
session_start();
if (isset($_SESSION['user_id'])) {
    header("location: dashboard.php");
}
if (isset($_SESSION['admin_id'])) {
    header("location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    include "includes/head_links.php";
    ?>
    <link rel="stylesheet" href="css/home.css" />
    <title>Attendance Tracker</title>
  </head>

  <body>
    <?php
    include "includes/header.php";
    ?>
    <div id="bg" class="bg-[url('../img/bg.avif')] bg-cover bg-centre fixed-bg">
      <div id="box" class="h-screen flex items-center justify-center">
        <span class="overline text-4xl text-white font-bold mb-10"
          >Effortless Attendance Management at Your Fingertips</span
        >
        <div id="login_buttons" class="flex justify-center">
          <button
            data-modal-target="authentication-modal"
            data-modal-toggle="authentication-modal"
            type="button"
            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          >
            <i class="fa fa-user-circle"></i> Login as User
          </button>
          <button
            data-modal-target="admin-modal"
            data-modal-toggle="admin-modal"
            type="button"
            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          >
            <i class="fa fa-lock"></i> Login as Admin
          </button>
        </div>
      </div>
    </div>

    <!-- Login Main modal -->
    <div
      id="authentication-modal"
      tabindex="-1"
      aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div
            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
              Login
            </h3>
            <button
              type="button"
              class="end-2.5 text-gray-900 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600"
              data-modal-hide="authentication-modal"
            >
              <svg
                class="w-3 h-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
            <form
              id="login_form"
              class="space-y-4"
              action="includes/login.php"
              method="post"
            >
              <div>
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"
                  >Your email</label
                >
                <input
                  type="email"
                  name="email"
                  id="email"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                  placeholder="name@email.com"
                  required
                />
              </div>
              <div>
                <label
                  for="password"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"
                  >Your password</label
                >
                <div class="relative">
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    class="password-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-white-400 dark:text-white"
                    required
                  />

                  <svg
                    class="toggle-password absolute right-3 top-3 cursor-pointer w-5 h-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z
             M2.458 12C3.732 7.943 7.523 5 12 5
             c4.478 0 8.268 2.943 9.542 7
             c-1.274 4.057-5.064 7-9.542 7
             c-4.478 0-8.268-2.943-9.542-7z"
                    />
                  </svg>
                </div>
              </div>

              <button
                type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                Login to your account
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Admin Main modal -->
    <div
      id="admin-modal"
      tabindex="-1"
      aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div
            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
              Admin Login
            </h3>
            <button
              type="button"
              class="end-2.5 text-gray-900 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600"
              data-modal-hide="admin-modal"
            >
              <svg
                class="w-3 h-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
            <form
              id="admin_form"
              class="space-y-4"
              action="includes/admin_login.php"
              method="post"
            >
              <div>
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"
                  >Admin email</label
                >
                <input
                  type="email"
                  name="admin_email"
                  id="admin_email"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                  placeholder="name@email.com"
                  required
                />
              </div>
              <div>
                <label
                  for="password"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"
                  >Admin password</label
                >
                <div class="relative">
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    class="password-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-white-400 dark:text-white"
                    required
                  />

                  <svg
                    class="toggle-password absolute right-3 top-3 cursor-pointer w-5 h-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z
             M2.458 12C3.732 7.943 7.523 5 12 5
             c4.478 0 8.268 2.943 9.542 7
             c-1.274 4.057-5.064 7-9.542 7
             c-4.478 0-8.268-2.943-9.542-7z"
                    />
                  </svg>
                </div>
              </div>

              <button
                type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                Login to your account
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Signup Main modal -->
    <div
      id="signup-modal"
      tabindex="-1"
      aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div
            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
              Create an account
            </h3>
            <button
              type="button"
              class="end-2.5 text-gray-900 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600"
              data-modal-hide="signup-modal"
            >
              <svg
                class="w-3 h-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
            <form
              id="signup_form"
              class="space-y-4"
              action="includes/signup.php"
              method="post"
            >
              <div>
                <label
                  for="name"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"
                  >Your Name</label
                >
                <input
                  type="name"
                  name="name"
                  id="name"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                  placeholder="name"
                  required
                />
              </div>
              <div>
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"
                  >Your email</label
                >
                <input
                  type="email"
                  name="email"
                  id="email"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                  placeholder="name@email.cm"
                  required
                />
              </div>
              <div>
                <label
                  for="password"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"
                  >Your password</label
                >
                <div class="relative">
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    class="password-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-white-400 dark:text-white"
                    required
                  />

                  <svg
                    class="toggle-password absolute right-3 top-3 cursor-pointer w-5 h-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z
             M2.458 12C3.732 7.943 7.523 5 12 5
             c4.478 0 8.268 2.943 9.542 7
             c-1.274 4.057-5.064 7-9.542 7
             c-4.478 0-8.268-2.943-9.542-7z"
                    />
                  </svg>
                </div>
              </div>
              <div>
                <label
                  for="password"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-black"
                  >Confirm password</label
                >
                <div class="relative">
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    class="password-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-white-400 dark:text-white"
                    required
                  />

                  <svg
                    class="toggle-password absolute right-3 top-3 cursor-pointer w-5 h-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z
             M2.458 12C3.732 7.943 7.523 5 12 5
             c4.478 0 8.268 2.943 9.542 7
             c-1.274 4.057-5.064 7-9.542 7
             c-4.478 0-8.268-2.943-9.542-7z"
                    />
                  </svg>
                </div>
              </div>

              <button
                type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                Create Account
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.querySelectorAll(".toggle-password").forEach((icon) => {
        icon.addEventListener("click", () => {
          const input = icon.previousElementSibling;

          if (input.type === "password") {
            input.type = "text";

            icon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3l18 18M9.88 9.88A3 3 0 0012 15
                   a3 3 0 002.12-.88m2.681-2.681
                   A8.969 8.969 0 0121.542 12
                   c-1.274 4.057-5.064 7-9.542 7
                   a8.963 8.963 0 01-6.34-2.659
                   M6.623 6.623A8.963 8.963 0 013.458 12" />
        `;
          } else {
            input.type = "password";

            icon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z
                   M2.458 12C3.732 7.943 7.523 5 12 5
                   c4.478 0 8.268 2.943 9.542 7
                   c-1.274 4.057-5.064 7-9.542 7
                   c-4.478 0-8.268-2.943-9.542-7z" />
        `;
          }
        });
      });
    </script>
    <?php
   include "includes/script.php";
   ?></body>
</html>
