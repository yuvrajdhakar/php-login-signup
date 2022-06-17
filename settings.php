<?php
session_start();

 

$title = "Manage Settings";

include "db-connection.php";

if (!empty($_POST['site_title'])) {
    $site_title = $_POST['site_title'];

    try{
        $resultTitleUpdate = $conn->query("Update settings set value = '$site_title' where name='site_title';");
        $setting_site_title = $site_title;
    }catch (Exception $e){
        echo $e->getMessage();
    }

    $copywrite_text = $_POST['copywrite_text'];
    $resultTitleUpdate = $conn->query("Update settings set value = '$copywrite_text' where name='copywrite_text';");
    $setting_copywrite_text = $copywrite_text;

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
                                Manage Page Settings :
                            </h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <form method="POST" enctype="multipart/form-data">
                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Settings
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                               htmlfor="site_title">
                                            site_title
                                        </label>
                                        <input type="text"
                                               name="site_title"
                                               id="site_title"
                                               class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                               value="<?php echo $setting_site_title; ?>">
                                    </div>
                                </div>

                                <?php if ($setting_site_logo) { ?>
                                    <div class="w-full px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                   htmlfor="image">
                                                Current Logo
                                            </label>
                                            <img src="<?php echo $setting_site_logo; ?>">
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                               htmlfor="image">
                                            Site logo
                                        </label>
                                        <input type="file"
                                               class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                               name="site_logo" id="site_logo">
                                    </div>
                                </div>

                                <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                               htmlfor="copywrite_text">
                                            Copywrite text
                                        </label>
                                        <textarea id="copywrite_text" name="copywrite_text"
                                                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        ><?php echo $setting_copywrite_text; ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <button type="submit"
                                    class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    type="button">
                                Update
                            </button>
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
