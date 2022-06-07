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

                                </div>
                                <div>
                                    <a href="export-pages.php"
                                       class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                       type="button">
                                        Export CSV
                                    </a>
                                </div>
                                <div>
                                    <a href="add-pages.php"
                                       class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                       type="button">
                                        Add New Page
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
                            <div class="table-responsive">
                                <table id="example" class="items-center w-full bg-transparent border-collapse">
                                    <thead>
                                    <tr>
                                        <th class="px-6  w-[300px]  bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            ID
                                        </th>
                                        <th class="px-6bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Title
                                        </th>
                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Status
                                        </th>
                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Author
                                        </th>
                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Date
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
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
        $(document).ready(function () {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                //  ajax: 'ajax-datatables-pages.php',
                ajax: 'ajax-dt-pages.php',
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
            });
        });

    </script>

    <script>
        function getSearch(str) {
            $.ajax({
                url: "ajax.php?s=" + str,
            }).done(function (response) {
                response = JSON.parse(response);
                if (response.success) {
                    let pages = response.data;

                    let ss = '<ul>';
                    pages.forEach((page) => {

                        let my_li = "<li class='border-b-1 border-mycolor py-1'>";

                        my_li = my_li + "<a href='edit-pages.php?id=" + page.ID + "'>" + page.title + "</a> &nbsp; ";

                        if (page.status === 'published') {
                            my_li = my_li + "<a class='bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150' target='_blank' href='page-view.php?slug=" + page.slug + "'>View Page</a>";
                        }

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