$(document).ready(function(){
    $('#searchBarBtn').on("click",(function(e){
      if($('#searchBar').hasClass("d-none")) {
        $('#searchBar').removeClass("d-none");
        $('#floatingSearch').focus();
      }
      else {
        $('#searchBar').addClass("d-none");
      }

    }));

    $('.dropdown').on("mouseenter", function() {
      if($(window).width() > 576) {
        $( "a", this ).first().addClass('show')
        $( "a", this ).first().attr("aria-expanded","true");
        $( "div", this ).first().attr("data-bs-popper","none");
        $( "div", this ).first().addClass('show')
      }
    })

    $('.dropdown').on("mouseleave", function() {
        if($(window).width() > 576) {
          $( "a", this ).first().removeClass('show')
          $( "a", this ).first().attr("aria-expanded","false");
          $( "div", this ).first().removeAttr("data-bs-popper","none");
          $( "div", this ).first().removeClass('show')
        }
      })
  })

// Auto-Close BS alert
setTimeout(function () {

    $('#alert').alert('close');
}, 3000);
