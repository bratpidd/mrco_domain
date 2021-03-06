function setLikesInfo(post_id)
{
    $.post(
        '/likes_getdata',
        {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "post_id": post_id
        },
        function( data ) {
            var ul = $('#hul'+post_id)[0];
            ul.innerHTML = '';
            var likers = data.likes_authors;
            likers.forEach(function(liker, i, likers)
            {
                var li = document.createElement("li");
                var anchor = document.createElement('a');
                anchor.appendChild(document.createTextNode(liker));
                anchor.setAttribute('href', 'newpost');
                li.appendChild(anchor);
                ul.appendChild(li);
            });

            var label = $('#label'+post_id);
            label.text(data.likes_count);

            var heart = $('#heart'+post_id);
            if (data.user_liked)
            {
                heart.removeClass("text-muted");
                heart.addClass("text-primary");
                heart.removeClass("fa-heart-o");
                heart.addClass("fa-heart");
            } else
            {
                heart.removeClass("text-primary");
                heart.addClass("text-muted");
                heart.removeClass("fa-heart");
                heart.addClass("fa-heart-o");
            }
        },
        'json'
    );
}

$( document ).ready( function($) {

    $('.hul').on('click', function(event)
    {
        event.stopPropagation();
    });

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
                 //alert( "Data Loaded: " + data.likes_authors);
                //do something with data/response returned by server
                setLikesInfo(post_id);

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