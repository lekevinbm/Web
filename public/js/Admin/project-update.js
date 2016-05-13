new Vue({
  el: '#project-update',

  data: {
    'project': []
  },

  ready: function(){
    this.fetchProject();
  },

  methods: {
    fetchProject: function(){
      var id = $('#project-update').attr('data-id');

      var This = this;

      this.$http.get('/json/project/' + id, function(project){
        this.$set('project', project);
        This.populateMap();
      });
    },

    populateMap: function(){
      var location = this.project.locatie.split(',');

      var lat = location[0];
      var lng = location[1];

      var thereIsAMarker = true;

      var map = new GMaps({
        el: '#admin-map',
        lat: 51.2154075,
        lng: 4.409795,
        zoom: 12
      });

      map.addMarker({
        lat: lat,
        lng: lng,
      });

      GMaps.on('click', map.map, function(event) {
        console.log(thereIsAMarker);

        if(thereIsAMarker){
          map.removeMarkers();
        }

        var index = map.markers.length;
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();

        $('#locatie-input').val(lat+','+lng);

        map.addMarker({
          lat: lat,
          lng: lng,
        });

        thereIsAMarker = true;


      });

    }
  },




});
