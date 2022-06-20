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
                href="home.php"
        >
            <img src="<?php echo $setting_site_logo; ?>" alt="Sky e-Solutions">

            <!-- <?php echo $_SESSION['name']; ?>-->
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
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'home.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                        Dashboard
                    </a>
                </li>

                <?php
                if ($_SESSION['role'] == 'admin') { ?>
                    <li class="items-center">
                        <a
                                href="users.php"
                                class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'users.php') or endsWith($_SERVER['SCRIPT_NAME'], 'edit-user.php') or endsWith($_SERVER['SCRIPT_NAME'], 'view-user.php')) {
                                    echo 'text-pink-500 hover:text-pink-600';
                                } else {
                                    echo 'text-blueGray-700 hover:text-blueGray-500';
                                } ?>"
                        >
                            <i class="fas fa-tools mr-2 text-sm text-blueGray-300"></i>
                            Users
                        </a>
                    </li>
                <?php } ?>


                <li class="items-center">
                    <a
                            href="pages.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'pages.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                        Pages
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="pages-datatables.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'pages-datatables.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                        Pages DataTables
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="exchange.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'exchange.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                        Exchange
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="media.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'media.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                        Media
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="imagekit.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'imagekit.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                        Imagekit
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="checkout.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'checkout.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                        Checkout
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="orders-view.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'orders-view.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                       orders list
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="blog.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'blog.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                       post
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="plans.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'plans.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                        Plans
                    </a>
                </li>

                <li class="items-center">
                    <a
                            href="plans-list.php"
                            class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'plans-list.php')) {
                                echo 'text-pink-500 hover:text-pink-600';
                            } else {
                                echo 'text-blueGray-700 hover:text-blueGray-500';
                            } ?>"
                    >
                        <i
                                class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                        ></i>
                        Plans list
                    </a>
                </li>

                <?php
                if ($_SESSION['role'] == 'admin') { ?>
                    <li class="items-center">
                        <a
                                href="settings.php"
                                class="text-xs uppercase py-3 font-bold block <?php if (endsWith($_SERVER['SCRIPT_NAME'], 'settings.php')) {
                                    echo 'text-pink-500 hover:text-pink-600';
                                } else {
                                    echo 'text-blueGray-700 hover:text-blueGray-500';
                                } ?>"
                        >
                            <i
                                    class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
                            ></i>
                            Settings
                        </a>
                    </li>
                <?php } ?>
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