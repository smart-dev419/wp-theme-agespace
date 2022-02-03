var app = angular.module('app', ['ngRoute', 'ngAnimate', 'ngSanitize']);

function $_GET(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


app.directive("ngShow", function () {

    return{
        restrict: "E",
        templateUrl: templateURL + "listings-grid.php",
    };
});


app.directive('googleplace', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, model) {
            var options = {
                types: [],
           
            };
            scope.gPlace = new google.maps.places.Autocomplete(element[0], options);

            google.maps.event.addListener(scope.gPlace, 'place_changed', function () {

                var geoComponents = scope.gPlace.getPlace();
                var latitude = geoComponents.geometry.location.lat();
                var longitude = geoComponents.geometry.location.lng();
                var addressComponents = geoComponents.address_components;

                addressComponents = addressComponents.filter(function (component) {
                    switch (component.types[0]) {
                        case "locality": // city
                            return true;
                        case "administrative_area_level_1": // state
                            return true;
                        case "country": // country
                            return true;
                        default:
                            return false;
                    }
                }).map(function (obj) {
                    return obj.long_name;
                });

                addressComponents.push(latitude, longitude);

                scope.$apply(function () {
                    scope.details = addressComponents; // array containing each location component
                    model.$setViewValue(element.val());
                });


            });



        }
    };
});

app.controller('theMap', ['$window', '$q', '$http', '$timeout', '$scope', '$rootScope', function ($window, $q, $http, $timeout, $scope, $rootScope) {

        $scope.showPlaces = function () {
            $scope.$cat = $_GET('thecat');
            $scope.$subcat = $_GET('subcat');
            $scope.$theCat = $scope.$subcat === "undefined" || $scope.$subcat === "" || $scope.$subcat === "-" ? $scope.$cat : $scope.$subcat;


//changed le_place_category slug to category on admin side CPT UI
            $http.get('wp-json/wp/v2/le_place/?filter[category_slug]=' + $scope.$theCat).success(function (res) {


                if (res.length > $scope.postPerPage) {
                    $scope.noResult = false;

                } else {
                    $scope.noResult = true;
                }

 
                var mapOptions = {
                    zoom: 15,
                    center: new google.maps.LatLng(window.latDest,window.longDest),
                    mapTypeId: google.maps.MapTypeId.TERRAIN
                }

                $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);

                $scope.markers = [];

               
var infoWindow = new google.maps.InfoWindow();
                var createMarker = function (lat, lng,title) {
 
                    var marker = new google.maps.Marker({
                        map: $scope.map,
                        position: new google.maps.LatLng(lat, lng),
                        title: title
                    });
                    
 marker.content = '<div class="infoWindowContent">' + res[i]['acf']['location']['address']+'<br><strong>Phone:</strong> '+ res[i]['acf']['phone'] + '</div>';
 
            google.maps.event.addListener(marker, 'click', function(){
                infoWindow.setContent('<h6>' + title + '</h6>' + marker.content);
                infoWindow.open($scope.map, marker);
            });

                    $scope.markers.push(marker);

                }



                for (i = 0; i < res.length; i++) {
                            //console.log(res[i]['acf']['location']['lat'],res[i]['acf']['location']['lng']);
                createMarker(res[i]['acf']['location']['lat'],res[i]['acf']['location']['lng'],res[i]['title']['rendered']);
                }


            });



        };


    }]);

app.controller('searchPlatform', ['$window', '$q', '$http', '$timeout', '$scope', '$rootScope', function ($window, $q, $http, $timeout, $scope, $rootScope) {
        $rootScope.templateURL = templateURL;
         $rootScope.siteURL = siteURL;
        $scope.loading = true;
        $scope.selectedCatToFilter = "";
        $scope.postPerPage = 3;
        $scope.newPosts = [];
        $scope.searchKey = "";
        $scope.defaultThumb = templateURL + "/images/default-thumb.jpg";

        $rootScope.requests = [];

        $scope.gPlace;
        $scope.selectedCat = {slug: "", label: ""};
        $scope.selectedSubCat = {slug: "", label: ""};

        $scope.busyPage = function () {
            return $http.pendingRequests.length > 0;
        };

        $scope.$watch($scope.busyPage, function (value) {
            if (value) {
                $scope.busyPage = true;
            } else {
                $scope.busyPage = false;
            }
        });
        $scope.disableSubCat = true;
        $scope.initCats = true;
        $scope.cats = [{id: -1, name: "All Categories", slug: "", isDefault: true}];
        $scope.subCats = [{id: -1, name: "ALL Tags", slug: "", isDefault: true}];

        $scope.setCat = function (slug, label, id) {
            $scope.selectedCat.slug = slug;
            $scope.selectedCat.label = label;
            $scope.selectedCat.id = id;

            $scope.initCats = false;
            $scope.selectedSubCat = {slug: "", label: ""};
            $scope.disableSubCat = true;
            $scope.selectedCatToFilter = id;

        }

        $scope.enableSubCats = function () {
            $scope.disableSubCat = false;
        }
        $scope.setSubCat = function (slug, label, id) {
            $scope.selectedSubCat.slug = slug;
            $scope.selectedSubCat.label = label;
            $scope.selectedCatToFilter = id;
        }

        $scope.getCats = function () {
siteUrl="//www.agespace.org/";
            $http.get(siteUrl+'wp-json/wp/v2/category/?per_page=100').success(function (res) {

                $scope.cats = $scope.cats.concat(res);

            });
        }

        $scope.checkCatHasChild = function (parentElement, childElement) {

            angular.forEach($scope.cats, function (parentElement, childElement) {

                if (parentElement.id === childElement.parent) {
                    return true;

                }
            });


        };

        $scope.search = function () {
         //   var urlVars = "range=25&cat=" + $scope.selectedCat.slug + "&subcat=" + $scope.selectedSubCat.slug + "&latd=" + $scope.details[3] + "&lng=" + $scope.details[4];
       $scope.selectedSubCat.slug = $scope.selectedSubCat.slug==="" || $scope.selectedSubCat.slug===undefined ? "-" : $scope.selectedSubCat.slug ;
          //  console.log($scope.selectedSubCat.slug,$scope.details);
            var urlVars = $scope.selectedCat.slug + "/near/"+$scope.details[0].toLowerCase()+"/25/" + $scope.details[$scope.details.length-2] + "/" + $scope.details[$scope.details.length-1];
              //var urlVars = $scope.selectedCat.slug + "/" + $scope.selectedSubCat.slug + "/near/"+$scope.details[0].toLowerCase()+"/25/" + $scope.details[3] + "/" + $scope.details[4];
  //   console.log($scope.details,$scope.details[$scope.details.length-2] ,$scope.details[$scope.details.length-1] );
       $window.location.href = '/location-results/' + urlVars;

        };






    }]);

