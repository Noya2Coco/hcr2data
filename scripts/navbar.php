<?php
include_once('config.php');
$current_page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>


<div class="navbar">
    <div class="navbar-toggle" onclick="toggleNavbar()">
        <div class="bar">☰</div>
    </div>
    <ul class="navbar-menu" id="navbarMenu">
        <li <?php echo $current_page === '/' ? 'class="loaded"' : ''; ?>>
            <a href="/">
                <?php echo $lang['nav_home']; ?>
            </a>
        </li>

        <li <?php echo (strpos($current_page, '/dataMonthly') !== false || $current_page === '/chosenDataMonthly') ? 'class="loaded"' : ''; ?>>
            <a href="/dataMonthly">
                <?php echo $lang['nav_previous_months']; ?>
            </a>
        </li>

        <?php if (!$_SESSION["connected"]) { ?>
            <li <?php echo strpos($current_page, '/login') !== false ? 'class="loaded"' : ''; ?>>
                <a href="/login">
                    <?php echo $lang['nav_login']; ?>
                </a>
            </li>
        <?php } else { ?>
            <!-- Ajoutez la classe "loaded" aux éléments correspondant aux pages actuelles -->
            <li <?php echo strpos($current_page, '#') !== false ? 'class="loaded"' : ''; ?>>
                <a href="#">
                    <?php echo $lang['nav_export']; ?>
                </a>
            </li>
            <li <?php echo strpos($current_page, '#') !== false ? 'class="loaded"' : ''; ?>>
                <a href="#">
                    <?php echo $lang['nav_waiting_data']; ?>
                </a>
            </li>
            <li <?php echo strpos($current_page, '#') !== false ? 'class="loaded"' : ''; ?>>
                <a href="#">
                    <?php echo $lang['nav_all_data']; ?>
                </a>
            </li>
            <li <?php echo strpos($current_page, '/logout') !== false ? 'class="loaded"' : ''; ?>>
                <a href="/logout">
                    <?php echo $lang['nav_logout']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>

<script src="navbar.js"></script> 

