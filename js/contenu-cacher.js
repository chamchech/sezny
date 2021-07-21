  
  // BOUTON CACHER
  $(document).ready(function(){
        $(".buttons").click(function () {
        var div= $("#"+this.value);
              div.toggle("slow").siblings().hide("slow");
        });
    });


// FORMULAIRE VENTES : CHOIX FICHIERS
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

