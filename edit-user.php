<?php
session_start();

$id = $_GET['id'];

if ($id && !empty($id)) {
    include "db-connection.php";

    $result = $conn->query("Select * from users where id=$id");

    if ($result) {
        $user = $result->fetch_assoc();

        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <meta name="theme-color" content="#000000"/>

            <link
                    rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
            />

            <link rel="stylesheet" href="app.css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

            <title>Dashboard</title>
        </head>
        <body class="text-blueGray-700 antialiased">
        <noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root">
            <nav
                    class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
            >
                <div
                        class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
                >
                    <button
                            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                            type="button"
                            onclick="toggleNavbar('example-collapse-sidebar')"
                    >
                        <i class="fas fa-bars"></i>
                    </button>
                    <a
                            class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                            href="../../index.html"
                    >
                        <?php echo $_SESSION['name']; ?>
                    </a>
                    <ul class="md:hidden items-center flex flex-wrap list-none">
                        <li class="inline-block relative">
                            <a
                                    class="text-blueGray-500 block py-1 px-3"
                                    href="#pablo"
                                    onclick="openDropdown(event,'notification-dropdown')"
                            ><i class="fas fa-bell"></i
                                ></a>
                            <div
                                    class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                                    id="notification-dropdown"
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
                                        href="#pablo"
                                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                >Seprated link</a
                                >
                            </div>
                        </li>
                        <li class="inline-block relative">
                            <a
                                    class="text-blueGray-500 block"
                                    href="#pablo"
                                    onclick="openDropdown(event,'user-responsive-dropdown')"
                            >
                                <div class="items-center flex">
                  <span
                          class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
                  ><img
                              alt="<?php echo $_SESSION['name']; ?>"
                              class="w-full rounded-full align-middle border-none shadow-lg"
                              src="https://s.gravatar.com/avatar/<?php echo md5($_SESSION['email']); ?>?s=80"
                      /></span></div
                                >
                            </a>
                            <div
                                    class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                                    id="user-responsive-dropdown"
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
                        </li>
                    </ul>
                    <div
                            class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
                            id="example-collapse-sidebar"
                    >
                        <div
                                class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200"
                        >
                            <div class="flex flex-wrap">
                                <div class="w-6/12">
                                    <a
                                            class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                                            href="../../index.html"
                                    >
                                        Notus JS
                                    </a>
                                </div>
                                <div class="w-6/12 flex justify-end">
                                    <button
                                            type="button"
                                            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                            onclick="toggleNavbar('example-collapse-sidebar')"
                                    >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <form class="mt-6 mb-4 md:hidden">
                            <div class="mb-3 pt-0">
                                <input
                                        type="text"
                                        placeholder="Search"
                                        class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
                                />
                            </div>
                        </form>
                        <!-- Divider -->
                        <hr class="my-4 md:min-w-full"/>
                        <!-- Heading -->
                        <h6
                                class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
                        >
                            Admin Layout Pages
                        </h6>
                        <!-- Navigation -->

                        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                            <li class="items-center">
                                <a
                                        href="home.php"
                                        class="text-xs uppercase py-3 font-bold block text-pink-500 hover:text-pink-600"
                                >
                                    <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li class="items-center">
                                <a
                                        href="users.php"
                                        class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
                                >
                                    <i class="fas fa-tools mr-2 text-sm text-blueGray-300"></i>
                                    Users
                                </a>
                            </li>

                            <li class="items-center">
                                <a
                                        href="./tables.html"
                                        class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
                                >
                                    <i class="fas fa-table mr-2 text-sm text-blueGray-300"></i>
                                    Tables
                                </a>
                            </li>

                            <li class="items-center">
                                <a
                                        href="./maps.html"
                                        class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
                                >
                                    <i
                                            class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                                    ></i>
                                    Maps
                                </a>
                            </li>
                        </ul>

                        <!-- Divider -->
                        <hr class="my-4 md:min-w-full"/>

                        <!-- Navigation -->

                        <ul
                                class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
                        >
                            <li class="items-center">
                                <a
                                        href="logout.php"
                                        class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                                >
                                    <i
                                            class="fas fa-fingerprint text-blueGray-300 mr-2 text-sm"
                                    ></i>
                                    Logout
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="relative md:ml-64 bg-blueGray-50">
                <nav
                        class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4"
                >
                    <div
                            class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
                    >
                        <a
                                class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                                href="./index.html"
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
                                    href="#pablo"
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
                <div class="relative bg-pink-600 md:pt-32 pb-32 pt-12">
                    <div class="px-4 md:px-10 mx-auto w-full">

                    </div>
                </div>
                <div class="px-4 md:px-10 mx-auto w-full -m-24">
                    <!-- content start here -->

                    <div class="w-full px-4">
                        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                            <?php if(isset($_GET['success'])){ ?>
                                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                    <span class="font-medium">Success!</span> <?php echo $_GET['success']; ?>
                                </div>
                            <?php } ?>

                            <?php if(isset($_GET['error'])){ ?>
                                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                    <?php echo $_GET['error']; ?>
                                </div>
                            <?php } ?>
                            <div class="rounded-t bg-white mb-0 px-6 py-6">
                                <div class="text-center flex justify-between">
                                    <h6 class="text-blueGray-700 text-xl font-bold">
                                       Edit user details : <?php echo $user['name']; ?>
                                    </h6>
                                    <a href="users.php" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                            type="button">
                                        Back to Users list
                                    </a>

                                </div>
                            </div>
                            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                <form action="process-edit-user.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                        User Information
                                    </h6>
                                    <div class="flex flex-wrap">
                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    User name
                                                </label>
                                                <input type="text"
                                                       name="name"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       value="<?php echo $user['name']; ?>">
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    Email address
                                                </label>
                                                <input type="email"
                                                       name="email"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       value="<?php echo $user['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    Status
                                                </label>
                                                <select
                                                        name="status"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       >
                                                    <option value="0" <?php if($user['status']== 0){ echo "selected";} ?>>InActive</option>
                                                    <option value="1"  <?php if($user['status']== 1){ echo "selected";} ?>>Active</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="w-full lg:w-6/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                       htmlfor="grid-password">
                                                    New Password
                                                </label>
                                                <input type="text"
                                                       name="password"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       value="">
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                       type="button">
                                        Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- content ends here.  -->

                    <footer class="block py-4">
                        <div class="container mx-auto px-4">
                            <hr class="mb-4 border-b-1 border-blueGray-200"/>
                            <div
                                    class="flex flex-wrap items-center md:justify-between justify-center"
                            >
                                <div class="w-full md:w-4/12 px-4">
                                    <div
                                            class="text-sm text-blueGray-500 font-semibold py-1 text-center md:text-left"
                                    >
                                        Copyright © <span id="get-current-year"></span>
                                        <a
                                                href="https://www.creative-tim.com?ref=njs-dashboard"
                                                class="text-blueGray-500 hover:text-blueGray-700 text-sm font-semibold py-1"
                                        >
                                            Creative Tim
                                        </a>
                                    </div>
                                </div>
                                <div class="w-full md:w-8/12 px-4">
                                    <ul
                                            class="flex flex-wrap list-none md:justify-end justify-center"
                                    >
                                        <li>
                                            <a
                                                    href="https://www.creative-tim.com?ref=njs-dashboard"
                                                    class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                                            >
                                                Creative Tim
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                    href="https://www.creative-tim.com/presentation?ref=njs-dashboard"
                                                    class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                                            >
                                                About Us
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                    href="http://blog.creative-tim.com?ref=njs-dashboard"
                                                    class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                                            >
                                                Blog
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                    href="https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md?ref=njs-dashboard"
                                                    class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                                            >
                                                MIT License
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        <script
                src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
                charset="utf-8"
        ></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        <script type="text/javascript">
            /* Make dynamic date appear */
            (function () {
                if (document.getElementById("get-current-year")) {
                    document.getElementById(
                        "get-current-year"
                    ).innerHTML = new Date().getFullYear();
                }
            })();

            /* Sidebar - Side navigation menu on mobile/responsive mode */
            function toggleNavbar(collapseID) {
                document.getElementById(collapseID).classList.toggle("hidden");
                document.getElementById(collapseID).classList.toggle("bg-white");
                document.getElementById(collapseID).classList.toggle("m-2");
                document.getElementById(collapseID).classList.toggle("py-3");
                document.getElementById(collapseID).classList.toggle("px-6");
            }

            /* Function for dropdowns */
            function openDropdown(event, dropdownID) {
                let element = event.target;
                while (element.nodeName !== "A") {
                    element = element.parentNode;
                }
                Popper.createPopper(element, document.getElementById(dropdownID), {
                    placement: "bottom-start",
                });
                document.getElementById(dropdownID).classList.toggle("hidden");
                document.getElementById(dropdownID).classList.toggle("block");
            }

            (function () {
                /* Chart initialisations */
                /* Line Chart */
                var config = {
                    type: "line",
                    data: {
                        labels: [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                        ],
                        datasets: [
                            {
                                label: new Date().getFullYear(),
                                backgroundColor: "#4c51bf",
                                borderColor: "#4c51bf",
                                data: [65, 78, 66, 44, 56, 67, 75],
                                fill: false,
                            },
                            {
                                label: new Date().getFullYear() - 1,
                                fill: false,
                                backgroundColor: "#fff",
                                borderColor: "#fff",
                                data: [40, 68, 86, 74, 56, 60, 87],
                            },
                        ],
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        title: {
                            display: false,
                            text: "Sales Charts",
                            fontColor: "white",
                        },
                        legend: {
                            labels: {
                                fontColor: "white",
                            },
                            align: "end",
                            position: "bottom",
                        },
                        tooltips: {
                            mode: "index",
                            intersect: false,
                        },
                        hover: {
                            mode: "nearest",
                            intersect: true,
                        },
                        scales: {
                            xAxes: [
                                {
                                    ticks: {
                                        fontColor: "rgba(255,255,255,.7)",
                                    },
                                    display: true,
                                    scaleLabel: {
                                        display: false,
                                        labelString: "Month",
                                        fontColor: "white",
                                    },
                                    gridLines: {
                                        display: false,
                                        borderDash: [2],
                                        borderDashOffset: [2],
                                        color: "rgba(33, 37, 41, 0.3)",
                                        zeroLineColor: "rgba(0, 0, 0, 0)",
                                        zeroLineBorderDash: [2],
                                        zeroLineBorderDashOffset: [2],
                                    },
                                },
                            ],
                            yAxes: [
                                {
                                    ticks: {
                                        fontColor: "rgba(255,255,255,.7)",
                                    },
                                    display: true,
                                    scaleLabel: {
                                        display: false,
                                        labelString: "Value",
                                        fontColor: "white",
                                    },
                                    gridLines: {
                                        borderDash: [3],
                                        borderDashOffset: [3],
                                        drawBorder: false,
                                        color: "rgba(255, 255, 255, 0.15)",
                                        zeroLineColor: "rgba(33, 37, 41, 0)",
                                        zeroLineBorderDash: [2],
                                        zeroLineBorderDashOffset: [2],
                                    },
                                },
                            ],
                        },
                    },
                };
                var ctx = document.getElementById("line-chart").getContext("2d");
                window.myLine = new Chart(ctx, config);

                /* Bar Chart */
                config = {
                    type: "bar",
                    data: {
                        labels: [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                        ],
                        datasets: [
                            {
                                label: new Date().getFullYear(),
                                backgroundColor: "#ed64a6",
                                borderColor: "#ed64a6",
                                data: [30, 78, 56, 34, 100, 45, 13],
                                fill: false,
                                barThickness: 8,
                            },
                            {
                                label: new Date().getFullYear() - 1,
                                fill: false,
                                backgroundColor: "#4c51bf",
                                borderColor: "#4c51bf",
                                data: [27, 68, 86, 74, 10, 4, 87],
                                barThickness: 8,
                            },
                        ],
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        title: {
                            display: false,
                            text: "Orders Chart",
                        },
                        tooltips: {
                            mode: "index",
                            intersect: false,
                        },
                        hover: {
                            mode: "nearest",
                            intersect: true,
                        },
                        legend: {
                            labels: {
                                fontColor: "rgba(0,0,0,.4)",
                            },
                            align: "end",
                            position: "bottom",
                        },
                        scales: {
                            xAxes: [
                                {
                                    display: false,
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Month",
                                    },
                                    gridLines: {
                                        borderDash: [2],
                                        borderDashOffset: [2],
                                        color: "rgba(33, 37, 41, 0.3)",
                                        zeroLineColor: "rgba(33, 37, 41, 0.3)",
                                        zeroLineBorderDash: [2],
                                        zeroLineBorderDashOffset: [2],
                                    },
                                },
                            ],
                            yAxes: [
                                {
                                    display: true,
                                    scaleLabel: {
                                        display: false,
                                        labelString: "Value",
                                    },
                                    gridLines: {
                                        borderDash: [2],
                                        drawBorder: false,
                                        borderDashOffset: [2],
                                        color: "rgba(33, 37, 41, 0.2)",
                                        zeroLineColor: "rgba(33, 37, 41, 0.15)",
                                        zeroLineBorderDash: [2],
                                        zeroLineBorderDashOffset: [2],
                                    },
                                },
                            ],
                        },
                    },
                };
                ctx = document.getElementById("bar-chart").getContext("2d");
                window.myBar = new Chart(ctx, config);
            })();
        </script>
        </body>
        </html>

        <?php

    } else {
        header("Location: users.php?error='No user found with provided id {$id}");
        die();
    }
} else {
    header("Location: users.php?error='Url is invalid");
    die();
}