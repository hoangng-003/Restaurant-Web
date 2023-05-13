$(document).ready(function () {
    function getDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3; // bán kính Trái đất (đơn vị mét)
        const φ1 = toRadians(lat1);
        const φ2 = toRadians(lat2);
        const Δφ = toRadians(lat2 - lat1);
        const Δλ = toRadians(lon2 - lon1);

        const a =
            Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(Δλ / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const d = R * c;

        return d;
    }

    function toRadians(degrees) {
        return degrees * (Math.PI / 180);
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        //index.php
        for (const element of $('.distance')) {
            let result = getDistance(element.attributes['latitude'].value, element.attributes['longitude'].value,
                position.coords.latitude, position.coords.longitude);
            result = Math.round(result);
            element.textContent = result.toString().concat('m');
        }
        //index.php
        for (const element of $('.featured-restaurants-distance')) {
            let result = getDistance(element.attributes['latitude'].value, element.attributes['longitude'].value,
                position.coords.latitude, position.coords.longitude);
            result = Math.round(result);
            element.textContent = result.toString().concat('m');
        }
        //restaurants.php
        for (const element of $('.restaurant-entry .list-inline-item-distance')) {
            let result = getDistance(element.attributes['latitude'].value, element.attributes['longitude'].value,
                position.coords.latitude, position.coords.longitude);
            result = Math.round(result);
            element.textContent = result.toString().concat('m');
        }
        for (const element of $('.inner-page-hero .container .nav-item.nav-item-distance')) {
            let result = getDistance(element.attributes['latitude'].value, element.attributes['longitude'].value,
                position.coords.latitude, position.coords.longitude);
            result = Math.round(result);
            element.textContent = result.toString().concat('m');
        }
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                console.log("User denied the request for Geolocation.");
                $('.distance').hide();
                $('.featured-restaurants-distance').hide();
                $('.restaurant-entry .list-inline-item-distance').hide();
                break;
            case error.POSITION_UNAVAILABLE:
                console.log("Location information is unavailable.");
                $('.distance').hide();
                $('.featured-restaurants-distance').hide();
                $('.restaurant-entry .list-inline-item-distance').hide();
                break;
            case error.TIMEOUT:
                console.log("The request to get user location timed out.");
                $('.distance').hide();
                $('.featured-restaurants-distance').hide();
                $('.restaurant-entry .list-inline-item-distance').hide();
                break;
            case error.UNKNOWN_ERROR:
                console.log("An unknown error occurred.");
                $('.distance').hide();
                $('.featured-restaurants-distance').hide();
                $('.restaurant-entry .list-inline-item-distance').hide();
                break;
        }
    }
    getLocation();
});
