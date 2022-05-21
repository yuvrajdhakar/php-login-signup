<?php
// Start the session
session_start();

if($_SESSION['role'] !='admin'){
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

$per_page = 5;
$offset_value = (($current_page - 1) * 5);

if (isset($_GET['s'])) {
    $s = $_GET['s'];


    $total_recordsResult = $conn->query("select count(*) as total_records from users where email like '%$s%';");
    $total_records = $total_recordsResult->fetch_assoc()['total_records'];

    $number_of_pages = ceil($total_records / $per_page);

    $sql = "select * from users where email like '%$s%' limit $per_page offset $offset_value";


} else {

    $total_recordsResult = $conn->query("select count(*) as total_records from users;");
    $total_records = $total_recordsResult->fetch_assoc()['total_records'];

    $number_of_pages = ceil($total_records / $per_page);

    $sql = "select * from users limit $per_page OFFSET $offset_value;";

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
                                <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                    <form>
                                        <input
                                                type="text"
                                                name="s"
                                                value="<?php if (isset($_GET['s'])) {
                                                    echo $_GET['s'];
                                                } ?>"
                                                placeholder="Search in user email here..."
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                                        />
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
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Id
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Name
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Email id
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Status
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Action
                                    </th>
                                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            <?php echo $row['id']; ?>
                                        </th>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <?php echo $row['name']; ?>
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

                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <a href="edit-user.php?id=<?php echo $row['id']; ?>"
                                               class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                               type="button">
                                                Edit
                                            </a>
                                        </td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <a href="view-user.php?id=<?php echo $row['id']; ?>"
                                               class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                               type="button">
                                                view
                                            </a>
                                        </td>

                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">


                                            <form method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                <button type="submit"
                                                        class="bg-red-500 text-white active:bg-red-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                        type="button">
                                                    Delete
                                                </button>
                                            </form>

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
    </body>
    </html>
<?php } else {
    header("Location: index.php?error='Please login first.");
    die();
}