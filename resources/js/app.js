import $ from 'jquery';
window.$ = window.jQuery = $;

/*
  Starting the app
*/

$.app = {
  header: {
    toggleUser: function(){
        $('.user-nav nav').toggleClass('hidden-t');
    },
  },
  profileEdit: {
    onKeyDown: function(event, elm){
      const inputField = elm.attr('id');
      const inputFieldVal = elm.val();

      $('.profile-autofill ul li[data-id="'+ inputField +'"]').html('<span>'+inputFieldVal+'</span>');
    }
  },
  placeBid: {
    calculate: function() {
      const boxes = jQuery("#boxes").val();
      const price = jQuery("#priceinput").val();
      const bid = price * boxes;
      const fee = bid * 0.02;
      const total = bid + fee;

      $("#bid").html(bid);
      $("#fee").html(fee);
      $("#total").html(total);
    }
  }
}
