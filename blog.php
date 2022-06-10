<?php
session_start();
use GuzzleHttp\Client;

require "db-connection.php";

try {

    $client = new GuzzleHttp\Client();

    $response_api = $client->request("GET", "https://jsonplaceholder.typicode.com/posts");

    if ($response_api->getStatusCode() == 200) {

        $body = $response_api->getBody();

        $body_parsed = json_decode($body);

        
    } else {

    }

} catch (Exception $e) {

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
                               All posts :
                            </h6>
                        </div>
                    </div>
                    <div class="  px-4 lg:px-10 py-10 pt-0">
                        
                        <div class=" flex-inline gap-4 p-4">
                             
                            <?php
                            echo "<ul>";
                            foreach ($body_parsed as $item) {
                                ?>
                                
                                <li><a href="blog-view.php?id=<?php echo $item->id; ?>"><br> <?php echo $item->title; ?><hr></a></li>
                                    
                                <?php
                            }
                    
                            echo "</ul>";
                            
                    
                            
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
 
</body>
</html>

 


 

 
 