<div class="wrap">
    <div class="about-wrap">
        <h1>Welcome to Woodmart dashboard</h1>

        <div class="about-text">
            
            Thank you for purchasing our premium eCommerce theme - Woodmart. Here you are able
            to start creating your awesome web store by importing our dummy content and theme options.

        </div>

        <div class="woodmart-theme-badge">
            <img src="<?php echo WOODMART_ASSETS_IMAGES; ?>/woodmart-badge.png">
            <span><?php
                $theme_version = explode( '.', woodmart_get_theme_info( 'Version' ) );
                echo esc_html( $theme_version[0] . '.' . $theme_version[1] );
            ?></span> 
        </div>

        <p class="redux-actions">
            <a href="#" target="_blank" class="btn-docs button">Docs</a>
            <a href="#" target="_blank" class="btn-videos button">Video tutorials</a>
            <a href="#" class="btn-rate button" target="_blank">Rate our design</a>
            <a href="#" class="btn-support button button-primary" target="_blank">Support forum</a>
        </p>
    </div>

    <div class="woodmart-wrap-content">
                            
        <h2 class="nav-tab-wrapper">
            <?php foreach ($this->get_tabs() as $tab => $title): ?>
                <a class="nav-tab <?php if( $this->get_current_tab() == $tab ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( $this->tab_url( $tab ) ); ?>"><?php echo esc_html( $title ); ?></a> 
            <?php endforeach ?>
        </h2>

    
