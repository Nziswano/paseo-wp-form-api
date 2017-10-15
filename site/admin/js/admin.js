jQuery(function($) {
    'use strict'
    $.ajax({
        method: 'GET',
        url: DEMO.api.url,
        beforeSend: function ( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', DEMO.api.nonce );
        }
    }).then( function ( r ) {
        if( r.hasOwnProperty( 'industry' ) ){
            $( '#industry' ).val( r.industry );
        }

        if( r.hasOwnProperty( 'amount' ) ){
            $( '#amount' ).val( r.amount );
        }
    });

    $( '#demo-form' ).on( 'submit', function (e) {
        e.preventDefault();
        var data = {
            amount: $( '#amount' ).val(),
            industry: $( '#industry' ).val()
        };

        $.ajax({
            method: 'POST',
            url: DEMO.api.url,
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader('X-WP-Nonce', DEMO.api.nonce);
            },
            data:data
        }).then( function (r) {
            $( '#feedback' ).html( '<p>' + DEMO.strings.saved + '</p>' );
        }, function (r) {
            var message = DEMO.strings.error;
            if( r.hasOwnProperty( 'message' ) ){
                message = r.message;
            }
            $( '#feedback' ).html( '<p>' + message + '</p>' );

        });
    });
});