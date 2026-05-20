<style>
.sidebar{
    width:200px;
}
.sidebar ul{
    list-style:none;
    padding:0;
    margin-left:10px;
}
.sidebar li{
    margin-bottom:8px;
}
.sidebar a{
    display:block;
    padding:10px 18px;
    font-size:15px;
    text-decoration:none;
    border-radius:4px;
    transition:0.2s;
}
.sidebar a:hover{
    background:#e7e7e7;
    color:#0066cc;
}
.sidebar a.active {
    font-weight: bold;
    background: transparent;
}
</style>

<!-- SIDEBAR -->
<div class="sidebar">
    <ul>
        <li>
            <a href="/settings/user" class="{{ Request::is('settings/user') ? 'active' : '' }}">User</a>
        </li>
        <li>
            <a href="/settings/buyer" class="{{ Request::is('settings/buyer') ? 'active' : '' }}">Buyer</a>
        </li>
    </ul>
</div>