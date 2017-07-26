  $(document).ready(function() {

		/*
		 *		CLIPBOARD
		 *
		 */

		var clipboard = new Clipboard('.copy');

		clipboard.on('success', function(e) {
		  
		snackbar('Copied to clipboard!');

		});



		/*
		 *		SHARE 
		 *
		 */


		var mediaId;
		var title;
		var description;
		var type;

		$( document ).on( "show.bs.modal", function( e ) {
			var button = e.relatedTarget;
			mediaId = button.id;
			type = button.dataset.type;
		});

		$('.publish').click(function(){

		    title = $('#title').val();
		    description = $('#description').val();

		    $('.publish').prop("disabled",true);

		    Pace.track(function(){
		        jQuery.ajax({
		            type: 'POST',
		            global: false,
		            url: window.base_url + 'api/share',
		            data: {media_id:mediaId,title:title,description:description,type:type},
		            dataType: 'text',
		            success: function(data) {

		                snackbar('Woohoo! Redirecting...');

		                $("#title").val('');
		                $('#description').val('');
		                $('#shareModal').modal('hide');

		                setTimeout(function () {
		                  window.location.href = window.base_url + 'showcase/' + data;
		                }, 1500); 

		                $('.publish').prop("disabled",false);

		            },
		            error: function(e) {
		              console.log(e);
		              $('.publish').prop("disabled",false);
		            }
		        });
		    });

		});



  });



  function snackbar(message) {
    
      var x = document.getElementById("snackbar")

      x.className = "show";

      x.innerHTML = message;

      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }