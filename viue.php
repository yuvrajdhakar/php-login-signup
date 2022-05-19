<?php
session_start();

$title ="view User";
$id = $_GET['id'];

if ($id && !empty($id)) {
    include "db-connection.php";

    $result = $conn->query("Select * from users where id=$id");

    if ($result) {
        $user = $result->fetch_assoc();

        ?>

        <!DOCTYPE html>
        <html>

        <?php include "layouts/head.php"; ?>

        <body class="text-blueGray-700 antialiased">
        <noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root">
            <nav
                    class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
            >
                <div
                        class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
                >
                    <button
                            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                            type="button"
                            onclick="toggleNavbar('example-collapse-sidebar')"
                    >
                        <i class="fas fa-bars"></i>
                    </button>
                    <a
                            class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                            href="../../index.html"
                    >
                        <img src="https://skyesol.com/wp-content/uploads/2021/09/skyesol248x94.png"
                             alt="Sky e-Solutions">
                             <!-- <?php echo $_SESSION['name']; ?>-->
                    </a>
                     
                    
                        <!-- Navigation -->

                        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                            <li class="items-center">
                                <a
                                        href="home.php"
                                        class="text-xs uppercase py-3 font-bold"
                                >
                                    <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li class="items-center">
                                <a
                                        href="users.php"
                                        class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
                                >
                                    <i class="fas fa-tools mr-2 text-sm text-blueGray-300"></i>
                                    Users
                                </a>
                            </li>

                            <li class="items-center">
                                <a
                                        href="./tables.html"
                                        class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
                                >
                                    <i class="fas fa-table mr-2 text-sm text-blueGray-300"></i>
                                    Tables
                                </a>
                            </li>

                            <li class="items-center">
                                <a
                                        href="https://www.google.com/maps"
                                        class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
                                >
                                    <i
                                            class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                                    ></i>
                                    Maps
                                </a>
                            </li>
                        </ul>

                        <!-- Divider -->
                        <hr class="my-4 md:min-w-full"/>

                        <!-- Navigation -->

                        <ul
                                class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
                        >
                            <li class="items-center">
                                <a
                                        href="logout.php"
                                        class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                >
                                    <i
                                            class="fas fa-fingerprint text-blueGray-300 mr-2 text-sm"
                                    ></i>
                                    Logout
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="relative md:ml-64 bg-blueGray-50">
                <nav
                        class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4"
                >
                    <div
                            class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
                    >
                        <a
                                class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                                href="./index.html"
                        >Dashboard</a
                        >
                        
                        <ul
                                class="flex-col md:flex-row list-none items-center hidden md:flex"
                        >
                            <a
                                    class="text-blueGray-500 block"
                                    href="#pablo"
                                    onclick="openDropdown(event,'user-dropdown')"
                            >
                                <div class="items-center flex">
                  <span
                          class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
                  ><img
                              alt="<?php echo $_SESSION['name']; ?>"
                              class="w-full rounded-full align-middle border-none shadow-lg"
                              src="https://s.gravatar.com/avatar/<?php echo md5($_SESSION['email']); ?>?s=80"
                      /></span>
                                </div>
                            </a>
                            <div
                                    class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                                    id="user-dropdown"
                            >
                                <a
                                        href="#pablo"
                                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                >Action</a
                                ><a
                                        href="#pablo"
                                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                >Another action</a
                                ><a
                                        href="#pablo"
                                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                >Something else here</a
                                >
                                <div
                                        class="h-0 my-2 border border-solid border-blueGray-100"
                                ></div>
                                <a
                                        href="logout.php"
                                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                >Logout</a
                                >
                            </div>
                        </ul>
                    </div>
                </nav>
                <!-- Header -->
                <div class="relative bg-pink-600 md:pt-32 pb-32 pt-12">
                    <div class="px-4 md:px-10 mx-auto w-full">

                    </div>
                </div>
                <div class="px-4 md:px-10 mx-auto w-full -m-24">
                    <!-- content start here -->

                    <div class="w-full px-4">
                        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                            <?php if (isset($_GET['success'])) { ?>
                                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                                     role="alert">
                                    <span class="font-medium">Success!</span> <?php echo $_GET['success']; ?>
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['error'])) { ?>
                                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                                     role="alert">
                                    <?php echo $_GET['error']; ?>
                                </div>
                            <?php } ?>
                            <div class="rounded-t bg-white mb-0 px-6 py-6">
                                <div class="text-center flex justify-between">
                                    <h6 class="text-blueGray-700 text-xl font-bold">
                                        view user details : <?php echo $user['name']; ?>
                                    </h6>
                                    <a href="users.php"
                                       class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                       type="button">
                                        Back to Users list
                                    </a>

                                </div>
                            </div>
                            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                <form action="process-edit-user.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                        User Information
                                    </h6>
                                    <div class="flex flex-wrap">
                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    User name
                                                </label>
                                                <div
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                       <?php echo $user['name']; ?> 
                            </div>      
                                          </div>
                                        </div>
                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    Email address
                                                </label>
                                                <div 
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                        <?php echo $user['email']; ?> 
                                            </div>
                                          </div>
                                        </div>
                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    Status
                                                </label>
                                                
                                                        
                                                     <div   class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                
                                                     <?php if ($user['status'] == 0) {
                                                        echo "InActive";
                                                    } ?> 
                                                     
                                                      <?php if ($user['status'] == 1) {
                                                        echo "Active";
                                                    } ?> 
                                                   
                                                </div> 
                                            </div>
                                        </div>

                                        
                                    </div>

                                     
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- content ends here.  -->
                    <?php include "layouts/footer.php"; ?>

                </div>
            </div>
        </div>

        <?php include "layouts/footer-scripts.php"; ?>
        </body>
        </html>

        <?php

    } else {
        header("Location: users.php?error='No user found with provided id {$id}");
        die();
    }
} else {
    header("Location: users.php?error='Url is invalid");
    die();
}