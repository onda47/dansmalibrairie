function initialiser_google_map() {
    var latlng = new google.maps.LatLng(44.2043468, 0.6165540);
    //objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
    //de définir des options d'affichage de notre carte
    var options = {
        center: latlng,
        zoom: 18,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
     
    //constructeur de la carte qui prend en paramêtre le conteneur HTML
    //dans lequel la carte doit s'afficher et les options
    var carte = new google.maps.Map(document.getElementById("carte_google_map"), options);
    //création du marqueur
    var marqueur = new google.maps.Marker({
        position: new google.maps.LatLng(44.2043468, 0.6165540),
        map: carte
    });
}