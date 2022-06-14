<?php
// Start the session
session_start();

include "db-connection.php";

if (isset($_POST['ID']) && !empty($_POST['ID'])) {
    $id = $_POST['ID'];
    $del = "DELETE FROM pages  WHERE id='$id';";
    $delet = $conn->query($del);

    if ($delet) {
        header("Location: pages.php?success='Page deleted successfully!");
        die();
    } else {
        header("Location: pages.php?error='Unable to delete the page");
        die();
    }
}

if (isset($_GET['page'])) {
    $current_page = $_GET['page']; //2
} else {
    $current_page = 1;
}

$per_page = 5;
$offset_value = (($current_page - 1) * 5);

$order_by = 'ID';
$order = 'desc';

if (!empty($_GET['order_by'])) {
    $order_by = $_GET['order_by'];
}

if (!empty($_GET['order'])) {
    $order = $_GET['order'];
}

$order_by = "pages.".$order_by;


 
   // $sql = "select pages.ID, pages.title, pages.status,  pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author where pages.title like '%$s%' order by $order_by $order limit $per_page offset $offset_value";
   // $qll = "select orders.id, orders.produts-id, orders.qty, orders.status, orders.created_at, users.id as user_id, users.name as user_id, from orders INNER JOIN users on users.id = orders.user_id";

   $sql = "select * from orders";
 
//$sql = "select * from pages order by $order_by $order limit $per_page OFFSET $offset_value;";

$result = $conn->query($sql);
$title = "orders lists";

 
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
                 <div class="w-full  mb-12 xl:mb-0 px-4">

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
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-wrap items-center">
                                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                    <h3 class="font-semibold text-base text-blueGray-700">
                                        Pages  
                                    </h3> 
                                </div>
                                 
                                <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                    <form>
                                        <input
                                                type="text"
                                                name="s"
                                                value="<?php if (isset($_GET['s'])) {
                                                    echo $_GET['s'];
                                                } ?>"
                                                placeholder="Search in page title here..."
                                                onkeyup="getSearch(this.value)"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                                        />

                                        <div id="search-result"
                                             class="absolute p-5 border hidden bg-pink-600 text-white text-left">

                                        </div>
                                </div>
                                <div>
                                    <button type="submit"
                                            class="  bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            type="button">
                                        Search
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto"> 
                            <!-- Projects table -->
                            <table class="items-center w-full bg-transparent border-collapse">
                                <thead>
                                <tr>
                                    <th class="px-6     bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    <?php if (!empty($_GET['order']) && $_GET['order'] == 'desc') { ?>
                                            <a href="?order_by=id&order=asc">ID<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-up inline-flex" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <desc>Download more icon variants from https://tabler-icons.io/i/caret-up</desc>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M18 15l-6 -6l-6 6h12"></path>
                                                </svg></a>
                                        <?php } else { ?>
                                            <a href="?order_by=id&order=desc">ID<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-down inline-flex" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <desc>Download more icon variants from https://tabler-icons.io/i/caret-down</desc>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M18 15l-6 -6l-6 6h12" transform="rotate(180 12 12)"></path>
                                                </svg></a>
                                        <?php } ?>
                                    </th>
                                     
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                   products name
                                    </th>

                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Qty
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    status
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    created_at 
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    user name 
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                     Price
                                    </th>  
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Total Price
                                    </th> 
                                    
                                    

                            </thead>
                                <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {

                                    $product_id = $row['product_id'];

                                    $productsData = $conn->query("select * from products where id=$product_id");

                                    $productInfo = $productsData->fetch_assoc();
                                   
                                   
                                    $user_id = $row['user_id'];

                                    $usersdata = $conn->query("select * from users where id=$user_id");

                                    $userinfo =  $usersdata->fetch_assoc();
                                   
                                   ?>
                                     
                                    <tr>
                                        
                                        <td  class=" border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            <?php echo $row['id']; ?>
                                             
                                </td>
                                        
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                       <?php echo $productInfo['name']; ?>
                             </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php
                                            echo $row['qty'];
                                            //  $user_id = $row['author'];
                                            //  $user_result_q = $conn->query("SELECT * from users where id=$user_id");
                                            //   $user_details = $user_result_q->fetch_assoc();
                                            //   echo $user_details['name']." ".$user_details['email'];
                                            ?>
                                        </td>

                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php echo $row['status']; ?>
                                        </td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php echo $row['created_at']; ?>
                                        </td>

                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                           <?php echo $userinfo['name']; ?>
                                        </td>

                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php echo $productInfo['price']; ?>
                                        </td>

                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php echo $row['qty']*$productInfo['price']; ?>
                                        </td>
                                    </tr>     
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <!-- This example requires Tailwind CSS v2.0+ -->
                            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">

                                <div class=" sm:flex-1 sm:flex sm:items-center sm:justify-between">

                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                             aria-label="Pagination">
                                            <a href="#"
                                               class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Previous</span>
                                                <!-- Heroicon name: solid/chevron-left -->
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                                             

                                                 
                                                    
                                        </nav>
                                    </div>
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
 