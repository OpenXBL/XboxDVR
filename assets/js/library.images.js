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
        mediaTpl = $(configData.find('templates > image').text());
        
        // we can now unlock the refreshing function
        configLoaded = true;
        
        // start loading profiles
        Library.loadMedia();
    }   

    function createItem(data) {

        var item = mediaTpl.clone();

        item.find('.thumbnail').attr('src', data.thumbnails[0].uri);
        item.find('#preview').attr('src', data.screenshotUris[0].uri);
        item.find('#uri').val(data.screenshotUris[0].uri);
        item.find('#fileSize').val(data.screenshotUris[0].fileSize);
        item.find('#savedByUser').val(data.savedByUser);
        item.find('#userCaption').val(data.userCaption);
        item.find('#titleId').val(data.titleId);
        item.find('#titleName').val(data.titleName);
        item.find('#screenshotId').val(data.screenshotId);
        item.find('.fa').addClass('fa-camera');
        item.find('#popup-preview').attr('data-target', '#previewModal-'+data.screenshotId);
        item.find('.modal').attr('id', 'previewModal-'+data.screenshotId);
        item.find('#download').attr('href', data.screenshotUris[0].uri);
        item.find('.modal-title').text(data.titleName);
        item.find('#screenshotUri').attr('src', data.screenshotUris[0].uri);
        item.find('.copy').attr('data-clipboard-text', data.screenshotUris[0].uri);

        if(data.is_shared)
        {
          item.find('.card-text').html('<span class="fa fa-xblio fa-share"></span> ' + data.titleName);
          item.find('.share').remove(); 
        }
        else
        {
          item.find('.card-text').text(data.titleName);
          item.find('.share').attr('id', data.screenshotId);
          item.find('.share').attr('data-type', 'image');            
        }

        return item;
    } 

    this.loadMedia = function() {
      Pace.track(function(){
        $.ajax({
          type: 'GET',
          url: window.base_url + 'api/dvr/screenshots',
          dataType: 'json',
          success: function(data) {

            $('.loading').hide();

            var items = data[0].screenshots;
   
            $.each (items, function (id) {
              $('#media-data').append(createItem(items[id]));
            });

          }
        });
      });
    }

}

$(document).ready(function() {
    Library = new Library();
    Library.init();
});