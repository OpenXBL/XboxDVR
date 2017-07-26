function Library() {

    var loadLock = false;
    var configLoaded = false;
    var configData;
    var mediaTpl;

    this.init = function() {

      jQuery.ajax({
          type: 'GET',
          global: false,
          url: window.base_url + 'assets/js/library.xml',
          dataType: 'xml',
          success: function(request, status) {
              configData = $(request);
              loadConfig();
          }
      });

    }

    function loadConfig() {
        
        // load templates
        mediaTpl = $(configData.find('templates > video').text());
        
        // we can now unlock the refreshing function
        configLoaded = true;
        
        // start loading profiles
        Library.loadMedia();
    }   

    function createItem(data) {

        var item = mediaTpl.clone();

        item.find('.thumbnail').attr('src', data.thumbnails[0].uri);
        item.find('.duration').text(data.durationInSeconds + 's');
        item.find('input#durationInSeconds').val(data.durationInSeconds);
        item.find('#uri').val(data.gameClipUris[0].uri);
        item.find('#fileSize').val(data.gameClipUris[0].fileSize);
        item.find('#savedByUser').val(data.savedByUser);
        item.find('#userCaption').val(data.userCaption);
        item.find('#titleId').val(data.titleId);
        item.find('#titleName').val(data.titleName);
        item.find('#gameClipId').val(data.gameClipId);
        item.find('.fa').addClass('fa-video-camera');
        item.find('#popup-preview').attr('data-target', '#previewModal-'+data.gameClipId);
        item.find('.modal').attr('id', 'previewModal-'+data.gameClipId);
        item.find('#download').attr('href', data.gameClipUris[0].uri);
        item.find('.modal-title').text(data.titleName);
        item.find('#clipUri').attr('src', data.gameClipUris[0].uri);
        item.find('#videojs').attr('poster', data.thumbnails[1].uri);
        item.find('.video-js').attr('id', 'video-js-'+data.gameClipId);
        item.find('.copy').attr('data-clipboard-text', data.gameClipUris[0].uri);

        if(data.is_shared)
        {
          item.find('.card-text').html('<span class="fa fa-xblio fa-share"></span> ' + data.titleName);
          item.find('.share').remove(); 
        }
        else
        {
           item.find('.card-text').text(data.titleName);
           item.find('.share').attr('id', data.gameClipId);
           item.find('.share').attr('data-type', 'video');             
        }

        return item;
    } 

    this.loadMedia = function() {
      Pace.track(function(){
        $.ajax({
          type: 'GET',
          url: window.base_url + 'api/dvr/gameclips',
          dataType: 'json',
          success: function(data) {

            $('.loading').hide();

            var items = data[0].gameClips;
            $.each (items, function (id) {
              $('#media-data').append(createItem(items[id]));
              videojs('#video-js-'+items[id].gameClipId);
            });

          }
        });
      });
    }

}

$(document).ready(function() {
    Library = new Library();
    Library.init();

    $( document ).on( "hidden.bs.modal", function( event, ui ) {
      $("video").each(function(){ this.pause() });
    });

});