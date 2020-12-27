
window.DoHook = function()
{
  $('input').on("change",function()
  {
    $(this).attr("value", this.value );
  });

  $('textarea').on("change",function()
  {
    $(this).html(this.value );
  });
}

$( function() {
    $( ".sortable" ).sortable({
        placeholder: "ui-state-highlight",
        cursor: "move",
      });

      $( ".draggable" ).draggable({
        connectToSortable: ".sortable",
        cursor: "move",
        helper: "clone", /*function(){
            var el = $("<div></div>");
            el.append($('#sample0').html()).data("clone-id", "1");//$(this).attr("id"));
            el.tabs();
            return el;
          },*/
          stop:function(event,ui){
              var id = $(this).attr("id");

              $(ui.helper).html($('#sample'+id).html()).removeAttr('style').removeClass('ui-state-highlight');
              $(ui.helper).tabs();
              //$(ui.helper).addClass("sample");
              //$(ui.helper).attr("id","newId");

              DoHook();
            },
        revert: "invalid",
      });

    $( ".tabs" ).tabs();
  } );

window.sendData = function()
{
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
      url: '/test',
      cache: false,
      contentType: false,
      processData: false,
      data: {
        html: $(".sortable").html()
      },
      mimeType:'multipart/form-data',
      type: "post",
      success: function(url) {
        $('.mainpage').html($(".sortable").html());
      },
      error: function(data) {
          console.log(data);
      }
  });
}

DoHook();