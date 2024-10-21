<aside class="sidebar">
        <button type="button" class="sidebar-close-btn">
            <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
        </button>
        <div>
            <a href="index.php" class="sidebar-logo" style="margin-left:30%">
                <img src="assets/images/logowaste.png" alt="site logo" class="light-logo" >
                <img src="assets/images/logowaste.png" alt="site logo" class="dark-logo">
                <img src="assets/images/logowaste.png" alt="site logo" class="logo-icon">
            </a>
        </div>
        <div class="sidebar-menu-area">
            <ul class="sidebar-menu" id="sidebar-menu">
                <li >
                    <a href="index.php">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                        <span>Dashboard</span>
                    </a>  
                </li>

                <li class="dropdown" style="margin-top:15px;">
                    <a href="javascript:void(0)" data-toggle="submenu" data-target="#wasteTypeManagement">
                        <iconify-icon icon="akar-icons:trash-can" class="menu-icon"></iconify-icon>
                        <span>Waste Type Management</span>
                    </a>
                    <ul class="sidebar-submenu" id="wasteTypeManagement">
                        
                        
                        <li>
                            <a href="main-types.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Waste Types</a>
                        </li>

                        <li>
                            <a href="waste-breakdown.php"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Waste Type Breakdown</a>
                        </li>
                        
                        
                    </ul>
                </li>


                <li class="dropdown" style="margin-top:15px;">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                        <span>User Managment</span>
                    </a>
                    <ul class="sidebar-submenu">
                        
                        <li>
                            <a href="users.php"><i class="ri-circle-fill circle-icon text-orange w-auto"></i> User List</a>
                        </li>
                        
                        <li>
                            <a href="waste-type-indicator.php"><i class="ri-circle-fill circle-icon text-pink w-auto"></i>Past Waste Levels</a>
                        </li>

                        <li>
                            <a href="wate-leve-indicator.php"><i class="ri-circle-fill circle-icon text-green w-auto"></i> Waste Level Indicator</a>
                        </li>
                        
                    </ul>
                </li>

                <li class="dropdown" style="margin-top:15px;">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>Waste Area Analysis</span>
                    </a>
                    <ul class="sidebar-submenu">
                        
                        <li>
                            <a href="colombo-map.php"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Area Map</a>
                        </li>
                        
                        <li>
                            <a href="high-waste-areas.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> High Waste Area Indicator</a>
                        </li>
                        

                    </ul>
                </li>

                

                <li class="dropdown" style="margin-top:15px;">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="solar:pie-chart-outline" class="menu-icon"></iconify-icon>
                        <span>Advanced Reporting</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="advanced-waste-type.php"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Waste Generation Reports</a>
                        </li>
                        <li>
                            <a href="advanced-wate-cities.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> High Waste Area Report</a>
                        </li>
                       
                    </ul>
                </li>

                
                
            </ul>
        </div>
    </aside>