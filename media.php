<?php
session_start();

include "utils/check-login.php";

$title = "Manage Media";

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
                    <?php }

                    if (isset($_GET['error'])) { ?>
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                             role="alert">
                            <?php echo $_GET['error']; ?>
                        </div>
                    <?php } ?>
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Manage Media Images :
                            </h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div>
                            <form action="media-uplode-process.php" method="POST" enctype="multipart/form-data">
                                <div class="mt-8 flex justify-center absulate ">
                                    <div class="rounded-lg bg-gray-50  shadow-xl lg:w-1/2">
                                        <div class="m-4">
                                            <label class="mb-2 inline-block text-gray-500">Upload Image(jpg,png,svg,jpeg)</label>
                                            <div class="flex w-full items-center justify-center">
                                                <label htmlfor="image"
                                                       class="flex h-32 w-full flex-col border-4 border-dashed hover:border-gray-300 hover:bg-gray-100">
                                                    <div class="flex flex-col items-center justify-center pt-7">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="h-12 w-12 text-gray-400 group-hover:text-gray-600"
                                                             viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                  d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                                  clip-rule="evenodd"/>
                                                        </svg>
                                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                            Select a photo</p>
                                                    </div>
                                                    <input type="file" class="opacity-0" name="image" id="image" required="required"/>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="flex p-2 space-x-2">

                                            <button type="submit" class="px-2 py-1 text-white bg-green-500 rounded shadow-xl">submit
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="grid grid-cols-5 gap-4 p-4">

                            <?php
                            $files = scandir("uploads");
                            $i = 0;
                            foreach ($files as $file) {
                                $i++;// $i = $i+1;
                                if ($file != '.' && $file != '..' && $file != '.DS_Store') {
                                    ?>
                                    <div class='img_div text-center border p-4 bg-white relative'
                                         id="img_id_<?php echo $i; ?>">

                                        <img class="" src='uploads/<?php echo $file; ?>'>
                                        <div id="form_id_<?php echo $i; ?>"
                                             class="hidden absolute -top-[24px] -right-[19px]">
                                            <div class="inline-flex p-4">
                                                <form method="post"
                                                      onsubmit="return confirm('Are you sure to delete this image?');">
                                                    <input type="hidden" name="path"
                                                           value="uploads/<?php echo $file; ?>">
                                                    <button type="submit">
                                                        <a>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-trash stroke-red-700"
                                                                 width="24" height="24" viewBox="0 0 24 24"
                                                                 stroke-width="2" stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <desc>Download more icon variants from
                                                                    https://tabler-icons.io/i/trash
                                                                </desc>
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                      fill="none"></path>
                                                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                        </a>
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
