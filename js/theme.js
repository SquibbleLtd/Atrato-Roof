jQuery( document ).ready( function($) {
  // THE TEAM BLOCK

  $( '.att-link' ).click( function(e) {
    if ($( e.target ).is( '.att-linked-in a' ) ) {
      return false;
    }

    if (!$( '#att-popup' ).length) {
      $( 'body' ).append( '<div id="att-popup-backdrop" class="close-att-popup"></div><div id="att-popup"></div>' );
    }

    var dataarr = {
      'action': 'atr_get_team_popup',
      'team-member-id': $( this ).attr( 'data-team-id' )
    };

    $.ajax({
      url: atr_ajax_object.ajax_url,
      type: 'POST',
      data: dataarr,
      success: function(response){
        $( '#loading' ).hide();
        $( '#att-popup' ).html( response );
        $( '#att-popup-backdrop, #att-popup' ).fadeIn();
      },
      error: function(xhr, status, error){
        $( '#loading' ).hide();
        var errorMessage = xhr.status + ': ' + xhr.statusText
        alert( 'Error - ' + errorMessage );
      }
    });
  });

  $( 'body' ).on( 'click', '.close-att-popup' , function() {
    $( '#att-popup-backdrop, #att-popup' ).fadeOut();
  });
});
