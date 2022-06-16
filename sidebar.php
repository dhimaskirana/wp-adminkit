<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?php echo site_url(); ?>">
            <span class="align-middle"><?php echo get_bloginfo('name'); ?></span>
        </a>
        <?php wp_nav_menu(array(
            'menu'   => 'sidebar',
            'menu_class' => 'sidebar-nav',
            'walker' => new wp_adminkit_walker_menu_sidebar()
        )); ?>
    </div>
</nav>