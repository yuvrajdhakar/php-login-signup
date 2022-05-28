<?php
  


//$files = scandir("uploads");
//
//foreach ($files as $file) {
//    if($file != '.' && $file !='..'){
//        echo "<img src='uploads/$file'>";
//    }
//}


 
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

if (isset($_GET['s'])) {
    $s = $_GET['s'];

    $total_recordsResult = $conn->query("select count(*) as total_records from pages where title like '%$s%';");
    $total_records = $total_recordsResult->fetch_assoc()['total_records'];

    $number_of_pages = ceil($total_records / $per_page);


    $sql = "select pages.ID, pages.title, pages.status,  pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author where pages.title like '%$s%' limit $per_page offset $offset_value";


} else {

    if ($_SESSION['role'] == 'admin') {
        $total_recordsResult = $conn->query("select count(*) as total_records from pages;");
    } else {
        $total_recordsResult = $conn->query("select count(*) as total_records from pages where author=" . $_SESSION['user_id'] . ";");
    }


    $total_records = $total_recordsResult->fetch_assoc()['total_records'];

    $number_of_pages = ceil($total_records / $per_page);


    if ($_SESSION['role'] == 'admin') {
        $sql = "select pages.ID,pages.slug, pages.title, pages.status, pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author limit $per_page OFFSET $offset_value;";
    } else {
        $sql = "select pages.ID,pages.slug, pages.title, pages.status, pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author where pages.author=" . $_SESSION['user_id'] . " limit $per_page OFFSET $offset_value;";
    }
}

$result = $conn->query($sql);
$title = "Pages lists";

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
<div class="relative bg-pink-600 md:  pb-32  ">
     

    </div>
</div>

            <div class="px-4 md:pl-64 mx-auto w-full -m-24 pt-32">
                <!-- content start here -->
            
                <div class="grid grid-cols-5 gap-4">
            
                 <?php
                   $files = scandir("uploads");

                  foreach ($files as $file) {
            if($file != '.' && $file !='..'){
              echo "<img src='uploads/$file'>";
            
          }
      }
            ?>        
             </div>


                 <!-- content ends here.  -->
                <?php include "layouts/footer.php"; ?>
            </div>
        </div>
    </div>
    <?php include "layouts/footer-scripts.php"; ?>
     
    </body>
    </html>
<?php } else {
    header("Location: index.php?error='Please login first.");
    die();
}