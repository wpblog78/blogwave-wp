/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
        
        const menu = document.getElementById( 'primary-menu' );

        // Hide menu toggle button if menu is empty and return early.
        /*if ( 'undefined' === typeof menu ) {
                button.style.display = 'none';
                return;
        }*/             

        if ( ! menu.classList.contains( 'nav-menu' ) ) {
                menu.classList.add( 'nav-menu' );
        }

        // Get all the link elements within the menu.
        const links = menu.getElementsByTagName( 'a' );

        // Toggle focus each time a menu link is focused or blurred.
        for ( const link of links ) {
                link.addEventListener( 'focus', toggleFocus, true );
                link.addEventListener( 'blur', toggleFocus, true );
        }

        function toggleFocus() {
                if ( event.type === 'focus' || event.type === 'blur' ) {
                        let self = this;
                        // Move up through the ancestors of the current link until we hit .nav-menu.
                        while ( ! self.classList.contains( 'nav-menu' ) ) {
                                // On li elements toggle the class .focus.
                                if ( 'li' === self.tagName.toLowerCase() ) {
                                        self.classList.toggle( 'focus' );
                                }
                                self = self.parentNode;
                        }
                }
        }
}() );        