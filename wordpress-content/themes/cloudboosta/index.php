<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <nav class="container">
            <div class="logo">☁️ <?php bloginfo('name'); ?></div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'nav-menu',
                'container' => false,
                'fallback_cb' => false
            ));
            ?>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1><?php bloginfo('description'); ?></h1>
                <p>Your Trusted Cloud Solutions Partner</p>
                <p>Transforming businesses through innovative cloud technologies and DevOps excellence</p>
                <a href="#services" class="btn">Explore Our Services</a>
            </div>
        </section>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <section class="section">
                <div class="container">
                    <article>
                        <?php the_content(); ?>
                    </article>
                </div>
            </section>
        <?php endwhile; endif; ?>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            <p>Deployed with Docker & AWS EC2 - Professional Cloud Solutions</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    <?php wp_footer(); ?>
</body>
</html>