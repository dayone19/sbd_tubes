<style>
.subnav-wrapper{
    width:100%;
    background:#fff;
    border-bottom:1px solid #ddd;
    margin-top:5px;
    padding:0 25px;
}

.subnav-row{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
}

/* kiri: title + menu sejajar */
.subnav-left{
    display:flex;
    align-items:flex-end;
    gap:30px;
}

.market-title{
    font-size:18px;
    font-weight:bold;
    color:#111;
    padding-bottom:14px;
}

.subnav-content{
    display:flex;
    gap:25px;
    align-items:flex-end;
}

.subnav-content a{
    color:#2d5bd1;
    font-size:15px;
    padding:14px 0;
    text-decoration:none;
}

.subnav-content a.active{
    color:#000;
    font-weight:bold;
    border:1px solid #ddd;
    border-bottom:0;
    background:#fff;
    padding:14px 18px;
    margin-bottom:-1px;
}

/* kanan search */
.market-search input{
    padding:10px 15px;
    border:1px solid #000;
    width:230px; margin-bottom:10px;
}
.view-btn{
    padding:8px 14px;
    background:blue;
    color:#fff;
    border-radius:4px;
    cursor:pointer;
    margin-bottom:10px;
}
.view-btn:hover{
    background:#1f48d8;
}

</style>

<div class="subnav-wrapper">

    <div class="subnav-row">

        <!-- kiri -->
        <div class="subnav-left">

            <div class="market-title">Marketplace</div>

            <div class="subnav-content">

                <a href="{{ route('sell.list') }}"
                   class="{{ request()->routeIs('sell.list') ? 'active' : '' }}">
                   All Items
                </a>

                <a href="{{ route('mywants') }}"
                class="{{ request()->routeIs('mywants') ? 'active' : '' }}">
                Items I Want
                </a>

                <a href="{{ route('sell.purchases') }}"
                   class="{{ request()->routeIs('sell.purchases') ? 'active' : '' }}">
                   Purchases
                </a>

                <a href="{{ route('sell.cart') }}"
                   class="{{ request()->routeIs('sell.cart') ? 'active' : '' }}">
                   Cart
                </a>

                <a href="#">Buyer Settings</a>

            </div>

        </div>

        <!-- kanan -->
        <div class="market-search">

            @if(request()->routeIs('mywants'))
                <a href="/mywantlist">
                    <button class="view-btn">View your Wantlist</button>
                </a>
            @endif

            @if(request()->routeIs('sell.list'))
                <input type="text" placeholder="Search Marketplace">
            @endif

        </div>


    </div>

</div>