<?php
// Start the session
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

include "db-connection.php";

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    $del = "DELETE FROM users  WHERE id='$id';";
    $delet = $conn->query($del);

    if ($delet) {
        header("Location: users.php?success='User deleted sucessfully!");
        die();
    } else {
        header("Location: users.php?error='Unable to delete");
        die();
    }
}

if (isset($_GET['page'])) {
    $current_page = $_GET['page']; //2
} else {
    $current_page = 1;
}

$per_page = 6;
$offset_value = (($current_page - 1) * $per_page);

$order_by = 'id';
$order = 'desc';

if (!empty($_GET['order_by'])) {
    $order_by = $_GET['order_by'];
}

if (!empty($_GET['order'])) {
    $order = $_GET['order'];
}

if (isset($_GET['s'])) {
    $s = $_GET['s'];


    $total_recordsResult = $conn->query("select count(*) as total_records from users where email like '%$s%';");
    $total_records = $total_recordsResult->fetch_assoc()['total_records'];

    $number_of_pages = ceil($total_records / $per_page);

    $sql = "select * from users where email like '%$s%' order by $order_by $order limit $per_page offset $offset_value";


} else {

    $total_recordsResult = $conn->query("select count(*) as total_records from users;");
    $total_records = $total_recordsResult->fetch_assoc()['total_records'];

    $number_of_pages = ceil($total_records / $per_page);

    $sql = "select * from users order by $order_by $order limit $per_page OFFSET $offset_value;";

}

$result = $conn->query($sql);
$title = "Users lists";

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
                                        Users ( <?php echo $total_records; ?> )
                                    </h3>
                                </div>
                                <div>
                                    <a href="export-user.php"
                                       class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                       type="button">
                                        Export CSV
                                    </a>
                                </div>
                                <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                    <form>
                                        <input
                                                type="text"
                                                name="s"
                                                value="<?php if (isset($_GET['s'])) {
                                                    echo $_GET['s'];
                                                } ?>"
                                                placeholder="Search in user email here..."
                                                onkeyup="getSearch(this.value)"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                                        />


                                        <div id="search-result"
                                             class="absolute p-5 border hidden bg-pink-600 text-white">

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
                                    <th class="px-6   bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        <?php if (!empty($_GET['order']) && $_GET['order'] == 'desc') { ?>
                                            <a href="?order_by=id&order=asc">Id <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-up inline-flex" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <desc>Download more icon variants from https://tabler-icons.io/i/caret-up</desc>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M18 15l-6 -6l-6 6h12"></path>
                                                </svg></a>
                                        <?php } else { ?>
                                            <a href="?order_by=id&order=desc">Id <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-down inline-flex" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <desc>Download more icon variants from https://tabler-icons.io/i/caret-down</desc>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M18 15l-6 -6l-6 6h12" transform="rotate(180 12 12)"></path>
                                                </svg></a>
                                        <?php } ?>
                                    </th>
                                    <th class="px-6 bg-blueGray-50 w-[300px] text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        <a href="?order_by=name">Name</a>
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        <a href="?order_by=email">Email id</a>
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Status
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr id="action_h_id_<?php echo $row['id']; ?>" class="action_hover h-20">
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            <?php echo $row['id']; ?>

                                        </td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php echo $row['name']; ?>

                                            <div id="action_div_<?php echo $row['id']; ?>" class="hidden">
                                                <div class="inline-flex pt-3">

                                                    <a href="edit-user.php?id=<?php echo $row['id']; ?>"
                                                       class="bg-indigo-500 text-white active:bg-indigo-600 text-[8px] font-bold uppercase px-1 py-0 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                       type="button">
                                                        Edit
                                                    </a>
                                                    <a href="view-user.php?id=<?php echo $row['id']; ?>"
                                                       class="bg-indigo-500 text-white active:bg-indigo-600 text-[8px] font-bold uppercase px-1 py-0 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                       type="button">
                                                        view
                                                    </a>
                                                    <form method="post">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $row['id']; ?>"/>
                                                        <button type="submit"
                                                                class="bg-red-500 text-white active:bg-red-600 text-[8px] font-bold uppercase px-1 py-0 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                                type="button">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php echo $row['email']; ?>
                                        </td>

                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php if ($row['status'] == 1) {
                                                echo "Active";
                                            } else {
                                                echo "InActive";
                                            } ?>
                                        </td>


                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <!-- This example requires Tailwind CSS v2.0+ -->
                            <div class=" border-b-1 bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">

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
                                            <?php for ($i = 1; $i <= $number_of_pages; $i++) {

                                                if (isset($_GET['s'])) {
                                                    ?>
                                                    <a href="?page=<?php echo $i; ?>&s=<?php echo $_GET['s']; ?>"
                                                       aria-current="page"
                                                       class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> <?php echo $i; ?> </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="?page=<?php echo $i; ?>" aria-current="page"
                                                       class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> <?php echo $i; ?> </a>
                                                    <?php
                                                }
                                            } ?>
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

    <script>
        (function () {
            $(".action_hover").on("mouseover", function () {
                $("#" + this.id.replace("action_h_id_", "action_div_")).show();
            });

            $(".action_hover").on("mouseout", function () {
                $("#" + this.id.replace("action_h_id_", "action_div_")).hide();
            });
        })();
    </script>

    <script>
        function getSearch(str) {
            $.ajax({
                url: "ajax-user.php?s=" + str,
            }).done(function (response) {
                response = JSON.parse(response);
                if (response.success) {
                    let users = response.data;

                    let ss = '<ul>';
                    users.forEach((user) => {
                        let my_li = "<li class='border-b-1 border-mycolor'>";

                        my_li = my_li + "<a href='edit-user.php?id=" + user.id + "'>" + user.name + " - " + user.email + "</a> &nbsp; ";
                        my_li = my_li + "</li>";
                        ss = ss + my_li;
                    });

                    ss = ss + "</ul>";

                    $("#search-result").html(ss);
                    $("#search-result").show();
                } else {
                    console.log("no result found.");
                    $("#search-result").hide();
                }

            });
        }
    </script>

    </body>
    </html>
<?php } else {
    header("Location: index.php?error='Please login first.");
    die();
}