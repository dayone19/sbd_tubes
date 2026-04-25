<style>
.subnav-wrapper{
    width:100%;
    background:#fff;
    border-top:1px solid #ddd;
    border-bottom:1px solid #ddd;
    margin-top:5px;
}
.subnav-content{
    width:96%;
    margin:auto;
    display:flex;
    gap:30px;
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
.subnav-content .right-link{
    margin-left:auto;
}
</style>

<div class="subnav-wrapper">
    <div class="subnav-content">

        <a href="#" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="/user/collection" class="{{ request()->is('user/collection') ? 'active' : '' }}">
            Collection
        </a>

        <a href="/mywantlist" class="{{ request()->is('mywantlist') ? 'active' : '' }}">
            Wantlist
        </a>

        <a href="#" class="{{ request()->is('lists') ? 'active' : '' }}">
            Lists
        </a>

        <a href="#" class="{{ request()->is('submissions') ? 'active' : '' }}">
            Submissions
        </a>

        <a href="#" class="{{ request()->is('drafts') ? 'active' : '' }}">
            Drafts
        </a>

        <a href="#" class="{{ request()->is('export') ? 'active' : '' }}">
            Export
        </a>

        <a href="#" class="right-link">Settings</a>

    </div>
</div>