$( document ).ready( function($) {

    $( ".like_link" ).on( 'click', function(event) {
        event.preventDefault();

        //.....
        //show some spinner etc to indicate operation in progress
        //.....
        var t = event.target;
        //var yid = t.nodeName;
        var post_id = $(this).data('post_id');
        //var yid = t.attr('data-id');
        //token = $('meta[name="csrf-token"]').attr('content');
        //alert (post_id);
        $.post(
            '/new_like',
            {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "post_id": post_id
            },
            function( data ) {
                //$('.submit').html(data);
                 //alert( "Data Loaded: " + data.result );
                //do something with data/response returned by server
                var label = $('#label'+post_id);
                label.text("("+data.likes_count+")");
                var heart = $('#heart'+post_id);
                if (data.result == 'added')
                {
                    heart.removeClass("text-muted");
                    heart.addClass("text-primary");
                } else
                    {
                        heart.removeClass("text-primary");
                        heart.addClass("text-muted");
                    }
            },
            'json'
        );
        //.....
        //do anything else you might want to do
        //.....

        //skiborg dolboeb
        //alert( $( this ).find( 'input[name=_token]' ).val());
        //prevent the form from actually submitting in browser
        //e.preventDefault();
        return false;

    } );

} );