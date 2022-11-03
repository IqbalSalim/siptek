import "./bootstrap";
import '../css/app.css';


import Alpine from "alpinejs";
import flowbite from "flowbite";
import swal from "sweetalert";
import mapboxgl, {
    GeolocateControl
} from 'mapbox-gl';



window.Alpine = Alpine;

Alpine.start();





mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpcWJhbCIsImEiOiJjbDhncWNkdXkxbndsM3BxOWt2cGdleTg1In0.pBai260ADR-rPqGodqrxBQ';
var setting = {
    container: 'map', // container ID
    style: 'mapbox://styles/mapbox/streets-v11', // style URL
    center: [-24, 42],
    zoom: 1, // starting zoom
    projection: 'globe' // display the map as a 3D globe
};

var long = "1";
var lat = "";


function loadMapbox() {

    const map = new mapboxgl.Map(setting);


    const geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true,
        showUserHeading: true
    });

    // Add the control to the map.
    map.addControl(geolocate);


    map.on('style.load', () => {
        map.setFog({});
        map.resize(); // Set the default atmosphere style
        geolocate.trigger();
    });

    // geolocate.trigger();


    geolocate.on("geolocate", locateUser);

    function locateUser(e) {
        // console.log("A geolocate event has occurred.");
        // console.log("lng:" + e.coords.longitude + ", lat:" + e.coords.latitude);
        long = e.coords.longitude;
        lat = e.coords.latitude;
    }

}



function closeMapBox() {
    location.reload();
}

// document.getElementById("btn-modalDl").addEventListener("click", loadMapbox);
window.addEventListener('setMap', loadMapbox);
document.getElementById("btn-close-modalDl").addEventListener("click", closeMapBox);

document.getElementById("btn-submit-dlpre").addEventListener("click", () => {
    // const myFile = document.getElementById("myFile");
    // console.log(myFile.value);
    window.livewire.emit('setLonglat', long, lat);
});

window.addEventListener('runmaps', loadMapbox);
