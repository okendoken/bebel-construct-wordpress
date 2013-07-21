<?php get_header(); ?>

    <nav class="navigation navigation-home">
        <div id="home-carousel-progress" class="progress progress-danger hidden-phone">
            <div class="bar" style="width: 0;"></div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <a id="menu-toggle" class="pull-right btn-navbar" href="#" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="text">Menu</span> <i class="icon-reorder icon-large"></i>
                </a>
                <ul class="nav nav-collapse collapse">
                    <li class="active">
                        <a href="index.html">
                            <span class="nav-item-title">Home</span>
                            <span class="nav-item-description">Get Started</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="nav-item-title">Features</span>
                            <span class="nav-item-description">Our Offers</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="page.html">Go to Page</a></li>
                            <li><a href="home_with_bottom.html">Home with Bottom</a></li>
                            <li><a href="#">Newsletter Form</a></li>
                            <li><a href="#">Custom Widgets</a></li>
                            <li><a href="#">Contact Form</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="clients.html">
                            <span class="nav-item-title">Clients</span>
                            <span class="nav-item-description">The Best</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="clients.html">Go to Clients Page</a></li>
                            <li><a href="home_with_bottom.html">Home with Bottom</a></li>
                            <li><a href="#">Newsletter Form</a></li>
                            <li><a href="#">Custom Widgets</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-item-title">Portfolio</span>
                            <span class="nav-item-description">Full of Stuff</span>
                        </a>
                    </li>
                    <li>
                        <a href="team.html">
                            <span class="nav-item-title">Team</span>
                            <span class="nav-item-description">Meet Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="blog.html">
                            <span class="nav-item-title">Blog</span>
                            <span class="nav-item-description">Read More</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-item-title">Contact Us</span>
                            <span class="nav-item-description">Let's Talk</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="home-carousel" class="home-carousel carousel slide" data-interval="10000">
        <div class="carousel-inner">
            <div class="item">
                <img src="images/img1.jpg" alt="">
            </div>
            <div class="item active">
                <img src="images/img2.jpg" alt="">
            </div>
            <div class="item">
                <img src="images/img3.jpg" alt="">
            </div>
        </div>
    </div>

<?php get_footer(); ?>