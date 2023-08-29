
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-sidebar w3-bar-block w3-dark-grey w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>
   
  
<ul class="sidebar-menu">
    <!-- Common menu items -->


    @can('role-list')
    <li>
        <a href="{{ route('roles.index') }}">Role List</a>
    </li>
    @endcan

    @can('product-list')
    <li>
         <a href="{{ route('products.index') }}">Product List</a> 
    </li>
    @endcan
    
    @can('user-list')
    <li>
         <a href="{{ route('users.index') }}">User List</a> 
    </li>
    @endcan

    

    <!-- Other common menu items -->









    <!-- Additional menu items based on permissions -->

    <!-- Other menu items -->
</ul>

 <!--<a href="users" class="w3-bar-item w3-button">Users</a>-->
 <!-- <a href="roles" class="w3-bar-item w3-button">Roles</a>
  <a href="products" class="w3-bar-item w3-button">Product</a>-->
  <a href="home" class="w3-bar-item w3-button">Home</a>
  <a href="logout" class="w3-bar-item w3-button">Logout</a>
</div>

<div>
  <button class="w3-button w3-white w3-xxlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <!--<h1>Animated Sidebar</h1>
    <p>Click on the "hamburger menu" to slide in the side navigation.</p>
    <p>W3.CSS provide the following animation classes if you want to experiment for yourself:</p>
    <p>w3-animate-left, w3-animate-top, w3-animate-bottom, w3-animate-right, w3-animate-opacity, w3-animate-zoom</p>-->
  </div>
</div>


<script>
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>
     
</body>
</html> 
