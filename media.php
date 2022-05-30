<?php
// Start the session
session_start();

include "db-connection.php";

if (isset($_POST['path']) && !empty($_POST['path'])) {
    $is_delete = unlink($_POST['path']);
    if ($is_delete) {
        header("Location: media.php?success='Image deleted successfully!");
        die();
    } else {
        header("Location: media.php?error='Unable to delete the image");
        die();
    }
}

if ($_SESSION['user_id']) {
    ?>
    <!DOCTYPE html>
    <html>
    <?php include "layouts/head.php"; ?>

    <body class="text-blueGray-700 antialiased">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
        <?php include "layouts/nav.php"; ?>
        <div class="relative md:ml-64 bg-blueGray-50">
            <nav
                    class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4"
            >
                <div
                        class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
                >
                    <a
                            class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                            href=""
                    >Dashboard</a
                    >
                    <form
                            class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3"
                    >
                        <div class="relative flex w-full flex-wrap items-stretch">
                <span
                        class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
                ><i class="fas fa-search"></i
                    ></span>
                            <input
                                    type="text"
                                    placeholder="Search here..."
                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                            />
                        </div>
                    </form>
                    <ul
                            class="flex-col md:flex-row list-none items-center hidden md:flex"
                    >
                        <a
                                class="text-blueGray-500 block"

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
            <div class="relative bg-pink-600 pb-32">


            </div>
        </div>

        <div class="px-4 md:pl-64 mx-auto w-full -m-24 pt-32">
            <!-- content start here -->
               <div class="w-full   mb-12 xl:mb-0 px-4">

                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">

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
            <div class="grid grid-cols-5 gap-4">

                <?php
                $files = scandir("uploads");
                $i = 0;
                foreach ($files as $file) {
                    $i++;// $i = $i+1;
                    if ($file != '.' && $file != '..' && $file != '.DS_Store') {
                        ?>
                        <div class='img_div text-center border p-4' id="img_id_<?php echo $i; ?>">
                            <img  class="" src='uploads/<?php echo $file; ?>'>
                            <div id="form_id_<?php echo $i; ?>" class="hidden ">
                                <div class="inline-flex p-4">
                                    <button class="bg-indigo-500 text-white active:bg-indigo-600 text-[8px] font-bold uppercase px-1 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">View </button> &nbsp;
                                    <form method="post"
                                          onsubmit="return confirm('Are you sure to delete this image?');">
                                        <input type="hidden" name="path" value="uploads/<?php echo $file; ?>">
                                        <button type="submit"
                                                class="bg-red-500 text-white active:bg-red-600 text-[8px] font-bold uppercase px-1 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php

                    }
                }
                ?>
            </div>
            </div>
            </div>


            <!-- content ends here.  -->
            <?php include "layouts/footer.php"; ?>
        </div>
    </div>
    </div>
    <?php include "layouts/footer-scripts.php"; ?>

    <script>
        (function () {
            $(".img_div").on("mouseover", function () {

                let img_id = this.id;

                let form_id = img_id.replace("img_id_", "form_id_");

                $("#" + form_id).show();
            });

            $(".img_div").on("mouseout", function () {

                let img_id = this.id;

                let form_id = img_id.replace("img_id_", "form_id_");

                $("#" + form_id).hide();
            });
        })();
    </script>
    </body>
    </html>
<?php } else {
    header("Location: index.php?error='Please login first.");
    die();
}