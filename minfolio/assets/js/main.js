
var MINFOLIO = MINFOLIO || {};

(function($){

	// USE STRICT
	"use strict";
        
        
        MINFOLIO.header = {
            
                init: function() {       
                   
                    MINFOLIO.header.menuItemTrigger();              
                    MINFOLIO.header.mobileMenuTrigger();                 
                    MINFOLIO.header.dropdownInvert();       
                    MINFOLIO.header.onePageScroll();        
                    MINFOLIO.header.initHeadsUp();
                    MINFOLIO.header.setSiteContentHeight();
                    MINFOLIO.header.scrollToTop();
                    
                },                 
                
                menuItemTrigger: function() {
                    
                    if( windowWidth < 991 ) {   
                        
                        $( '#top-menu' ).find( 'li.menu-item-has-children > a' ).off( 'click' );
                    
                        $( '#top-menu' ).find( 'li.menu-item-has-children > a' ).on( 'click', function( e ) {                           

                            if ( $( e.target ).is( 'i' ) || ( $( e.target ).is( 'a' ) && $( e.target ).attr( 'href' ).indexOf( '#' ) != -1 ) ) {  

                                $( this ).closest( 'li' ).siblings().find( 'ul.sub-menu' ).slideUp();
                                $( this ).closest( 'li' ).siblings().removeClass( 'active' );
                                $( this ).closest( 'li' ).children( 'ul.sub-menu' ).slideToggle();
                                $( this ).closest( 'li' ).toggleClass( 'active' );
                                
                                return false;
                            }

                        });
                    }
                    
                },          
                
                initHeadsUp: function() {
                    
                    if( headerEl.hasClass( 'sticky' ) ) {
                        
                       headsup({ duration: 0.3, easing: 'ease', delay: 0 });
                    }
                
                },    
                
                mobileMenuTrigger: function() {                 
            
                    if( mobile_menu_trigger.length > 0 ) {                        
                    
                        mobile_menu_trigger.on( 'click', function() {

                            $( this ).toggleClass( 'open' );
                            navigationEl.toggleClass( 'display-menu' );

                        });
                    }                    
                },                         
                
                dropdownInvert: function() {
                    
                    if( windowWidth > 991 ) {  
                    
                        const standard_menu = $( '#masthead.standard #top-menu' );                          
                        
                        standard_menu.find( 'ul[class*=invert-dropdown]' ).removeClass( 'invert-dropdown' );

                        const subMenus = standard_menu.find( 'ul' );                        

                        subMenus.css( 'display', 'block' ); 

                        subMenus.each( function ( index, element ) {                           

                            const menuDropdown    = $( element );
                            const windowWidth     = $( window ).width();                

                            const dropdownOffset  = menuDropdown.offset();
                            const dropdownWidth   = menuDropdown.width();
                            const dropdownLeft    = dropdownOffset.left;                                                                                          
                          
                            if ( windowWidth - ( dropdownWidth + dropdownLeft ) < 50 ) {                   
                                menuDropdown.addClass( 'invert-dropdown' );
                            }

                        });               

                        subMenus.css( 'display', '' ); 
                    
                    }
                    
                },   

                onePageScroll: function() {  
                    
                    $( navigationEl ).find( 'ul' ).on( 'click', function( e ) {                       
                 
                        if ( $( e.target ).is( 'a' ) &&  $( e.target ).attr( 'href' ).indexOf( '#' ) != -1 ) {  
                                             
                            const element = $( navigationEl ),
                                divAnchor = $( e.target ).attr('href'),
                                divScrollToAnchor = divAnchor.substring( divAnchor.indexOf( '#' ) + 1 );  
                            
                            if( divScrollToAnchor != '' ) {
                                
                                 element.find( 'li' ).removeClass( 'current-menu-item' );
                                 element.find( 'a[href$="' + divScrollToAnchor + '"]' ).parent( 'li' ).addClass( 'current-menu-item' );
                                
                                 if( windowWidth < 991  ) {
                                    mobile_menu_trigger.toggleClass( 'open' );
                                    navigationEl.toggleClass( 'display-menu', false );
                                }
                            }    
                            
                        }
                        
                    });                    
                    
                },           
                
                onePageCurrentSection: function() {
                    
                    let currentOnePageSection = '';      
                    const headerHeight = navigationEl.outerHeight();

                    pageSection.each( function( index ) {                        
                        
                        const h = $(this).offset().top;
                        const y = $ ( window ).scrollTop();
                        const offsetScroll = headerHeight;
                      
                        if ( $( this ).attr( 'id' ) != undefined && 
                             y + offsetScroll >= h && y < h + $( this ).height() && 
                             $( this ).attr( 'id' ) != currentOnePageSection ) {

                            currentOnePageSection = $(this).attr('id');                         
                        }

                    });

                    return currentOnePageSection;                    

                },
                
                onepageScroller: function() {
                    
                    const currentOnePageSection = MINFOLIO.header.onePageCurrentSection();
                    
                    if ( currentOnePageSection !== '' ) { 
                       
                       navigationEl.find( 'li' ).removeClass( 'current-menu-item' );
                       navigationEl.find( 'a[href$="#' + currentOnePageSection + '"]' ).parent( 'li' ).addClass( 'current-menu-item' );
                          
                    }
                    
                },                           
                
                setSiteContentHeight: function() {

                    if( ! body.hasClass( 'minfolio-core-active' ) ) {
                    
                        const windowHeight = $( window ).height();
                        const headerHeight = headerEl.outerHeight( true );
                        const footerHeight = $( '#footer' ).outerHeight( true );
                        
                        const site_content_height = windowHeight - ( headerHeight + footerHeight );
                              
                        if( windowWidth > 992 ) {                    
                            $( '#content' ).css( 'min-height', site_content_height );
                        }
                        else {
                            $( '#content' ).css( 'min-height', '' );
                        }

                    }
                    
                },       

                scrollToTop: function() {
                   
                    btnScrollTop.on( 'click', function (e) {

                        e.preventDefault();
                        
                        window.scroll({
                            top: 0,
                            left: 0,
                            behavior: 'smooth'
                        }); 

                    });                    

                }  
            
        };     
                 
        MINFOLIO.documentOnResize = {

            init: function() {
                    
                windowWidth = $( window ).width();                  
                    
                MINFOLIO.header.menuItemTrigger();   
                MINFOLIO.header.initHeadsUp();
                MINFOLIO.header.dropdownInvert();     
                MINFOLIO.header.setSiteContentHeight();
                   
            }

	    };
       
        
        MINFOLIO.documentOnReady = {           
            
            init: function() {          
                
                MINFOLIO.header.init();
                
                MINFOLIO.documentOnReady.windowscroll();     
                                                             
            },
            
            windowscroll: function() {  
               
                $( window ).on( 'scroll', function() {      
                    
                    if( body.hasClass( 'one-page' ) ) {
                        MINFOLIO.header.onepageScroller(); 
                    }    
                    
                    if ( $( window ).scrollTop() > 100 ) {  
                        btnScrollTop.addClass( 'active' );
                    }
                    else {
                        btnScrollTop.removeClass( 'active' );
                    }     

                });
                
            }
    
        };    
            
        const headerEl = $( '#masthead.site-header' );
        const navigationEl = $( '#site-navigation' );      
        const mobile_menu_trigger = $( '#menu-trigger-wrap' );       
        const pageSection = $( 'section[data-element_type="section"]' ); 
        const btnScrollTop = $( '#scrollToTop' );
                 
        const body = $( 'body' );                
        let windowWidth = $( window ).width();        
             
        
    $( document ).ready( MINFOLIO.documentOnReady.init );
    $( window ).on( 'resize', MINFOLIO.documentOnResize.init );
        
        
})(jQuery);        
