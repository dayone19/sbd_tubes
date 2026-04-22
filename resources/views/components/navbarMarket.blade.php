<style>
/* SUBNAV */
.market-subnav {
    display: flex;
    align-items: center;
    padding: 8px 20px;
    border-bottom: 1px solid #ccc;
    background: white;
    gap: 20px; 
}

.market-subnav b {
    font-size: 20px;
}

.market-subnav .menu {
    display: flex;
    gap: 18px;
    margin-left: 10px;
}

.market-subnav a {
    color: #0b5ed7;
    font-size: 13px;
}

.market-subnav a.active {
    font-weight: bold;
    color: black;
}

.market-subnav input {
    padding: 6px 10px;
    border: 1px solid #ccc;
    width: 220px;
    margin-left:auto;
}
</style>
<div class="market-subnav">
    <b>Marketplace</b>

    <div class="menu">
        <a href="{{ route('sell.list') }}" class="{{ request()->routeIs('sell.list') ? 'active' : '' }}">
            All Items
        </a>

        <a href="#">Items I Want</a>

        <a href="#">Purchases</a>

        <a href="{{ route('sell.cart') }}" class="{{ request()->routeIs('sell.cart') ? 'active' : '' }}">
            Cart
        </a>
        
        <a href="#">Buyer Settings</a>
    </div>

    <input type="text" placeholder="Search Marketplace">
</div>