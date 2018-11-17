$(window).scroll(function() {
    var nav = $('#nav');
    var top = 50;
    if ($(window).scrollTop() >= top) {
        nav.addClass('navbar-scroll navbar-light shadow');
        nav.removeClass('navbar-dark');
    } else {
        nav.removeClass('navbar-scroll navbar-light shadow');
        nav.addClass('navbar-dark');
    }
});

$(window).scroll(function() {
    var nav = $('#nav-transparent');
    var top = 50;
    if ($(window).scrollTop() >= top) {
        nav.addClass('navbar-scroll navbar-light shadow');
        nav.removeClass('navbar-transparent');
    } else {
        nav.removeClass('navbar-scroll navbar-light shadow');
        nav.addClass('navbar-transparent');
    }
});

$(window).scroll(function() {
    var nav = $('#nav-logo');
    var top = 50;
    if ($(window).scrollTop() >= top) {
        nav.addClass('logo-light');
    } else {
        nav.removeClass('logo-light');
    }
});

function initMap() {
  var mapOptions = {
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: true,
    fullscreenControl: false
  }

  mapOptions.center = new google.maps.LatLng(30.327260, -81.669082);
  map1 = new google.maps.Map(document.getElementById("mapWater"), mapOptions);
  mapOptions.center = new google.maps.LatLng(30.331653, -81.662290);
  map2 = new google.maps.Map(document.getElementById("mapChurch"), mapOptions);
}
