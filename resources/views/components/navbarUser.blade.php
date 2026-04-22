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

#sidebar {
    position: fixed;
    top: 0;
    right: -320px;
    width: 320px;
    height: 100%;
    background: #111;
    color: white;
    padding: 20px;
    transition: 0.3s;
    z-index: 9999;
}

#sidebar a {
    display: block;
    color: #aaa;
    margin: 10px 0;
}

#sidebar a:hover {
    color: white;
}

#sidebar h4 {
    margin-top: 20px;
    font-weight: bold;
}

.close-btn {
    font-size: 25px;
    float: right;
    cursor: pointer;
}

/* overlay */
#overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none;
    z-index: 9998;
}

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
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
            </svg>

            <a href="{{ route('sell.cart') }}" class="{{ request()->routeIs('sell.cart') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-cart-fill" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
            </a>

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
            </svg>

            @guest
            <a href="/login" 
            class="border border-white px-3 py-1 rounded-5 hover:bg-white hover:text-black transition no-underline text-white">
                Sign Up / Log In
            </a>
            @else
                
            @endguest
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

    <p>Hi, </p>

    <h4>Shop Music</h4>
    <a href="#">Shop My Wants</a>
    <a href="#">Purchases</a>

    <h4>Sell Music</h4>
    <a href="#">My Storefront</a>
    <a href="#">Inventory</a>
    <a href="#">Orders</a>

    <h4>Account</h4>
    <a href="#">Dashboard</a>
    <a href="#">Messages</a>
    <a href="#">Settings</a>
    <a href="/logout">Log Out</a>
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
    document.getElementById("sidebar").style.right = "-320px";
    document.getElementById("overlay").style.display = "none";
}
</script>
