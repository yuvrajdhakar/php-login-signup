<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

$title ="Edit User";
$id = $_GET['id'];

if ($id && !empty($id)) {
    include "db-connection.php";

    $result = $conn->query("Select * from pages where id=$id");

    if ($result) {
        $user = $result->fetch_assoc();

        ?>

        <!DOCTYPE html>
        <html>

        <?php include "layouts/head.php"; ?>

        <body class="text-blueGray-700 antialiased">
        <noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root">
            <?php include "layouts/nav.php"; ?>

            <div class="relative md:ml-64 bg-blueGray-50">
                <?php include "layouts/top.php"; ?>
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
                                        view pages details :
                                    </h6>
                                    <a href="pages.php"
                                       class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                       type="button">
                                        Back to pages list
                                    </a>

                                </div>
                            </div>
                            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                <form action="process-edit-pages.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                       page Information
                                    </h6>
                                    <div class="flex flex-wrap">
                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    title
                                                </label>
                                                <div type="text"
                                                       name="title"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                        <?php echo $user['title']; ?>
                                          </div>
                                        </div>
                                        </div>
                                      
                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    Status
                                                </label>
                                                 <div
                                                      name="status"
                                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                                        <?php echo $user['status']; ?> 
                                                 </div>
                                              
                                            </div>
                                        </div>

                                        <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                   htmlfor="grid-password">
                                                Content
                                            </label>
                                          <div
                                                     id="tiny" name="content"
                                                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            <?php echo $user['content'];?> 
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