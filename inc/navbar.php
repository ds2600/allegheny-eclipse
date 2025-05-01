<?php
$current_page = basename($_SERVER['PHP_SELF']);
$base_url = ($current_page === 'index.php' || $current_page === '') ? '' : 'index.php';
?>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-container">
                <a href="<?php echo $base_url; ?>#hero" class="nav-logo">Allegheny Eclipse</a>
                <button class="nav-toggle" aria-label="Toggle navigation">
                    <span class="hamburger"></span>
                </button>
                <ul class="nav-menu">
                    <li><a href="<?php echo $base_url; ?>#hero">Home</a></li>
                    <li class="dropdown">
                        <a href="<?php echo $base_url; ?>#about">About</a>
<!--                        <ul class="dropdown-menu">
                                <li><a href="about.html">Mission</a></li>
                                <li><a href="<?php echo $base_url; ?>#team">Team</a></li>
                            </ul>
-->
                    </li>
                    <li><a href="<?php echo $base_url; ?>#calendar">Calendar</a></li>
                    <li><a href="<?php echo $base_url; ?>#support">Support</a></li>
                    <li><a href="<?php echo $base_url; ?>#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

