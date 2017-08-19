jQuery( document ).ready( function($) {

    $( '#form_like' ).on( 'submit', function(e) {
    //e.preventDefault();

        //.....
        //show some spinner etc to indicate operation in progress
        //.....

        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "post": $( '#post_id' ).val()
            },
            function( data ) {

                //do something with data/response returned by server
            },
            'json'
        );

        //.....
        //do anything else you might want to do
        //.....
        document.getElementById('submit').value = 'd';
        //prevent the form from actually submitting in browser
        e.preventDefault();
        return false;

    } );

} );