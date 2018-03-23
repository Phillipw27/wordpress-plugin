window.vimeography = window.vimeography || {};


/**
 * Set up the global namespace constructor for the "playlister"" theme.
 *
 * @param  object gallery_settings Object literal of all gallery settings.
 * @return object
 */
window.vimeography.playlister = function (gallery_settings) {
  this.gallery_settings = gallery_settings;
  this.utilities = new window.vimeography.utilities2();

  this.locate_elements(gallery_settings.gallery_id);
  this.setup_events();
};


/**
 * Finds the Vimeography theme elements and assigns them to properties
 *
 * @param  int gallery_id The unique id of the gallery currently being displayed.
 * @return void
 */
window.vimeography.playlister.prototype.locate_elements = function (gallery_id) {
  this.$gallery    = this.utilities.get_gallery(gallery_id);
  this.$player     = this.$gallery.find('.vimeography-player');
  this.$thumbnails = this.$gallery.find('.vimeography-thumbnails');
};


/**
 * Hooks up the necessary event callbacks
 *
 * @return void
 */
window.vimeography.playlister.prototype.setup_events = function () {
  this.$thumbnails.find('figure').eq(0).addClass('vimeography-active');

  this.bind_video_insert_toggle();

  if (typeof this.gallery_settings.containing_uri != 'undefined') {
    this.$thumbnails.find('a[data-uri="' + this.gallery_settings.containing_uri + '"]').trigger('click');
  }

  /** If we have a featured video, set the video ID so the API can find it */
  this.utilities.set_video_id(this.$player.find('iframe').prop('outerHTML'));

  if (typeof this.gallery_settings.pagination != 'undefined') {
    this.add_pagination();
  }

  if (typeof this.gallery_settings.playlist != 'undefined') {
    this.bind_playlist_listener();
    this.add_playlist();
  }
  this.$gallery.trigger('vimeography/video/ready');
};


/**
 * Defines the actions to perform when a specific element is interacted with
 *
 * @return void
 */
window.vimeography.playlister.prototype.bind_video_insert_toggle = function () {
  var _self = this;

  _self.$gallery.find('.vimeography-thumbnails').on('click', '.vimeography-video', function (e){
    _self.scroll_to_video( jQuery(this) );
    _self.set_video_data( jQuery(this) );
    _self.embed_video( jQuery(this).attr('href') );
    e.preventDefault();
  });
};


/**
 * [scroll_to_video description]
 * @param  {[type]} $target [description]
 * @return {[type]}         [description]
 */
window.vimeography.playlister.prototype.scroll_to_video = function ($target) {
  this.$thumbnails.stop().scrollTo( $target , 800 );
}


/**
 * Sets the video data inside of the Vimeography theme
 *
 * @param $object $thumbnail The video thumbnail that was clicked.
 */
window.vimeography.playlister.prototype.set_video_data = function ($thumbnail) {
  var _self = this;
  var title       = $thumbnail.data('title'),
      duration    = $thumbnail.data('duration'),
      description = $thumbnail.data('description'),
      downloads   = {
        hd: $thumbnail.data('download-hd'),
        sd: $thumbnail.data('download-sd'),
        mobile: $thumbnail.data('download-mobile'),
        source: $thumbnail.data('download-source')
      };

  /* Fade out the thumbnail overlay and add the active class to the new thumbnail */
  _self.$gallery.find('.vimeography-thumbnails .vimeography-active').removeClass('vimeography-active');
  $thumbnail.parent().addClass('vimeography-active');

  /* Set the template data */
  _self.$gallery.find('.vimeography-info h1').html(title);
  _self.$gallery.find('.vimeography-info h2').html(duration);
  _self.$gallery.find('.vimeography-info p').html(description);
  _self.$gallery.find('.vimeography-info .vimeography-download-links').empty();
  if (downloads.sd !== undefined) {
    $.each(downloads, function (type, link){
      if (link !== undefined) {
        _self.$gallery.find('.vimeography-info .vimeography-download-links').append('<a href="' + link + '" download="' + title + '" title="Download ' + title + '">' + type + '</a>');
      }
    });
  }
};


/**
 * Performs the HTTP oEmbed request for the Vimeo video
 * and embeds it once it has returned.
 *
 * @param  string link The URL of the vimeo video.
 * @return void
 */
window.vimeography.playlister.prototype.embed_video = function (link) {
  var _self = this;
  var container = _self.$player.parent();

  container.spin('custom');
  _self.$player.animate({'opacity':0}, 300, 'linear', function () {
    var promise = _self.utilities.get_video( link );

    promise.done(function (video) {
      /* This needs to be done so that the Vimeo API can interact with the player */
      video.html = _self.utilities.set_video_id(video.html);

      _self.$player.html(video.html).fitVids().animate({'opacity':1}, 300);
      container.spin(false);
      _self.$gallery.trigger('vimeography/video/ready');
    });
  });
};
    



/**
 * Performs the pagination request
 */
window.vimeography.playlister.prototype.add_pagination = function () {

  var _self = this;
  var pagination = new window.vimeography.pagination2(_self.gallery_settings.pagination);
  var last_page = Math.ceil(pagination.total / pagination.per_page);
  var is_fetching = false;

  _self.$thumbnails.bind('scroll', function() {
    if (!is_fetching && pagination.current_page != last_page && jQuery(this).scrollTop() + jQuery(this).innerHeight() >= this.scrollHeight - 200 ) {

      is_fetching = true;
      var element = jQuery('<div />').data('go-to', 'next');
      var promise = pagination.paginate(element);

      promise.done(function (response){
        is_fetching = false;
        if (response.result == 'success') {
          _self.$thumbnails.append(response.html);
        }
      });

    }
  });

};


/**
 * Performs the switch to the next video upon receiving the "vimeography/playlist/next" event
 *
 * @return void
 */
window.vimeography.playlister.prototype.bind_playlist_listener = function () {
  var _self = this;

  _self.$gallery.on('vimeography/playlist/next', function (){
    if ( document.webkitCancelFullScreen ) {
      document.webkitCancelFullScreen();
    }

    if ( document.webkitExitFullscreen ) {
      document.webkitExitFullscreen();
    }

    var $next_video = _self.$thumbnails.find('.vimeography-active').next();

    if ($next_video.length) {
      $next_video.find('.vimeography-video').trigger('click');
    }
  });
};


/**
 * Enables playlisting for the current Vimeography gallery.
 */
window.vimeography.playlister.prototype.add_playlist = function () {
  this.utilities.enable_autoplay = 1;
  this.utilities.enable_playlist(this.gallery_settings.gallery_id);
}


/**
 * Invoke the constructor for each Vimeography gallery 
 * that is using the playlister theme.
 *
 * @param  jQuery
 * @return void
 */
jQuery(function( $ ) {
  $.each(window.vimeography.galleries.playlister, function (index, gallery_settings){
    new window.vimeography.playlister(gallery_settings);
  });
});