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
<div class="relative bg-pink-600 md:pt-32 pb-32 pt-12">
    <div class="px-4 md:px-10 mx-auto w-full">

    </div>
</div>