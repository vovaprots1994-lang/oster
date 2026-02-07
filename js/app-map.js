jQuery(function ($) {
    let maps = [];

    function initMap(element) {

        let infoBoxWidth = (winW < 768) ? 280 : 310,
            infoBoxOptions = {
                alignBottom: true,
                content: 'text',
                pixelOffset: (winW < 768) ? new google.maps.Size(infoBoxWidth / -2, infoBoxWidth / -6) : new google.maps.Size(infoBoxWidth / -2, infoBoxWidth / -4),
                boxStyle: {
                    width: `${infoBoxWidth}px`
                },
                closeBoxMargin: "0",
                closeBoxURL: 'img/icon-close.png'
            },
            infoBox = new InfoBox(infoBoxOptions),
            markersArr = [],
            mapStyles = [{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#e9e9e9"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#dedede"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                            "saturation": 36
                        },
                        {
                            "color": "#333333"
                        },
                        {
                            "lightness": 40
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#f2f2f2"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 17
                        },
                        {
                            "weight": 1.2
                        }
                    ]
                }
            ];

        function Map(id, mapOptions) {
            this.map = new google.maps.Map(document.getElementById(id), mapOptions);
            this.markers = [];
            this.infowindows = [];
            this.clusters = null;
        }

        function addMarker(mapId, location, index, string, image, activeImage, filterVal) {
            maps[mapId].markers[index] = new google.maps.Marker({
                position: location,
                map: maps[mapId].map,
                icon: {
                    url: image
                },
                mainImage: image,
                activeIcon: activeImage,
                desc: string,
                filterValue: filterVal
            });

            google.maps.event.addListener(maps[mapId].markers[index], 'click', function () {
                infoBox.setContent(string);
                infoBox.setPosition(location);
                infoBox.open(maps[mapId].map);
                this.setIcon(this.activeIcon);


                maps[mapId].map.setCenter(location);

                if (winW < 768) {
                    maps[mapId].map.panBy(0, -infoBoxWidth);
                } else {
                    maps[mapId].map.panBy(0, infoBoxWidth / -2);
                }

            });
            return maps[mapId].markers[index];
        }

        function initialize(mapInst) {
            let mapId = mapInst.attr('id'),
                lat = mapInst.attr("data-lat"),
                lng = mapInst.attr("data-lng"),
                myLatLng = new google.maps.LatLng(lat, lng),

                zoomOnDesktop = mapInst.attr("data-zoom") ? parseInt(mapInst.attr("data-zoom")) : 12,
                zoomOnMobile = mapInst.attr("data-xs-zoom") ? parseInt(mapInst.attr("data-xs-zoom")) : 10,
                zoomMap = winW < 768 ? zoomOnMobile : zoomOnDesktop;


            const mapUiOptions = {
                zoom: zoomMap,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL,
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },
                scrollwheel: false,
                disableDefaultUI: true,
                streetViewControl: false,
                fullscreenControl: false,
                center: myLatLng,
                styles: mapStyles
            };


            const clusterOptions = {
                gridSize: 60,
                ignoreHiddenMarkers: true,
                styles: [{
                    url: 'img/marker-cluster.png',
                    height: 48,
                    width: 48,
                    textSize: 16,
                    textColor: '#FFFFFF'
                }]
            };


            $.ajax({
                url: $(mapInst).attr('data-link'),
                type: 'get',
                dataType: 'json',
                error: function (data) {
                    console.log("File Not Found");
                },
                success: function (data) {
                    for (let i = 0; i < data.length; i++) {

                        const {
                            filterValue,
                            dataRel,
                            dataLat,
                            dataLng,
                            marker,
                            markerActive,
                            mobileMarker,
                            mobileMarkerActive,
                            city,
                            street,
                            googleLink,
                            phone,
                            phoneLink,
                            email,
                            workDaysOne,
                            workDaysTwo,
                            locationImg
                        } = data[i]

                        const imgMarker = winW < 768 ? mobileMarker : marker,
                            imgMarkerActive = winW < 768 ? mobileMarkerActive : markerActive;



                        const infoWrap = $('<div class="info-box-wrapper">');
                        infoWrap.append($('<div class="btn-close">'));

                        const infoInner = $('<div class="info-box-inner">');

                        if (phone && phoneLink && workDaysOne) {
                            const item = $('<div class="cnt-item">');
                            item.append($(`<div class="cnt-img"><img src="img/icons/icon-clock.svg"></div>`));
                            item.append($(`<div class="cnt-info-wrapp"><div class="cnt-info"><a href="tel:${phoneLink}">${phone}</a></div>
                                <div class="cnt-info">${workDaysOne ? '<div>' + workDaysOne + '</div>' : '' }</div></div>
                            `));
                            infoInner.append(item);
                        }

                        if (city && street) {
                            const item = $('<div class="cnt-item">');
                            item.append($(`<div class="cnt-img"><img src="img/icons/icon-location.svg"></div>`));
                            item.append($(`<div class="cnt-info"><a href="${googleLink ? googleLink : '#' }">${city},<br> ${street}</a></div>`));
                            infoInner.append(item);
                        }

                        infoWrap.append(infoInner);

                        if (locationImg) {
                            const infoImg = $('<div class="info-box-img">');
                            infoImg.append($(`<img src="${locationImg}">`));
                            infoWrap.append(infoImg);
                        }

                        let markerInst = addMarker(
                            dataRel,
                            new google.maps.LatLng(dataLat, dataLng),
                            i,
                            infoWrap[0].outerHTML,
                            imgMarker,
                            imgMarkerActive,
                            filterValue
                        );

                        markersArr.push(markerInst);
                    }


                    maps[mapId].markerClusterer = new MarkerClusterer(maps[mapId].map, markersArr, clusterOptions);
                    maps[mapId].bounds = new google.maps.LatLngBounds();

                    markersArr.forEach(function (marker) {
                        maps[mapId].bounds.extend(marker.getPosition());
                    });


                    if (lat.length == 0 && lng.length == 0) {
                        maps[mapId].map.fitBounds(maps[mapId].bounds);
                    }

                    function filterMarkers(val) {
                        markersArr.forEach(function (marker) {
                            marker.active = false;
                            marker.setIcon(marker.mainImage);
                        });


                        // console.log(maps)
                        // console.log(maps[mapId])

                        maps[mapId].bounds = new google.maps.LatLngBounds();
                        maps[mapId].markerClusterer.clearMarkers();

                        markersArr.forEach(function (marker) {
                            if (val !== '*') {
                                if (marker.filterValue == val) {
                                    marker.setVisible(true);
                                    maps[mapId].bounds.extend(marker.getPosition());
                                    maps[mapId].markerClusterer.addMarker(marker);

                                } else {
                                    marker.setVisible(false);
                                    maps[mapId].markerClusterer.removeMarker(marker);
                                }

                            } else {
                                marker.setVisible(true);
                                maps[mapId].bounds.extend(marker.getPosition());
                                maps[mapId].markerClusterer.addMarker(marker);
                            }
                        });

                        // maps[mapId].map.fitBounds(maps[mapId].bounds);
                    }

                    $(document).on('click', '.js_map_filters li', function () {
                        $(this).addClass('is-active').siblings().removeClass('is-active');
                        let val = $(this).attr('data-map-filter');

                        infoBox.close();
                        filterMarkers(val);
                    });

                }
            });


            maps[mapId] = new Map(mapId, mapUiOptions);


            // Close info-box on icon
            infoBox.addListener('closeclick', function () {
                maps[mapId].markers.forEach(function (marker) {
                    marker.active = false;
                    marker.setIcon(marker.mainImage);
                });
            });

            // Close info-box on map
            maps[mapId].map.addListener('click', function () {
                infoBox.close();
                maps[mapId].markers.forEach(function (marker) {
                    marker.active = false;
                    marker.setIcon(marker.mainImage);
                });
            });
        }

        initialize(element);
    }

    $('.map').each(function () {
        initMap($(this))
    });
});