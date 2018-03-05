<div class="hustle-shares-widget {{ ( _.isTrue(widget_animate_icons) ) ? 'hustle-shares-animated' : '' }}">
    
    <#
    if ( !_.isEmpty(social_icons) ) {
        _.each( social_icons, function( icon, key ){ #>
            <a data-social="{{key}}" href="{{ ( service_type === 'custom' ) ? icon.link : '#' }}" {{ ( service_type === 'custom' ) ? 'target="_blank"' : '' }} class="hustle-social-icon hustle-social-icon-{{service_type}} hustle-icon-{{icon_style}} {{ ( _.isFalse(customize_widget_colors) ) ? 'hustle-icon-' + key : '' }} {{ ( icon_style === 'flat' && ( service_type === 'native' && _.isTrue(click_counter) ) ) ? 'has-counter' : '' }} {{ ( service_type === 'native' && _.isTrue(click_counter) && _.isTrue(widget_inline_count) ) ? 'hustle-social-inline' : '' }}">

                <div class="hustle-icon-container">
                    
                    <# if ( key === 'facebook' ) { #>
                        <?php $this->render("general/icons/social/facebook"); ?>
                    <# } #>
                    <# if ( key === 'twitter' ) { #>
                        <?php $this->render("general/icons/social/twitter"); ?>
                    <# } #>
                    <# if ( key === 'google' ) { #>
                        <?php $this->render("general/icons/social/google"); ?>
                    <# } #>
                    <# if ( key === 'pinterest' ) { #>
                        <?php $this->render("general/icons/social/pinterest"); ?>
                    <# } #>
                    <# if ( key === 'reddit' ) { #>
                        <?php $this->render("general/icons/social/reddit"); ?>
                    <# } #>
                    <# if ( key === 'linkedin' ) { #>
                        <?php $this->render("general/icons/social/linkedin"); ?>
                    <# } #>
                    <# if ( key === 'vkontakte' ) { #>
                        <?php $this->render("general/icons/social/vkontakte"); ?>
                    <# } #>
                    <# if ( key === 'fivehundredpx' ) { #>
                        <?php $this->render("general/icons/social/fivehundredpx"); ?>
                    <# } #>
                    <# if ( key === 'houzz' ) { #>
                        <?php $this->render("general/icons/social/houzz"); ?>
                    <# } #>
                    <# if ( key === 'instagram' ) { #>
                        <?php $this->render("general/icons/social/instagram"); ?>
                    <# } #>
					<# if ( key === 'twitch' ) { #>
                        <?php $this->render("general/icons/social/twitch"); ?>
                    <# } #>      
					<# if ( key === 'youtube' ) { #>
                        <?php $this->render("general/icons/social/youtube"); ?>
                    <# } #>         
					<# if ( key === 'telegram' ) { #>
                        <?php $this->render("general/icons/social/telegram"); ?>
                    <# } #>         
                    
                </div>

                <# if ( service_type === 'native' && _.isTrue(click_counter) ) { #>

                    <div class="hustle-shares-counter"><span>{{ icon.counter }}</span></div>

                <# } #>

            </a>
    <#
        } );
    }
    #>

</div>