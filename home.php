<?php
// Start the session
session_start();
include "utils/check-login.php";
include "db-connection.php";

if ($_SESSION['role'] == 'admin') {
    $total_recordsResult = $conn->query("select count(*) as total_records from pages;");
} else {
    $total_recordsResult = $conn->query("select count(*) as total_records from pages where author=" . $_SESSION['user_id'] . ";");
}

$total_records = $total_recordsResult->fetch_assoc()['total_records'];
//$total_pages = $total_recordsResult->fetch_assoc()['total_pages'];

if ($_SESSION['role'] == 'admin') {
    $jbl = $conn->query("select COUNT(*) as published FROM pages WHERE status ='published';");
} else {
    $jbl = $conn->query("select COUNT(*) as published FROM pages WHERE status ='published' and author=" . $_SESSION['user_id'] . ";");
}
$published = $jbl->fetch_assoc()['published'];

if ($_SESSION['role'] == 'admin') {
    $asdf = $conn->query("select COUNT(*) as draft FROM pages WHERE status ='draft';");
}else{
    $asdf = $conn->query("select COUNT(*) as draft FROM pages WHERE status ='draft' and author=" . $_SESSION['user_id'] . ";");
}
$draft = $asdf->fetch_assoc()['draft'];

if ($_SESSION['role'] == 'admin') {
    $total_recordsvalue = $conn->query("select count(*) as total_recordss from users;");
    $total_recordss = $total_recordsvalue->fetch_assoc()['total_recordss'];

    $total_a = $conn->query("select COUNT(*) as total_activs FROM users WHERE status =1;");
    $total_activs = $total_a->fetch_assoc()['total_activs'];

    $total_b = $conn->query("select COUNT(*) as total_inactivs FROM users WHERE status =0;");
    $total_inactivs = $total_b->fetch_assoc()['total_inactivs'];


    $total_paid = $conn->query("select COUNT(*) as paid FROM orders WHERE status ='paid';");
    $paid = $total_paid->fetch_assoc()['paid'];

    $products_qtyResult = $conn->query("SELECT product_id, sum(qty) as sum_qty FROM `orders` where status='paid' group by product_id;");
    $product_ids = "";
    $products_qty = [];

    while ($pqty = $products_qtyResult->fetch_assoc()) {
        $products_qty[$pqty['product_id']] = $pqty['sum_qty'];
        $product_ids = $product_ids . $pqty['product_id'] . ",";
    }

    $product_ids = rtrim($product_ids, ",");

    $price_Result = $conn->query("SELECT id,price FROM `products` where id IN ($product_ids);");
    $price_arry = [];

    while ($pp = $price_Result->fetch_assoc()) {
        $price_arry[$pp['id']] = $pp['price'];
    }

    $total_sales = 0;

    foreach ($products_qty as $key => $value) {
        $total_sales = $total_sales + ($value * $price_arry[$key]);
    }


    $first_day_this_month = date('Y-m-01 00:00:00'); // hard-coded '01' for first day
    $last_day_this_month = date('Y-m-t 12:00:00');

    $currentMonthProductQtyResult = $conn->query("SELECT product_id, sum(qty) as sum_qty FROM `orders` where status = 'paid' AND created_at BETWEEN '$first_day_this_month' and '$last_day_this_month'  group by product_id;");

    $currentMonth_product_ids = "";
    $currentmonth_products_qty = [];

    while ($currentMonthProductQtyRow = $currentMonthProductQtyResult->fetch_assoc()) {
        $currentmonth_products_qty[$currentMonthProductQtyRow['product_id']] = $currentMonthProductQtyRow['sum_qty'];
        $currentMonth_product_ids = $currentMonth_product_ids . $currentMonthProductQtyRow['product_id'] . ",";
    }

    $currentMonth_product_ids = rtrim($currentMonth_product_ids, ",");

    $current_month_price_Result = $conn->query("SELECT id,price FROM `products` where id IN ($currentMonth_product_ids);");
    $current_month_price_arry = [];

   if($current_month_price_Result){
       while ($current_month_price_row = $current_month_price_Result->fetch_assoc()) {
           $current_month_price_arry[$current_month_price_row['id']] = $current_month_price_row['price'];
       }
   }


    $current_month_total_sales = 0;

    foreach ($currentmonth_products_qty as $key => $value) {
        $current_month_total_sales = $current_month_total_sales + ($value * $current_month_price_arry[$key]);
    }

    $last_month = strtotime("last month");

    $first_day_last_month = date('Y-m-01 00:00:00', $last_month); // hard-coded '01' for first day
    $last_day_last_month = date('Y-m-t 12:00:00', $last_month);

// "SELECT product_id, sum(qty) as sum_qty FROM `orders` where status = 'paid' AND created_at BETWEEN '$first_day_last_month' and '$last_day_last_month' group by product_id;";

    $lastMonthProductQtyResult = $conn->query("SELECT product_id, sum(qty) as sum_qty FROM `orders` where status = 'paid' AND created_at BETWEEN '$first_day_last_month' and '$last_day_last_month'  group by product_id;");

    $lastMonth_product_ids = "";
    $lastmonth_products_qty = [];

    while ($lastMonthProductQtyRow = $lastMonthProductQtyResult->fetch_assoc()) {
        $lastmonth_products_qty[$lastMonthProductQtyRow['product_id']] = $lastMonthProductQtyRow['sum_qty'];
        $lastMonth_product_ids = $lastMonth_product_ids . $lastMonthProductQtyRow['product_id'] . ",";
    }

    $lastMonth_product_ids = rtrim($lastMonth_product_ids, ",");

    $last_month_price_Result = $conn->query("SELECT id,price FROM `products` where id IN ($lastMonth_product_ids);");
    $last_month_price_arry = [];

    while ($last_month_price_row = $last_month_price_Result->fetch_assoc()) {
        $last_month_price_arry[$last_month_price_row['id']] = $last_month_price_row['price'];
    }

    $last_month_total_sales = 0;

    foreach ($lastmonth_products_qty as $key => $value) {
        $last_month_total_sales = $last_month_total_sales + ($value * $last_month_price_arry[$key]);
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
            <div class="relative bg-pink-600   pb-32  ">
                <div class="px-4 md:px-10 mx-auto w-full">
                </div>
            </div>
            <!-- Header -->
            <div class="relative bg-pink-600   pb-32  ">
                <div class="px-4 md:px-10 mx-auto w-full">
                    <div>
                        <!-- Card stats -->
                        <div class="flex flex-wrap">
                            <?php if($_SESSION['role'] == 'admin'){ ?>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    Total users
                                                </h5>
                                                <span id="users_total" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $total_recordss; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                                                >
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 3.48%
                                    </span>
                                            <span class="whitespace-nowrap"> Since last week </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    Activ users
                                                </h5>
                                                <span id="total_activs" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $total_activs; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                                                >
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 3.48%
                                    </span>
                                            <span class="whitespace-nowrap">
                                    Since today
                                    </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    Inactivs users
                                                </h5>
                                                <span id="total_inactivs"
                                                      class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $total_inactivs; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                                                >
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 12%
                                    </span>
                                            <span class="whitespace-nowrap">
                                    Since today
                                    </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                      <?php } ?>
                           <?php if($_SESSION['role'] == 'admin'){ ?>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4  ">
                         <?php  }else{ ?>
                              <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-6 ">
                        <?php   }   
                           ?> 

                            <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    Total Pages
                                                </h5>
                                                <span id="total_pages" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $total_records; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                                                >
                                                    <i class="fa-solid fa-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 1.48%
                                    </span>
                                            <span class="whitespace-nowrap"> Since yesterday </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-6">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    published pages
                                                </h5>
                                                <span id="published" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $published; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                                                >
                                                    <i class="fa-solid fa-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 12%
                                    </span>
                                            <span class="whitespace-nowrap">
                                    Since today
                                    </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-6">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    draft pages
                                                </h5>
                                                <span id="draft" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $draft; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                                                >
                                                    <i class="fa-solid fa-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 12%
                                    </span>
                                            <span class="whitespace-nowrap">
                                    Since today
                                    </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php if($_SESSION['role'] == 'admin'){ ?>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-6">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    paid orders
                                                </h5>
                                                <span id="draft" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $paid; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                                                >
                                                    <i class="fa-solid fa-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 42%
                                    </span>
                                            <span class="whitespace-nowrap">
                                    Since today
                                    </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-6">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    total seals
                                                </h5>
                                                <span id="draft" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $total_sales; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                                                >
                                                    <i class="fa-solid fa-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 50%
                                    </span>
                                            <span class="whitespace-nowrap">
                                    Since today
                                    </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    crunt month seals
                                                </h5>
                                                <span id="draft" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $current_month_total_sales; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                                                >
                                                    <i class="fa-solid fa-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 50%
                                    </span>
                                            <span class="whitespace-nowrap">
                                    Since today
                                    </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-">
                                <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div
                                                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                                            >
                                                <h5
                                                        class="text-blueGray-400 uppercase font-bold text-xs"
                                                >
                                                    last month seals
                                                </h5>
                                                <span id="draft" class="font-semibold text-xl text-blueGray-700">
                                       <?php echo $last_month_total_sales; ?>
                                       </span>
                                            </div>
                                            <div class="relative w-auto pl-4 flex-initial">
                                                <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                                                >
                                                    <i class="fa-solid fa-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-blueGray-400 mt-4">
                                    <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-up"></i> 30%
                                    </span>
                                            <span class="whitespace-nowrap">
                                    Since today
                                    </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                             <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "layouts/footer.php"; ?>
        </div>
    </div>
    </div>
    <?php include "layouts/footer-scripts.php"; ?>
    </body>
    <script>
        function getData() {
            $.ajax({
                url: "ajax-home.php",
            }).done(function (response) {
                response = JSON.parse(response);
                if (response.success) {
                    let data = response.data;

                    $("#users_total").html(data.total_users);
                    $("#total_pages").html(data.total_pages);
                    $("#total_activs").html(data.total_activs);
                    $("#total_inactivs").html(data.total_inactivs);
                    $("#published").html(data.published);
                    $("#draft").html(data.draft);
                } else {
                    console.log("no result found.");
                }
            });
        }

        (function () {
            setInterval(getData, 10000);
        })();
    </script>
    </html>
<?php } else {
    header("Location: index.php?error='Please login first.");
    die();
}