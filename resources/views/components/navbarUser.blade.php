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
.search-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px 20px; /* Sedikit lebih rapat agar rapi */
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.search-item:hover {
    background: #f8f8f8; /* Warna hover Discogs lebih soft */
}
.search-img {
    width: 60px; /* Ukuran sedikit lebih besar agar jelas */
    height: 60px;
    object-fit: cover;
    flex-shrink: 0; /* Mencegah gambar gepeng */
    /* Hapus border-radius dari sini karena akan diatur oleh JS */
}
.search-text {
    display: flex;
    flex-direction: column;
    color: black;
    line-height: 1.3;
}
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
.sidebar-col a {display: block;color: #aaa;margin: 20px 0; font-size: 16px;}
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

            <div onclick="openSidebar()" style="cursor: pointer; width: 32px; height: 32px; border-radius: 50%; overflow: hidden; display: flex; justify-content: center; align-items: center; background: #333;">
                @if(auth()->check() && auth()->user()->userProfile && auth()->user()->userProfile->image)
                    <img src="{{ asset('uploads/avatars/' . auth()->user()->userProfile->image) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Profile">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#e3e3e3">
                    <path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm146.5-204.5Q340-521 340-580t40.5-99.5Q421-720 480-720t99.5 40.5Q620-639 620-580t-40.5 99.5Q539-440 480-440t-99.5-40.5ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm100-95.5q47-15.5 86-44.5-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160q53 0 100-15.5ZM523-537q17-17 17-43t-17-43q-17-17-43-17t-43 17q-17 17-17 43t17 43q17 17 43 17t43-17Zm-43-43Zm0 360Z"/>
                    </svg>
                @endif
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
                        <li><a class="dropdown-item" >Most Collected</a></li>
                        <li><a class="dropdown-item" href="{{ route('releases.create') }}">Submit a Release</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Shop Music
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/mywants">Shop My Wants</a></li>
                        <li><a class="dropdown-item" href="#">Vinyl</a></li>
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
                        <li><a class="dropdown-item" href="/resources">More Seller Resources</a></li>
                        <li><a class="dropdown-item" href="/updates">Seller News & Updates</a></li>
                    </ul>
                </div>
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
        <h3>Hi, {{ auth()->user()->username }}</h3>
        <a href="/user/profile">View my profile</a>
    </div>

    <!-- CONTENT -->
    <div class="sidebar-content">

        <!-- LEFT -->
        <div class="sidebar-col">
            <h4>Shop Music</h4>
            <a href="/mywants">Shop My Wants</a>
            <a href="/sell/purchases">Purchases</a>

            <h4>Sell Music</h4>
            <a href="#">My Storefront</a>
            <a href="#">Inventory</a>
            <a href="#">Orders</a>
            <a href="#">List Item for Sale</a>

            <h4>Contribute</h4>
            <a href="#">Submissions</a>
            <a href="/user/drafts">Drafts</a>
        </div>

        <!-- RIGHT -->
        <div class="sidebar-col">
            <h4>Account</h4>
            <a href="#">Dashboard</a>
            <a href="#">Messages</a>
            <a href="/user/collection">Collection</a>
            <a href="/mywantlist">Wantlist</a>
            <a href="{{ auth()->check() ? route('user.lists', ['user_id' => auth()->id()]) : '/login' }}">Lists</a>
            <a href="#">Friends</a>
            <a href="#">Settings</a>
            <a href="#">Help</a>
            <a href="{{ url('/logout') }}">Log Out</a>
        </div>

    </div>
</div>

<script>
    const input = document.querySelector('input[type="text"]');
    const dropdown = document.getElementById('search-dropdown');
    const resultsBox = document.getElementById('search-results');
    const tabs = document.querySelectorAll('.tab');
    
    let currentTab = 'all';

    function performSearch() {
        let keyword = input.value.trim();

        if (keyword.length === 0) {
            dropdown.classList.add("hidden");
            resultsBox.innerHTML = "";
            return;
        }

        fetch(`/api/search?query=${encodeURIComponent(keyword)}&type=${currentTab}`)
            .then(response => response.json())
            .then(data => {
                resultsBox.innerHTML = ""; 

                if (data.length === 0) {
                    resultsBox.innerHTML = `<div class="p-6 text-black text-sm text-center">No results found for "<b>${keyword}</b>"</div>`;
                    dropdown.classList.remove("hidden");
                    return;
                }

                data.forEach(item => {
                    let div = document.createElement("div");
                    div.classList.add("search-item");

                    const imgStyle = item.category === 'artists' ? 'border-radius: 50%;' : 'border-radius: 4px;';
                    const titleColor = (item.category === 'artists' || item.category === 'master') ? 'color: #5e2d91;' : 'color: black;';
                    const src = (item.img && item.img !== '') ? item.img : 'https://via.placeholder.com/150';

                    div.innerHTML = `
                        <div style="width: 60px; height: 60px; flex-shrink: 0; overflow: hidden; ${imgStyle} border: 1px solid #eee;">
                            <img src="${src}" style="width: 100%; height: 100%; object-fit: cover; ${imgStyle}" alt="${item.name}" onerror="this.src='https://via.placeholder.com/150';">
                        </div>
                        <div class="search-text" style="display: flex; flex-direction: column; gap: 2px;">
                            <div style="font-size: 10px; font-weight: bold; text-transform: uppercase; color: #888; letter-spacing: 0.5px;">
                                ${item.type}
                            </div>
                            <div class="search-title" style="${titleColor} font-size: 15px; font-weight: 700; line-height: 1.2;">
                                ${item.name}
                            </div>
                            ${item.artist ? `<div style="font-size: 13px; color: black; font-weight: 500;">${item.artist}</div>` : ''}
                            ${item.meta ? `<div style="font-size: 12px; color: #666;">${item.meta}</div>` : ''}
                            ${item.year ? `<div style="font-size: 12px; color: #666;">${item.year}</div>` : ''}
                            ${item.price ? `<div style="font-size: 12px; color: #444; font-weight: bold;">${item.price}</div>` : ''}
                        </div>
                    `;

                    // ✅ pakai item.url dari backend
                    div.onclick = () => {
                        if (item.url) {
                            window.location.href = item.url;
                        }
                    };

                    resultsBox.appendChild(div);
                });

                dropdown.classList.remove("hidden");
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    input.addEventListener("keyup", performSearch);

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            currentTab = this.innerText.toLowerCase();
            if (input.value.trim().length > 0) {
                performSearch();
            }
        });
    });

    document.addEventListener("click", function(e) {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add("hidden");
        }
    });

    input.addEventListener("focus", function() {
        if (this.value.trim().length > 0) {
            dropdown.classList.remove("hidden");
        }
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
