<?php
session_start();

 

$title = "Plans";

include "db-connection.php";

$products = $conn->query("Select * from plans where status='published'");


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
                                Plans
                            </h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">

                        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                            Purchase your plan
                        </h6>
                        <div class="flex flex-wrap">
                            <div class="grid grid-cols-5 gap-4 p-4">
                                <?php
                                while ($product = $products->fetch_assoc()) {
                                    ?>
                                    <form action="plans-purchase.php" method="POST">
                                        <input type="hidden" name="plan_id" value="<?php echo $product['id']; ?>">
                                        <div class="img_div text-center border p-4 bg-white relative">
                                            <img class="" src="<?php echo $product['primary_image']; ?>">
                                            <div>
                                                <?php echo $product['description']; ?>
                                            </div>
                                            <div>
                                                <h3>Price: INR</h3>
                                            </div>
                                            <input type="number" name="qty" placeholder="Put quantity">
                                            <button type="submit"
                                                    class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                Purchase
                                            </button>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
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
</body>
</html>
