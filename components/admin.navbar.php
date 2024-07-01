<nav class="navbar">            
    <div class="navbar-container">
        <!--logo div-->
        <div class="navbar-logo-div">
            <a class="navbar-logo-link" href="#">
                <i class="fas fa-shield-dog"></i>
            </a>
            <button class="navbar-toggler"><i class='fas fa-solid fa-bars'></i></button>
        </div>

        <!--search input-->
        <input type="search" name="search" placeholder="Search..."
            class="navbar-search" id="search">
        
        <i id='icon-search' class="fas fa-regular fa-magnifying-glass"></i>

        <!--item list-->
        <ul class="menu-list">   
            <li class="menu-item">                        
                <a class="menu-link" href="#"> 
                    <i class="fas fa-solid fa-table"></i>
                    <span class="menu-link-text">Dashboard</span>                            
                </a>
            </li>
            <li class="menu-item">                        
                <a class="menu-link" href="#">
                    <i class="fas fa-solid fa-paw"></i>
                    <span class="menu-link-text">Pets</span>    
                </a>
            </li>
            <li class="menu-item">                        
                <a class="menu-link" class="menu-link" href="#">
                    <i class="fas fa-solid fa-user"></i>
                    <span class="menu-link-text">Customers</span>    
                </a>
            </li>
            <li class="menu-item">                            
                <a class="menu-link" href="#">
                    <i class="fas fa-regular fa-stethoscope"></i>
                    <span class="menu-link-text">Vets</span>    
                </a>
            </li>
            <li class="menu-item">                        
                <a class="menu-link" href="#">
                    <i class="fas fa-duotone fa-gear"></i>
                    <span class="menu-link-text">Settings</span>    
                </a>
            </li>
        </ul>
    </div>

    <!--div user info-->
    <div class="user-container">
        <div class="user-info">
            <i class="fas fa-solid fa-user-secret"></i>
            <div class="user-details">
                <h3 class="user-name">Eleanor Pena</h3>
                <p class="user-occupation">Veterinary</p>
            </div>
        </div>
        <a class="logout-btn" href="#">
            <i class="fas fa-sharp fa-regular fa-arrow-right-from-bracket"></i>
        </a>
    </div>
</nav>