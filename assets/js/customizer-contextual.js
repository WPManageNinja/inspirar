( function( api ) {
    'use strict';

    api.bind( 'ready', function() {

        api( 'inspirar_copyright_section_content_c_one', function(setting) {
            var linkSettingValueToControlActiveState;

            /**
             * Update a control's active state according to the boxed_body setting's value.
             *
             * @param {api.Control} control Boxed body control.
             */
            linkSettingValueToControlActiveState = function( control ) {
                var visibility = function() {

                   if ( 'text' == setting.get() ) {
                        control.container.slideDown( 180 );
                    } else {
                        control.container.slideUp( 180 );
                    }
                };

                // Set initial active state.
                visibility();
                //Update activate state whenever the setting is changed.
                setting.bind( visibility );
            };

            // Call linkSettingValueToControlActiveState on the controls when they exist.


            api.control( 'inspirar_cloumn_one_custom_text', linkSettingValueToControlActiveState );
        });


        api( 'inspirar_copyright_section_content_c_two', function(setting) {
            var linkSettingValueToControlActiveState;

            /**
             * Update a control's active state according to the boxed_body setting's value.
             *
             * @param {api.Control} control Boxed body control.
             */
            linkSettingValueToControlActiveState = function( control ) {
                var visibility = function() {

                   if ( 'text' == setting.get() ) {
                        control.container.slideDown( 180 );
                    } else {
                        control.container.slideUp( 180 );
                    }
                };

                // Set initial active state.
                visibility();
                //Update activate state whenever the setting is changed.
                setting.bind( visibility );
            };

            // Call linkSettingValueToControlActiveState on the controls when they exist.
            api.control( 'inspirar_cloumn_two_custom_text', linkSettingValueToControlActiveState );
        });


         api( 'inspirar_copyright_section_content_c_three', function(setting) {
            var linkSettingValueToControlActiveState;

            /**
             * Update a control's active state according to the boxed_body setting's value.
             *
             * @param {api.Control} control Boxed body control.
             */
            linkSettingValueToControlActiveState = function( control ) {
                var visibility = function() {

                   if ( 'text' == setting.get() ) {
                        control.container.slideDown( 180 );
                    } else {
                        control.container.slideUp( 180 );
                    }
                };

                // Set initial active state.
                visibility();
                //Update activate state whenever the setting is changed.
                setting.bind( visibility );
            };

            // Call linkSettingValueToControlActiveState on the controls when they exist.
            api.control( 'inspirar_cloumn_three_custom_text', linkSettingValueToControlActiveState );
        });

    });

}( wp.customize ) );

