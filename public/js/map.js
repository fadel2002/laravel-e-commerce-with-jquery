$(document).ready(function () {
    $("#location-button").click(function () {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                console.log(
                    position.coords.latitude,
                    position.coords.longitude
                );
                window.open(
                    `https://google.com/maps?q=${position.coords.latitude}, ${position.coords.longitude}`,
                    "_blank"
                );
            },
            (err) => {
                console.log(err);
            },
            {
                enableHighAccuracy: false,
                maximumAge: 0,
            }
        );

        // let i = 0;
        // navigator.geolocation.watchPosition(
        //     (position) => {
        //         console.log(
        //             position.coords.latitude,
        //             position.coords.longitude,
        //             i++
        //         );
        //         // window.open(
        //         //     `https://google.com/maps?q=${position.coords.latitude}, ${position.coords.longitude}`,
        //         //     "_blank"
        //         // );
        //     },
        //     (err) => {
        //         console.log(err);
        //     },
        //     {
        //         enableHighAccuracy: false,
        //         timeout: 2000,
        //         maximumAge: 0,
        //     }
        // );

        // var request = new XMLHttpRequest();
        // request.open(
        //     "GET",
        //     "https://api.ipdata.co/?api-key=1bce7dd23af006d8bf3a9bc0c569019247e28ac2f637007fb92ade5c"
        // );
        // request.setRequestHeader("Accept", "application/json");
        // request.onreadystatechange = function () {
        //     if (this.readyState === 4) {
        //         let res = JSON.parse(this.responseText);
        //         console.log(res, res.latitude, res.longitude);
        //         window.open(
        //             `https://google.com/maps?q=${res.latitude}, ${res.longitude}`,
        //             "_blank"
        //         );
        //     }
        // };
        // request.send();
    });
});
