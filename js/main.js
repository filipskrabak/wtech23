$(document).ready(function(){
    $('#search').on("click",(function(e){
    $(".form-group").addClass("sb-search-open");
      e.stopPropagation()
    }));
     $(document).on("click", function(e) {
      if ($(e.target).is("#search") === false && $(".form-control").val().length == 0) {
        $(".form-group").removeClass("sb-search-open");
      }
    });
      $(".form-control-submit").click(function(e){
        $(".form-control").each(function(){
          if($(".form-control").val().length == 0){
            e.preventDefault();
            $(this).css('border', '2px solid red');
          }
      })
    })

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