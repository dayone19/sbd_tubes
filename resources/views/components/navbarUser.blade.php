<style>
.btn-secondary {background-color: #191919 !important;border-color: #191919 !important;}
.dropdown-menu { background-color: #191919 !important;position: absolute;z-index: 9999;}
.btn-secondary:hover, .dropdown-item:hover {background-color: grey !important; color: white !important;}
.dropdown-item {color: grey !important;margin-top: 20px;margin-bottom: 20px;}
a {text-decoration: none !important;}
.search-dropdown {position: absolute;top: 110%;left: 0;width: 100%;background: white;border-radius: 20px;z-index: 9999;overflow: hidden;border-color:#ddd}
/* tabs */
.search-tabs {display: flex;gap: 25px;padding: 12px 20px;border-bottom: 1px solid black;}
.tab {cursor: pointer;color: #555;}
.tab.active {color: black;border-bottom: 2px solid black;}
/* item */
.search-item {display: flex;align-items: center;gap: 15px;padding: 15px 20px;border-bottom: 1px solid #ddd;cursor: pointer;}
.search-item:hover {background: #ddd;}
.search-img {width: 50px;height: 50px;border-radius: 50%;object-fit: cover;}
.search-text {display: flex; flex-direction: column; color: black;}
.search-title {font-weight: 600;}
.search-sub {font-size: 13px;color: #666;}
.hidden {display: none;}
/* sidebar */
#sidebar {position: fixed;top: 0;right: -420px;width: 360px;height: 100%;background: #111;color: white;padding: 20px;transition: 0.3s ease;z-index: 9999;overflow-y: auto;}
.sidebar-header h3 {font-size: 18px;font-weight: bold;}
.sidebar-header a {font-size: 14px;color: #ccc;}
.sidebar-content {display: flex;justify-content: space-between;margin-top: 20px;}
.sidebar-col {width: 48%;}
.sidebar-col h4 {margin-top: 20px;font-weight: bold;}
.sidebar-col a {display: block;color: #aaa;margin: 8px 0; font-size: 14px;}
.sidebar-col a:hover {color: white;}
.close-btn { font-size: 25px;float: right;cursor: pointer;}
#overlay {position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0,0,0,0.6);display: none;z-index: 9998;}
</style>

<nav class="bg-black text-white w-full" style="background-color: #191919 !important;">

    <!-- TOP NAV -->
    <div class="max-w-7xl mx-auto px-6 py-2 flex items-center justify-between">

        <!-- LEFT -->
        <div class="flex items-center gap-6">
            <a href="/" class="text-3xl font-extrabold tracking-tight no-underline text-white">
                Discogs
            </a>

            <form class="block relative">
                <input type="text"
                    placeholder="Search artists, albums and more..."
                    class="w-[650px] bg-gray-200 text-black placeholder-gray-600 
                        px-6 py-2 pr-14 rounded-full focus:outline-none">

                <button type="submit"class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-black">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"  viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                
                <div id="search-dropdown" class="search-dropdown hidden">
                    <!-- Tabs -->
                    <div class="search-tabs">
                        <span class="tab active">All</span>
                        <span class="tab">Releases</span>
                        <span class="tab">Artists</span>
                        <span class="tab">Labels</span>
                    </div>
                    <!-- Results -->
                    <div id="search-results"></div>
                </div>

            </form>
        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
            <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                <path d="M607.5-372.5Q660-425 660-500t-52.5-127.5Q555-680 480-680t-127.5 52.5Q300-575 300-500t52.5 127.5Q405-320 480-320t127.5-52.5Zm-204-51Q372-455 372-500t31.5-76.5Q435-608 480-608t76.5 31.5Q588-545 588-500t-31.5 76.5Q525-392 480-392t-76.5-31.5ZM214-281.5Q94-363 40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200q-146 0-266-81.5ZM480-500Zm207.5 160.5Q782-399 832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280q113 0 207.5-59.5Z"/>
            </svg>

            <a href="{{ route('sell.cart') }}" class="{{ request()->routeIs('sell.cart') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-cart-fill" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
            </a>

            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
            </svg>

            <div onclick="openSidebar()" style="cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#e3e3e3">
                <path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm146.5-204.5Q340-521 340-580t40.5-99.5Q421-720 480-720t99.5 40.5Q620-639 620-580t-40.5 99.5Q539-440 480-440t-99.5-40.5ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm100-95.5q47-15.5 86-44.5-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160q53 0 100-15.5ZM523-537q17-17 17-43t-17-43q-17-17-43-17t-43 17q-17 17-17 43t17 43q17 17 43 17t43-17Zm-43-43Zm0 360Z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <div class="border-t border-gray-700">
        <div class="max-w-7xl mx-auto px-6 py-2 flex items-center justify-between text-sm font-medium">
            <div class="flex gap-8">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Explore Discography
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/search">Explore All</a></li>
                        <li><a class="dropdown-item" href="/search/advanced">Advanced Search</a></li>
                        <li><a class="dropdown-item" href="#">Most Collected</a></li>
                        <li><a class="dropdown-item" href="#">Submit a Release</a></li>
                        <li><a class="dropdown-item" href="#">Submission Guidelines</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Shop Music
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Shop My Wants</a></li>
                        <li><a class="dropdown-item" href="#">New & Upcoming</a></li>
                        <li><a class="dropdown-item" href="/list">Vinyl</a></li>
                        <li><a class="dropdown-item" href="#">CD</a></li>
                        <li><a class="dropdown-item" href="#">Cassette</a></li>
                        <li><a class="dropdown-item" href="#">All Formats</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sell Music
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">List Item For Sale</a></li>
                        <li><a class="dropdown-item" href="/selling">Start Selling</a></li>
                        <li><a class="dropdown-item" href="/htg">How To Grade</a></li>
                        <li><a class="dropdown-item" href="#">How To Price</a></li>
                        <li><a class="dropdown-item" href="#">How To Pack & Ship</a></li>
                        <li><a class="dropdown-item" href="/resources">More Seller Resources</a></li>
                        <li><a class="dropdown-item" href="/updates">Seller News & Updates</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Community
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Forum</a></li>
                        <li><a class="dropdown-item" href="#">Groups</a></li>
                        <li><a class="dropdown-item" href="#">List Explorer</a></li>
                        <li><a class="dropdown-item" href="#">Discography Contributors</a></li>
                        <li><a class="dropdown-item" href="#">Monthly Leaderboard</a></li>
                        <li><a class="dropdown-item" href="#">Community Guidelines</a></li>
                    </ul>
                </div>
            </div>

            <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Digs
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Essentials</a></li>
                        <li><a class="dropdown-item" href="#">Features</a></li>
                        <li><a class="dropdown-item" href="#">Most Valuable</a></li>
                        <li><a class="dropdown-item" href="#">Collecting</a></li>
                        <li><a class="dropdown-item" href="#">Audio Gear</a></li>
                    </ul>
            </div>

        </div>
    </div>

</nav>

<!-- OVERLAY -->
<div id="overlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR -->
<div id="sidebar">
    <span class="close-btn" onclick="closeSidebar()">×</span>

    <!-- HEADER -->
    <div class="sidebar-header">
        <h3>Hi, sirenzz</h3>
        <a href="#">View my profile</a>
    </div>

    <!-- CONTENT -->
    <div class="sidebar-content">

        <!-- LEFT -->
        <div class="sidebar-col">
            <h4>Shop Music</h4>
            <a href="#">Shop My Wants</a>
            <a href="#">Purchases</a>

            <h4>Sell Music</h4>
            <a href="#">My Storefront</a>
            <a href="#">Inventory</a>
            <a href="#">Orders</a>
            <a href="#">List Item for Sale</a>

            <h4>Contribute</h4>
            <a href="#">Submissions</a>
            <a href="#">Drafts</a>
        </div>

        <!-- RIGHT -->
        <div class="sidebar-col">
            <h4>Account</h4>
            <a href="#">Dashboard</a>
            <a href="#">Messages</a>
            <a href="#">Collection</a>
            <a href="#">Wantlist</a>
            <a href="#">Lists</a>
            <a href="#">Friends</a>
            <a href="#">Settings</a>
            <a href="#">Help</a>
            <a href="/logout">Log Out</a>
        </div>

    </div>
</div>


<script>
const input = document.querySelector('input[type="text"]');
const dropdown = document.getElementById('search-dropdown');
const resultsBox = document.getElementById('search-results');

const data = [
    {
        name: "Ariana Grande",
        type: "Artist",
        img: "https://i.scdn.co/image/ab6761610000e5ebcdce7620dc940db079bf4952"
    },
];

input.addEventListener("keyup", function() {
    let keyword = this.value.toLowerCase();

    if (keyword.length === 0) {
        dropdown.classList.add("hidden");
        return;
    }

    let filtered = data.filter(item =>
        item.name.toLowerCase().includes(keyword)
    );

    resultsBox.innerHTML = "";

    filtered.forEach(item => {
        let div = document.createElement("div");
        div.classList.add("search-item");

        div.innerHTML = `
            <img src="${item.img}" class="search-img">
            <div class="search-text">
                <div class="search-title">${item.name}</div>
                <div class="search-sub">${item.type}</div>
            </div>
        `;

        resultsBox.appendChild(div);
    });

    dropdown.classList.remove("hidden");
});
</script>
<script>
function openSidebar() {
    document.getElementById("sidebar").style.right = "0";
    document.getElementById("overlay").style.display = "block";
}

function closeSidebar() {
    document.getElementById("sidebar").style.right = "-420px";
    document.getElementById("overlay").style.display = "none";
}
</script>
