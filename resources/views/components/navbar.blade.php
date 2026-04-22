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
            
            <a href="{{ route('sell.cart') }}" class="{{ request()->routeIs('sell.cart') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-cart-fill" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
            </a>

            @guest
            <a href="/login" 
            class="border border-white px-3 py-1 rounded-5 hover:bg-white hover:text-black transition no-underline text-white">
                Sign Up / Log In
            </a>
            @else
                <span>{{ auth()->user()->name }}</span>
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
                        <li><a class="dropdown-item" href="/sell/list">Vinyl</a></li>
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
                        <li><a class="dropdown-item" href="/showArtist">Essentials</a></li>
                        <li><a class="dropdown-item" href="#">Features</a></li>
                        <li><a class="dropdown-item" href="#">Most Valuable</a></li>
                        <li><a class="dropdown-item" href="#">Collecting</a></li>
                        <li><a class="dropdown-item" href="#">Audio Gear</a></li>
                    </ul>
            </div>

        </div>
    </div>

</nav>

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