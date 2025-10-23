<?php
// Theme setup
function cloudboosta_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'cloudboosta_theme_setup');

// Enqueue styles
function cloudboosta_styles() {
    wp_enqueue_style('cloudboosta-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'cloudboosta_styles');

// Custom post type for services
function cloudboosta_services_post_type() {
    register_post_type('services',
        array(
            'labels' => array(
                'name' => 'Services',
                'singular_name' => 'Service'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-cloud'
        )
    );
}
add_action('init', 'cloudboosta_services_post_type');

// Add custom content on theme activation
function cloudboosta_create_default_content() {
    // Check if content already exists
    if (get_option('cloudboosta_content_created')) {
        return;
    }
    
    // Create home page
    $home_page = array(
        'post_title' => 'Welcome to Cloudboosta',
        'post_content' => '
        <section id="services" class="section">
            <div class="container">
                <h2>Our Cloud Solutions</h2>
                <div class="services">
                    <div class="service-card">
                        <h3>🚀 AWS Cloud Migration</h3>
                        <p>Seamless migration of your infrastructure to Amazon Web Services with zero downtime and optimized performance.</p>
                    </div>
                    <div class="service-card">
                        <h3>🐳 Docker Containerization</h3>
                        <p>Containerize your applications for consistent deployment across development, testing, and production environments.</p>
                    </div>
                    <div class="service-card">
                        <h3>⚙️ DevOps Automation</h3>
                        <p>Implement CI/CD pipelines, infrastructure as code, and automated testing for faster, reliable deployments.</p>
                    </div>
                    <div class="service-card">
                        <h3>🔒 Cloud Security</h3>
                        <p>Comprehensive security solutions including compliance management, identity access control, and threat monitoring.</p>
                    </div>
                    <div class="service-card">
                        <h3>☸️ Kubernetes Orchestration</h3>
                        <p>Container orchestration and management using Kubernetes for scalable, resilient application deployments.</p>
                    </div>
                    <div class="service-card">
                        <h3>📊 24/7 Monitoring</h3>
                        <p>Proactive monitoring and alerting systems to ensure optimal performance and rapid issue resolution.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="section about">
            <div class="container">
                <h2>About Cloudboosta</h2>
                <p style="text-align: center; font-size: 1.2rem; margin-bottom: 3rem;">
                    Founded in 2014, Cloudboosta has been at the forefront of cloud technology innovation. 
                    Our team of certified cloud architects and DevOps engineers helps businesses transform 
                    their digital infrastructure for scalability, security, and efficiency.
                </p>
                
                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span>Successful Migrations</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">99.9%</span>
                        <span>Uptime Guarantee</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <span>Years Experience</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span>Expert Support</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="section">
            <div class="container">
                <h2>Contact Cloudboosta</h2>
                <div class="contact-info">
                    <div style="text-align: center;">
                        <h3>📧 Email</h3>
                        <p>info@cloudboosta.com</p>
                        <p>support@cloudboosta.com</p>
                    </div>
                    <div style="text-align: center;">
                        <h3>📞 Phone</h3>
                        <p>+1 (555) 123-CLOUD</p>
                        <p>+1 (555) 123-2656</p>
                    </div>
                    <div style="text-align: center;">
                        <h3>🏢 Office</h3>
                        <p>123 Cloud Street</p>
                        <p>Tech Valley, CA 94000</p>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 2rem;">
                    <a href="mailto:info@cloudboosta.com" class="btn">Get Started Today</a>
                </div>
            </div>
        </section>',
        'post_status' => 'publish',
        'post_type' => 'page'
    );
    
    $page_id = wp_insert_post($home_page);
    
    // Set as front page
    update_option('show_on_front', 'page');
    update_option('page_on_front', $page_id);
    
    // Update site info
    update_option('blogname', 'Cloudboosta');
    update_option('blogdescription', 'Welcome to Cloudboosta');
    
    // Mark content as created
    update_option('cloudboosta_content_created', true);
}
add_action('after_switch_theme', 'cloudboosta_create_default_content');
?>