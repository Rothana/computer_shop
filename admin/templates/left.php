<div id="menu-side">
    <ul>
        <li class="main-menu">Dashboard</li>
        <li><a href='index.php'>Home</a></li>
        <li><a href='../index.php' target="_blank">My Site</a></li>
    </ul>
    
    <ul>
        <li class="main-menu">Product</li>
        <li><a href='posts.php?p=new'>New Post</a></li>
        <li><a href='posts.php?p=show'>All Post</a></li>
    </ul>
    <ul>
        <li class="main-menu">Page</li>
        <li><a href='pages.php?p=new'>New Page</a></li>
        <li><a href='pages.php?p=show'>All Page</a></li>
    </ul>
    <ul>
        <li class="main-menu">Slider</li>
        <li><a href='slider.php'>Update Silder</a></li>
    </ul>
    <ul>
        <li class="main-menu">Advertise</li>
        <li><a href='advertise.php?p=new'>New Advertise</a></li>
        <li><a href='advertise.php?p=show'>All Advertise</a></li>
    </ul>
    
    <ul>
        <li class="main-menu">Category</li>
        <li><a href='category.php?p=new'>New Category</a></li>
        <li><a href='category.php?p=show'>All Categories</a></li>
    </ul>
    <?php if($_SESSION['rlntype']=="administrator"): ?>
    <ul>
        <li class="main-menu">User</li>
        <li><a href='users.php?p=new'>New User</a></li>
        <li><a href='users.php?p=show'>All Users</a></li>
    </ul>
    <?php endif; ?>
    
    <ul>
        <li class="main-menu">Logout</li>
        <li><a href='logout.php?p=logout'>Logout</a></li>
    </ul>

</div><!--end of menu-side -->