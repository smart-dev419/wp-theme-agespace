//CODENAME: CACHE REFRESHED 4
var infowindow = null;
const ARROW_DOWN_KEYCODE = 40;
const ARROW_UP_KEYCODE = 38;
const ENTER_KEYCODE = 13;
const TAB_KEYCODE = 9;
const mapApiKey = "AIzaSyDMPD_lI4LuNtvjkT3MZ44pUIZ5q1GJEv4";

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const apikey = "AIzaSyDTQgMVRM74aZZ1KyDKGgWPC16eSYia7BU";
const cityApi = "fe7cc735b6ccbfe2bfdbb3a1d55bb2c2";

const DB_NAME = 'searched_data';
const DB_VERSION = 1;
const headers = {
    //'origin': 'https://www.agespace.org',
    //
    //'referer': 'https://www.agespace.org',
    //
    //'sec-fetch-mode': 'no-cors'

    //     method: 'GET', // *GET, POST, PUT, DELETE, etc.
    //    mode: 'no-cors', // no-cors, *cors, same-origin
    //    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    //    credentials: 'include', // include, *same-origin, omit

    //  'Content-Type': 'application/json',


    //  redirect: 'follow', // manual, *follow, error
    // "Referrer Policy": 'no-referrer-when-downgrade', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url

};
var realtypeof = function(obj) {
    switch (typeof(obj)) {
        // object prototypes
        case 'object':
            if (obj instanceof Array)
                return '[object Array]';
            if (obj instanceof Date)
                return '[object Date]';
            if (obj instanceof RegExp)
                return '[object regexp]';
            if (obj instanceof String)
                return '[object String]';
            if (obj instanceof Number)
                return '[object Number]';
            return 'object';
            // object literals
        default:
            return typeof(obj);
    }
};
//Vue.use(VueGoogleMaps, {
//      load: {
//        key: 'AIzaSyDMPD_lI4LuNtvjkT3MZ44pUIZ5q1GJEv4'
//      },
//      // Demonstrating how we can customize the name of the components
//      installComponents: false,
//    });
//
//   Vue.component('gmap-info-window', VueGoogleMaps.infoWindow);
//      Vue.component('gmap-map', VueGoogleMaps.Map);
//      Vue.component('gmap-marker', VueGoogleMaps.Marker);
const app = new Vue({

    el: '#search-app',
    beforeMount: async function() {
        const prefilledData = document.querySelector('#myVueData');
        this.serviceTypeName = 'Home Care'; //prefilledData.dataset.servicetypename;
        this.serviceTypeID = 12179; //prefilledData.dataset.servicetypeid;
        try {
            this.placeType = prefilledData.dataset.placetype;
            this.placeID = prefilledData.dataset.placeid;
            this.placeName = prefilledData.dataset.placename;
            this.centerLong = prefilledData.dataset.long;
            this.centerLat = prefilledData.dataset.lat;
            //           console.log('before mount centerLong:--->',this.centerLong);
            //            console.log('before mount Center:--->',this.center);
            //         var returnLong=this.centerLong!=null ? this.centerLong : this.center.lng ;
            //             var returnLat=this.centerLat!=null ? this.centerLat : this.center.lat ;
            //             app.data.center.lng=returnLong;
            //             app.data.center.lat=returnLat;
            //             console.log('before mount centerLong:--->',this.centerLong);
            //            console.log('before mount Center:--->',this.center);
                       

            if (this.placeName) {
                this.loading = true;
                this.loadingText = "Calculating GEO Data for " + this.placeName + "...";
            }
        } catch (e) {

        }
        //          fetch("https://www.agespace.org/wp-json/emin/city?city=" + this.placeName, {
        //                    headers
        //
        //                }).then((response) => {
        //                    if (response.ok) {
        //                        return response.json();
        //                        this.loading = false;
        //                    }
        //                }).then((response) => {
        //                 
        //                  console.log(response);
        //                    try {
        ////                        this.center.lat = response.result[0].latitude;
        ////                        this.center.lng = response.result[0].longitude;
        ////                      
        //
        //                        //   this.fetchQuery = "//www.agespace.org/wp-json/emin/location?per_page=" + this.requestedItemCount + "&placeName=" + this.placeName + "&" + this.placeType + "=" + this.placeID + "&filter_distance=" + this.searchRadius + "&keyword=" + this.postcodeQuery + "&longitude=" + this.postcodeQueryLongitude + "&latitude=" + this.postcodeQueryLatitude + this.filterText;
        //                        //   this.getData();
        //                    } catch (e) {
        //                        console.log(e);
        //                    }
        //                });

        //        this.center.lat =  36.8508;
        //                      this.center.lng = 76.2859;
        //      
        try {
            this.searchRadius = prefilledData.dataset.searchradius;
            this.postcodeResultPage = prefilledData.dataset.postcoderesultpage == "true" ? true : false;
            this.isResultPage = prefilledData.dataset.isresultpage == "true" ? true : false;
            this.doSearchInit = prefilledData.dataset.dosearchinit == "true" ? true : false;
            this.isSearchLandingtPage = prefilledData.dataset.issearchlandingtpage == "true" ? true : false;
            this.redirect = prefilledData.dataset.redirect == "true" ? true : false;
        } catch (e) {

        }
        if (this.isSearchLandingtPage) {
            this.getAllSearchBoxData();
        }
        var cus_response = await fetch("https://maps.googleapis.com/maps/api/geocode/json?address=" + this.placeName + "&key=AIzaSyDMPD_lI4LuNtvjkT3MZ44pUIZ5q1GJEv4", {
            headers

        })
        if (cus_response.ok) {
            var response = await cus_response.json();
            if (response.results.length > 0) {
                this.centerLat = response.results[0].geometry.location.lat;
                this.centerLong = response.results[0].geometry.location.lng;
            }
        }
    },
    created: function() {
        this.input = this.value || '';
        this.appLoaded = true;
        //        if (!("geolocation" in navigator)) {
        //            this.errorStr = 'Geolocation is not available.';
        //            return;
        //        }
        //        this.gettingLocation = true;
        //        // get position
        //        navigator.geolocation.getCurrentPosition(pos => {
        //            this.gettingLocation = false;
        //            this.userLocation = pos;
        //        }, err => {
        //            this.gettingLocation = false;
        //            this.errorStr = err.message;
        //        })
    },
    data: {
        infoWindowPos: null,
        infoWinOpen: false,
        currentMidx: null,
        centerLat: null,
        centerLong: null,
        gmapReady: false,
        center: {
            lat: null,
            lng: null
        },
        infoOptions: {
            content: '',
            //optional: offset infowindow so it visually sits nicely on top of our marker
            pixelOffset: {
                width: 0,
                height: -35
            }
        },
        markers: [],
        anyFilterApplied: false,
        field: 'name',
        input: null,
        mapIcon: "https://www.agespace.org/wp-content/themes/Agespace-Elementor/images/icons/map-dot.png",
        filteredSearchBoxData: [],
        searchBoxData: [],
        showRadiusFilter: false,
        showTownListFilter: false,
        searchBoxIndex: 0,
        selectInitAlready: false,
        standardSelect: true,
        forceClearCache: true,
        redirect: false,
        searchPageType: null,
        featuredLocations: null,
        prefilledTownCity: null,
        prefilledRegion: null,
        prefilledLocal: null,
        prefilledCounty: null,
        isCached: null,
        mytotalCount: 0,
        markersLimit: 999,
        mytotalPages: 0,
        perpage: -1,
        infowindow: null,
        infinitePerPage: 10,
        mapZoom: 8,
        db: null,
        storedDataRaw: [],
        filteredData: null,
        filteredDataPaid: null,
        storedFeaturedData: [],
        visibleDistance: false,
        ready: false,
        searchRadiusTown: null,
        addDisabled: false,
        isResultPage: false,
        isSearchLandingtPage: false,
        placeType: null,
        paginationFinished: false,
        placeID: null,
        placeName: null,
        userLocation: null,
        gettingLocation: false,
        errorStr: null,
        citySearch: false,
        cityType: null,
        cityName: null,
        searchRadius: null,
        filter_distance: 100,
        keyword: null,
        appLoaded: false,
        doSearchInit: false,
        postcodeResultPage: false,
        searchFilters: [],
        keywordType: null,
        warningMessage: null,
        searchIcon: "<i class='fa fa-search'></i>",
        loadingIcon: "<i class='fas fa-circle-notch fa-spin'></i>",
        selectedCity: '0',
        filtersVisible: false,
        placeFiltersVisible: false,
        placeSortersVisible: false,
        filtersNotInit: true,
        resultCount: 0,
        filtersAreAvailable: false,
        totalPages: 0,
        currentPage: 1,
        pageOfItems: 1,
        requestedItemCount: 110,
        searchString: null,
        filterText: null,
        keyword: null,
        result: [],
        noResultFound: false,
        responseAvailable: false,
        responseAvailablePaid: false,
        loading: false,
        loadingText: "",
        cities: null,
        counties: null,
        regions: null,
        circle: null,
        centermarker: null,
        localAuthorities: null,
        isPostcode: null,
        postcodeQuery: null,
        postcodeQueryLatitude: null,
        postcodeQueryLongitude: null,
        types: null,
        filter_specialistServices: [],
        filter_rate: [],
        filter_serviceTypes: [],
        filter_regulatedActivity: [],
        filter_cities: [],
        ownershipTypes: null,
        inspectionDirectorates: null,
        brands: null,
        specialistServices: null,
        serviceTypesFilter: null,
        serviceTypes: null,
        serviceTypeName: null,
        serviceTypeID: 12179,
        staffs: null,
        redirectParams: [],
    },
    watch: {
        //          filteredData:function(val) {
        //            console.log('filteredData --->', val);
        //              this.gmapReady=true;
        //        
        //      },
        responseAvailable: function(val) {
            console.log('responseAvailable --->', this.result.length);
            if (val) {
                setTimeout(function() {
                    if (jQuery('.custom-select select').length > 0) {
                        app.initCustomSelect();
                        jQuery('.custom-select select').trigger('click');
                    };
                    app.applyInitCheckboxes();
                    //app.checkServiceManually(8335);
                }, 200);
            }
        },
    },
    mounted: function() {
            if (this.placeType == "town") { //is town , not county
                this.showRadiusFilter = true;
                this.showTownListFilter = false;
            }
            if (this.placeType == "county") { //is town , not county
                this.showRadiusFilter = false;
                this.showTownListFilter = true;
            }
            this.infinitePagination();
            // this.initCustomSelect();
            //this.searchBoxData =[{"term_id": 13567, "name": "Avon", "slug": "avon", "term_group": 0, "term_taxonomy_id": 13567, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 83, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12997, "name": "Bedfordshire", "slug": "bedfordshire", "term_group": 0, "term_taxonomy_id": 12997, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 137, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12659, "name": "Berkshire", "slug": "berkshire", "term_group": 0, "term_taxonomy_id": 12659, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 212, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12345, "name": "Buckinghamshire", "slug": "buckinghamshire", "term_group": 0, "term_taxonomy_id": 12345, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 162, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 8815, "name": "Cambridgeshire", "slug": "cambridgeshire", "term_group": 0, "term_taxonomy_id": 8815, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 153, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 58477, "name": "Cambs", "slug": "cambs", "term_group": 0, "term_taxonomy_id": 58477, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12863, "name": "Cheshire", "slug": "cheshire", "term_group": 0, "term_taxonomy_id": 12863, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 257, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12767, "name": "Cleveland", "slug": "cleveland", "term_group": 0, "term_taxonomy_id": 12767, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 66, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 13921, "name": "Cornwall", "slug": "cornwall", "term_group": 0, "term_taxonomy_id": 13921, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 114, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 19295, "name": "County Antrim", "slug": "county-antrim", "term_group": 0, "term_taxonomy_id": 19295, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12919, "name": "County Durham", "slug": "county-durham", "term_group": 0, "term_taxonomy_id": 12919, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 70, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 13947, "name": "Cumbria", "slug": "cumbria", "term_group": 0, "term_taxonomy_id": 13947, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 97, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12285, "name": "Derbyshire", "slug": "derbyshire", "term_group": 0, "term_taxonomy_id": 12285, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 173, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12939, "name": "Devon", "slug": "devon", "term_group": 0, "term_taxonomy_id": 12939, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 235, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12559, "name": "Dorset", "slug": "dorset", "term_group": 0, "term_taxonomy_id": 12559, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 149, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 17361, "name": "East Riding of Yorkshire", "slug": "east-riding-of-yorkshire", "term_group": 0, "term_taxonomy_id": 17361, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 4, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12333, "name": "East Sussex", "slug": "east-sussex", "term_group": 0, "term_taxonomy_id": 12333, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 156, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 22951, "name": "East Yorkshire", "slug": "east-yorkshire", "term_group": 0, "term_taxonomy_id": 22951, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 7, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12361, "name": "Essex", "slug": "essex", "term_group": 0, "term_taxonomy_id": 12361, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 623, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64895, "name": "Fulham", "slug": "fulham", "term_group": 0, "term_taxonomy_id": 64895, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12699, "name": "Gloucestershire", "slug": "gloucestershire", "term_group": 0, "term_taxonomy_id": 12699, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 123, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 25735, "name": "Greater London", "slug": "greater-london", "term_group": 0, "term_taxonomy_id": 25735, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 5, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 14055, "name": "Greater Manchester", "slug": "greater-manchester", "term_group": 0, "term_taxonomy_id": 14055, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 60, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 31221, "name": "Greenwich", "slug": "greenwich", "term_group": 0, "term_taxonomy_id": 31221, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12571, "name": "Hampshire", "slug": "hampshire", "term_group": 0, "term_taxonomy_id": 12571, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 304, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 71751, "name": "Hants", "slug": "hants", "term_group": 0, "term_taxonomy_id": 71751, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 71765, "name": "Haringey", "slug": "haringey", "term_group": 0, "term_taxonomy_id": 71765, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 13583, "name": "Herefordshire", "slug": "herefordshire", "term_group": 0, "term_taxonomy_id": 13583, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 49, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12407, "name": "Hertfordshire", "slug": "hertfordshire", "term_group": 0, "term_taxonomy_id": 12407, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 216, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 80311, "name": "Herts", "slug": "herts", "term_group": 0, "term_taxonomy_id": 80311, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64943, "name": "Huddersfield", "slug": "huddersfield", "term_group": 0, "term_taxonomy_id": 64943, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 71715, "name": "Hull", "slug": "hull", "term_group": 0, "term_taxonomy_id": 71715, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 13985, "name": "Humberside", "slug": "humberside", "term_group": 0, "term_taxonomy_id": 13985, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 21, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 16119, "name": "Isle Of Wight", "slug": "isle-of-wight", "term_group": 0, "term_taxonomy_id": 16119, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 37, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 25709, "name": "kensington and chelsea", "slug": "kensington-and-chelsea", "term_group": 0, "term_taxonomy_id": 25709, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12795, "name": "Kent", "slug": "kent", "term_group": 0, "term_taxonomy_id": 12795, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 416, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 80321, "name": "Lanarkshire", "slug": "lanarkshire", "term_group": 0, "term_taxonomy_id": 80321, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 25781, "name": "Lanc's", "slug": "lancs", "term_group": 0, "term_taxonomy_id": 25781, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12237, "name": "Lancashire", "slug": "lancashire", "term_group": 0, "term_taxonomy_id": 12237, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 497, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 31233, "name": "Leicester", "slug": "leicester", "term_group": 0, "term_taxonomy_id": 31233, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 13927, "name": "Leicestershire", "slug": "leicestershire", "term_group": 0, "term_taxonomy_id": 13927, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 268, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12479, "name": "Lincolnshire", "slug": "lincolnshire", "term_group": 0, "term_taxonomy_id": 12479, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 114, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 71745, "name": "Liverpool", "slug": "liverpool", "term_group": 0, "term_taxonomy_id": 71745, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 17337, "name": "London", "slug": "london", "term_group": 0, "term_taxonomy_id": 17337, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 21, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 17523, "name": "Manchester", "slug": "manchester", "term_group": 0, "term_taxonomy_id": 17523, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 8, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12627, "name": "Merseyside", "slug": "merseyside", "term_group": 0, "term_taxonomy_id": 12627, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 231, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12397, "name": "Middlesex", "slug": "middlesex", "term_group": 0, "term_taxonomy_id": 12397, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 342, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64933, "name": "N.E. Lincs", "slug": "n-e-lincs", "term_group": 0, "term_taxonomy_id": 64933, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 25751, "name": "Newham", "slug": "newham", "term_group": 0, "term_taxonomy_id": 25751, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 8325, "name": "Norfolk", "slug": "norfolk", "term_group": 0, "term_taxonomy_id": 8325, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 157, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64913, "name": "North East Lincolnshire", "slug": "north-east-lincolnshire", "term_group": 0, "term_taxonomy_id": 64913, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 31289, "name": "North East Lincolshire", "slug": "north-east-lincolshire", "term_group": 0, "term_taxonomy_id": 31289, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 14175, "name": "North Humberside", "slug": "north-humberside", "term_group": 0, "term_taxonomy_id": 14175, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 36, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 25821, "name": "North Lincolnshire", "slug": "north-lincolnshire", "term_group": 0, "term_taxonomy_id": 25821, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 80299, "name": "North Linconshire", "slug": "north-linconshire", "term_group": 0, "term_taxonomy_id": 80299, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64935, "name": "North Somerset", "slug": "north-somerset", "term_group": 0, "term_taxonomy_id": 64935, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12443, "name": "North Yorkshire", "slug": "north-yorkshire", "term_group": 0, "term_taxonomy_id": 12443, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 181, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 14031, "name": "Northamptonshire", "slug": "northamptonshire", "term_group": 0, "term_taxonomy_id": 14031, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 179, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12955, "name": "Northumberland", "slug": "northumberland", "term_group": 0, "term_taxonomy_id": 12955, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 46, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12251, "name": "Nothamptonshire", "slug": "nothamptonshire", "term_group": 0, "term_taxonomy_id": 12251, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12433, "name": "Nottinghamshire", "slug": "nottinghamshire", "term_group": 0, "term_taxonomy_id": 12433, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 230, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 14357, "name": "Oxfordshire", "slug": "oxfordshire", "term_group": 0, "term_taxonomy_id": 14357, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 130, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64837, "name": "Oxon", "slug": "oxon", "term_group": 0, "term_taxonomy_id": 64837, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 71673, "name": "Rutland", "slug": "rutland", "term_group": 0, "term_taxonomy_id": 71673, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 13461, "name": "Shropshire", "slug": "shropshire", "term_group": 0, "term_taxonomy_id": 13461, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 123, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64923, "name": "Solihull", "slug": "solihull", "term_group": 0, "term_taxonomy_id": 64923, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 13061, "name": "Somerset", "slug": "somerset", "term_group": 0, "term_taxonomy_id": 13061, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 100, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 19433, "name": "South Glamorgan", "slug": "south-glamorgan", "term_group": 0, "term_taxonomy_id": 19433, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 39259, "name": "South Gloucestershire", "slug": "south-gloucestershire", "term_group": 0, "term_taxonomy_id": 39259, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12667, "name": "South Humberside", "slug": "south-humberside", "term_group": 0, "term_taxonomy_id": 12667, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 18, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12305, "name": "South Yorkshire", "slug": "south-yorkshire", "term_group": 0, "term_taxonomy_id": 12305, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 210, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12455, "name": "Staffordshire", "slug": "staffordshire", "term_group": 0, "term_taxonomy_id": 12455, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 149, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 13371, "name": "Suffolk", "slug": "suffolk", "term_group": 0, "term_taxonomy_id": 13371, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 164, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12531, "name": "Surrey", "slug": "surrey", "term_group": 0, "term_taxonomy_id": 12531, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 507, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 19549, "name": "Telford", "slug": "telford", "term_group": 0, "term_taxonomy_id": 19549, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 31269, "name": "Tyne &amp; Wear", "slug": "tyne-wear", "term_group": 0, "term_taxonomy_id": 31269, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12897, "name": "Tyne and Wear", "slug": "tyne-and-wear", "term_group": 0, "term_taxonomy_id": 12897, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 124, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 71689, "name": "United Kingdom", "slug": "united-kingdom", "term_group": 0, "term_taxonomy_id": 71689, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 71763, "name": "Warkwickshire", "slug": "warkwickshire", "term_group": 0, "term_taxonomy_id": 71763, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64861, "name": "Warrington", "slug": "warrington", "term_group": 0, "term_taxonomy_id": 64861, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12823, "name": "Warwickshire", "slug": "warwickshire", "term_group": 0, "term_taxonomy_id": 12823, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 104, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64853, "name": "Warwicksire", "slug": "warwicksire", "term_group": 0, "term_taxonomy_id": 64853, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 19579, "name": "West Glamorgan", "slug": "west-glamorgan", "term_group": 0, "term_taxonomy_id": 19579, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12417, "name": "West Midlands", "slug": "west-midlands", "term_group": 0, "term_taxonomy_id": 12417, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 739, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12947, "name": "West Sussex", "slug": "west-sussex", "term_group": 0, "term_taxonomy_id": 12947, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 192, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 12471, "name": "West Yorkshire", "slug": "west-yorkshire", "term_group": 0, "term_taxonomy_id": 12471, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 360, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64929, "name": "Westminster", "slug": "westminster", "term_group": 0, "term_taxonomy_id": 64929, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 24465, "name": "Wigan", "slug": "wigan", "term_group": 0, "term_taxonomy_id": 24465, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 15031, "name": "Wiltshire", "slug": "wiltshire", "term_group": 0, "term_taxonomy_id": 15031, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 129, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 31259, "name": "Wirral", "slug": "wirral", "term_group": 0, "term_taxonomy_id": 31259, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 1, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 64937, "name": "Wolverhampton", "slug": "wolverhampton", "term_group": 0, "term_taxonomy_id": 64937, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 0, "filter": "raw", "term_icon": null, "term_order": "0"}, {"term_id": 14081, "name": "Worcestershire", "slug": "worcestershire", "term_group": 0, "term_taxonomy_id": 14081, "taxonomy": "ag_county", "description": "", "parent": 0, "count": 124, "filter": "raw", "term_icon": null, "term_order": "0"}];
        },
    async created() {
        this.db = await this.getDb();
        this.afterAsyncCreate();
    },
    computed: {
    },
    methods: {
        //         upgradeListingURL: function() {
        //       var address= (item.city[0].name ? item.city[0].name  : item.local_authority[0].name) + item.postal_code;
        //        var title=cleaner(item.title);
        //         var phone=formatPhone(item.location_phone_number);
        //      return "https://www.agespace.org/upgrade-listing?title="+title+"&tel="+phone+"&address="+address;
        //    },
        resetFilters() {
            console.log('Reset Filters Clicked');
            this.anyFilterApplied = false;
            this.result = this.storedDataRaw;
            this.searchFilters = [];
            //   this.filterData('refresh');

            jQuery('.filter-item .custom-select').each(function() {
                var el = jQuery(this);
                var valuezero = el.find('li[rel^="0"]').text();
                el.find('.le-select').text(valuezero);
            });

        },
        townOrCity(txt) {
            switch (txt) {
                case 'ag_cities':
                    return 'Town';
                    break;
                case 'ag_county':
                    return 'County';
                    break;
                case 'ag_regions':
                    return 'Region';
                    break;

            }
        },
        townOrCitySlug(slug, taxonomy) {
            var $link = 'home-care';
            switch (taxonomy) {
                case 'ag_cities':
                    return $link + '/town/' + slug;
                    break;
                case 'ag_regions':
                    return $link + '/' + slug;
                    break;
                case 'ag_county':
                    return $link + '/' + slug;
                    break;
            }
        },
        getAllSearchBoxData() {
            this.loading = true;
            this.loadingText = "Regions,Towns and cities are loading...";
            //     fetch("//www.agespace.org/wp-json/emin/city", {
            fetch("//www.agespace.org/wp-json/emin/postmeta?tax=allPlaces", {
                headers

            }).then((response) => {
                if (response.ok) {
                    return response.json();

                }
            }).then((response) => {
                this.searchBoxData = response;
                //console.log('response-->',this.searchBoxData);
            });
            this.loading = false;
        },
        getMapData: function() {
            // console.log('this is map result: ',this.result);
            return this.result;
        },
        addClicker: function(marker, content) {
            google.maps.event.addListener(marker, 'click', function() {
                if (infowindow) {
                    infowindow.close();
                }
                infowindow = new google.maps.InfoWindow({
                    content: content
                });
                infowindow.open(map, marker);
                map.panTo(marker.getPosition());
                map.setZoom(10);
                google.maps.event.addListener(infowindow, 'closeclick', function() {
                    console.log('close clicked');
                    map.setZoom(8);
                    //  map.panTo(new google.maps.LatLng(this.center.lat,this.center.lng));
                });
                return false;
            });
        },
        addMarker: function(position) {
            const marker = new google.maps.Marker({
                position,
                map,
                //icon:this.mapIcon
            });
            markers.push(marker);
        },
        showDataOnMap: function() {
            var bounds = new google.maps.LatLngBounds();
            this.markers = [];
            //   console.log('this.searchRadius in showDataOnMap: ',this.searchRadius);
            if (this.searchRadius) {
                var foundMarkers = 0;
                var markersCount = this.result.length > this.markersLimit ? this.markersLimit : this.result.length;
                for (var i = 0; i < markersCount; i++) {
                    var obj = this.result[i];
                    const marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(obj.latitude), parseFloat(obj.longitude)),
                        map: map,
                        //                icon:this.mapIcon,
                        title: obj.infoText // this works, giving the marker a title with the correct title
                    });
                    //  console.log('obj.position,this.center:',obj.position,this.center);
                    var fromPos = new google.maps.LatLng(obj.position.lat, obj.position.lng);
                    var toPos = new google.maps.LatLng(this.center.lat, this.center.lng);
                    // console.log('Distance and radius--->',google.maps.geometry.spherical.computeDistanceBetween(fromPos,toPos,this.searchRadius));
                    // if marker is in the circle, display it and add it to the sidebar
                    if (google.maps.geometry.spherical.computeDistanceBetween(fromPos, toPos, this.searchRadius) < this.searchRadius) {
                        bounds.extend((new google.maps.LatLng(marker.getPosition().lat, marker.getPosition().lng)));
                        // display it
                        // gmarkers[i].setMap(map);
                        // add a line to the side_bar html
                        this.markers.push(marker); 
                        var clicker = this.addClicker(marker, obj.infoText);
                        foundMarkers++;   
                        
                    }
                }
                //if(this.result.length > this.markersLimit){
                //    console.log("Too many pins, so I just show only limiteds")
                //}else{
                //
                //}
            } else {
                for (var i = 0; i < this.result.length; i++) {
                    var obj = this.result[i];
                    const marker = new google.maps.Marker({
                        position: new google.maps.LatLng((parseFloat(obj.latitude), parseFloat(obj.longitude)), ),
                        map: map,
                        title: obj.infoText, // this works, giving the marker a title with the correct title
                        //icon:this.mapIcon
                    });
                    this.markers.push(marker);
                    var clicker = this.addClicker(marker, obj.infoText);
                    lat = obj.latitude;
                    lng = obj.longitude;
                } // end loop
            }
        },
        isInRadius: function(marker, radius) {

        },
        initMap: function(centerLat, centerLong) {
            console.log('this.gmapReady', this.gmapReady);
            //     if(this.gmapReady){
            //         this.showDataOnMap();
            //         return;
            //     }
            //      console.log('this.center:',this.center);
            //         console.log('mapOptions:',mapOptions);
            console.log('centerLat,centerLong', centerLat, centerLong);
            var mapOptions = {
                zoom: this.mapZoom,
                center: new google.maps.LatLng(centerLat, centerLong),
                mapTypeControl: false,
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            //         const svgMarker = {
            //    path: 'M cx - r, cy        a r,r 0 1,0 (r * 2),0         a r,r 0 1,0 -(r * 2),0',
            //    fillColor: "#73509C",
            //    fillOpacity: 1,
            //    strokeWeight: 0,
            //    rotation: 0,
            //    scale: 1,
            //    anchor: new google.maps.Point(15, 30),
            //  };
            // const svgMarker ="https://www.agespace.org/wp-content/themes/Agespace-Elementor/images/icons/globe.svg";//'<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="-10 -10 100 100">  <g fill="rgba(0,0,72)">    <circle cx="5" cy="5" r="2" />  </g></svg>';
            map.setCenter(new google.maps.LatLng(centerLat, centerLong));
            console.log(' this.centermarker ', this.centermarker);
            circleRadius = this.searchRadius ? this.searchRadius : 15;
            console.log(' circleRadius ', circleRadius);
            if (this.searchRadius) {
                // this.centermarker = new google.maps.Marker({
                //     position: new google.maps.LatLng(centerLat, centerLong),
                //     map: map,

                //     // icon: this.mapIcon,
                // });
                // this.markers.push(this.centermarker);
                // circle for display draw circle
                this.circle = new google.maps.Circle({
                    radius: circleRadius * 1609.34, // miles to meter
                    fillOpacity: 0.1,
                    fillColor: "#FFffff",
                    strokeColoe: '#000000',
                    icon: this.mapIcon,
                    map: map
                });
                //    console.log(' this.circle ', this.circle ,'this.searchRadius: ',this.searchRadius);   
                //    this.circle.bindTo('center',  this.centermarker, 'position');
                console.log('  this.centermarker ', this.centermarker);
            }
            this.gmapReady = true;
            this.showDataOnMap();
            console.log('this.gmapReady', this.gmapReady);
        },
        updateMapRadiusCircle: function() {
            //this.circle = new google.maps.Circle({
            //    
            //                                 radius: this.searchRadius*1609.34, // miles to meter
            //                                 fillOpacity: 0.15,
            //                                 fillColor: "#FF0000",
            //                                 map: map});
            //                             
            //                       circle.bindTo('center',  this.centermarker, 'position');
        },
        initGmap: function(long, lat) {
            //           var scriptTag='<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMPD_lI4LuNtvjkT3MZ44pUIZ5q1GJEv4&libraries=geometry" ></script>';
            //                 jQuery(scriptTag).appendTo(jQuery('head'));
            if (long && lat) {
                this.center.lng = parseFloat(long);
                this.center.lat = parseFloat(lat);
                this.initMap(parseFloat(lat), parseFloat(long));
            } else {
                fetch("https://maps.googleapis.com/maps/api/geocode/json?address=" + this.placeName + ",uk&key=AIzaSyDMPD_lI4LuNtvjkT3MZ44pUIZ5q1GJEv4", {
                    headers

                }).then((response) => {
                    if (response.ok) {
                        return response.json();
                    }
                }).then((response) => {
                    if (response.results.length > 0) {
                        this.centerLong = response.results[0].geometry.location.lng;;
                        this.centerLat = response.results[0].geometry.location.lat;
                    }
                    var returnLong = this.centerLong != null ? this.centerLong : this.center.lng;
                    var returnLat = this.centerLat != null ? this.centerLat : this.center.lat;
                    this.center.lng = parseFloat(returnLong);
                    this.center.lat = parseFloat(returnLat);
                    console.log('parseFloat(returnLat),parseFloat(returnLong)', parseFloat(returnLat), parseFloat(returnLong));
                    this.initMap(parseFloat(returnLat), parseFloat(returnLong));
                    //          map.setCenter(this.center);
                });
            }
        },
        changeCheckboxFilter: function(item) {
            var checkbox = jQuery(".search-form-checkboxes #" + item.term_id).find('.checkbox');
            jQuery(checkbox).toggleClass('checked');
            window.localStorage.removeItem('servicesCheckboxes');
            var allCheckedOnes = "";
            jQuery(".search-form-checkboxes .checked").each(
                function() {
                    allCheckedOnes += (jQuery(this).parent().data('value')) + ",";
                }
            );
            //console.log(allCheckedOnes);
            if (allCheckedOnes) {
                window.localStorage.setItem('servicesCheckboxes', allCheckedOnes);
            }
        },
        afterAsyncCreate: function() {
            this.filter_specialistServices = [
                //        {"name": "Select All", "term_id": -1},
                //         {"name": "Deselect All", "term_id": -2},
                {
                    "name": "Personal Care",
                    "term_id": 13271
                },
                //             {"name": "Day Care", "term_id": 112321},
                //                  {"name": "Live-in Care", "term_id": 112319},
                {
                    "name": "Dementia",
                    "term_id": 8335
                },
                {
                    "name": "Physical Disability",
                    "term_id": 12145
                },
                {
                    "name": "Mental Health",
                    "term_id": 8339
                },
                //                {"name": "Older People", "term_id": 8341},
                //                {"name": "Domiciliary care service", "term_id": 8329},



            ];
            if (this.doSearchInit) {



                //  this.cats = await this.getDataFromDb();




                //    console.log('--->'+this.serviceTypeName);
                //  this.serviceTypesFilter = {"name": serviceTypeName, "term_id": serviceTypeID};
                this.ready = true;
                this.keyword = new URL(location.href).searchParams.get('keyword');
                this.isCached = new URL(location.href).searchParams.get('cached') == 'true' ? true : false;

                if (this.forceClearCache) {
                    this.clearCache();
                }
                console.log('must search for ' + this.placeName);
                this.showAllPlaceData(this.placeName);
                this.doFeaturedSearch(this.serviceTypeID, this.placeName);


                this.filter_regulatedActivity = [{
                    "name": "Home Care",
                    "term_id": 12179
                }, ];

                this.createFilters(this.serviceTypeID, this.placeType, this.placeID, "rate");
                this.createFilters(this.serviceTypeID, this.placeType, this.placeID, "city");




            }
            //  this.markers: [{
            //            position: {
            //              lat: 10.0,
            //              lng: 10.0
            //            }
            //          }];
            //[{
            //            position: {
            //              lat: 10.0,
            //              lng: 10.0
            //            },
            //             position: {
            //              lat: 10.0,
            //              lng: 10.0
            //            },
            //             position: {
            //              lat: 10.0,
            //              lng: 10.0
            //            }
            //          }]
            //      var markersTemp=[];
            //app._data.storedDataRaw.forEach(function (item, index) {
            //    markersTemp[]=[{
            //            position: {
            //              lat: 10.0,
            //              lng: 10.0
            //            },
            //             position: {
            //              lat: 10.0,
            //              lng: 10.0
            //            },
            //             position: {
            //              lat: 10.0,
            //              lng: 10.0
            //            }
            //          }]
            //            
            //            position.lat: item.latitude
            //          
            //                    {{
            //                             position: {
            //              lat: item.latitude,
            //              lng: item.longitude
            //            }
            //                    }},
            //               
            //    
            //});
            //this.markers=markersTemp;
            if (this.isSearchLandingtPage) {

            }
            if (this.postcodeResultPage) {
                this.visibleDistance = true;
            }

            if (this.isResultPage) {

                this.doSearch(this.keyword);
                this.doFeaturedSearch(this.serviceTypeID, this.placeName);
            }

        },
        complete: function(i) {
            try {
                this.input = this.filteredSearchBoxData[i][this.field];
                this.filteredSearchBoxData = [];
            } catch (e) {

            }

        },
        checkServiceManually: function(termID) {
            $dropdown = jQuery('#specialist_service_select').parent();

            $dropdown.find('[rel="' + termID + '"]').trigger('click');
        },
        applyInitCheckboxes: function() {
            try {
                var initBoxes = window.localStorage.getItem('servicesCheckboxes').split(",");
                if (initBoxes) {
                    $dropdown = jQuery('#specialist_service_select').parent();

                    initBoxes.forEach(function(item, index) {
                        //        console.log($dropdown.find('[rel="'+item+'"]'));
                        $dropdown.find('[rel="' + item + '"]').trigger('click');
                    });
                    window.localStorage.removeItem('servicesCheckboxes');

                    //select all
                    //$dropdown=jQuery('#specialist_service_select');

                    var servicesDrop = $dropdown.parent();

                    servicesDrop.find('.le-select li[rel="-1"]').on('click', function() {
                        servicesDrop.find('.le-select + ul li').not('[rel="-2"]').trigger('click');
                        servicesDrop.find('.le-select + ul .checkbox').addClass('checked');
                    });
                    //de select all
                    servicesDrop.find('.le-select + ul [rel="-2"]').on('click', function() {
                        servicesDrop.find('.le-select + ul .checkbox').removeClass('checked');
                    });




                }
            } catch (e) {

            }
        },
        onInputChange: function(e) {
            const isEnterKey = e.keyCode === ENTER_KEYCODE;
            const isArrowDownKey = e.keyCode === ARROW_DOWN_KEYCODE;
            const isArrowUpKey = e.keyCode === ARROW_UP_KEYCODE;
            const isTabKey = e.keyCode === TAB_KEYCODE;
            if (isEnterKey) {
                this.doSearch(this.input);
                return;
            }
            if (isArrowDownKey || isArrowUpKey || isTabKey) {
                return;
            }
            const search = e.target.value.toLowerCase();
            this.input = e.target.value;
            this.searchBoxIndex = 0;

            if (this.input.length) {

                this.filteredSearchBoxData = this.searchBoxData.filter((searchWord) => searchWord[this.field].toLowerCase().startsWith(search));
            } else {
                this.filteredSearchBoxData = [];
            }
        },
        onSelectData: function(e) {
            const isArrowDownKey = e.keyCode === ARROW_DOWN_KEYCODE;
            const isArrowUpKey = e.keyCode === ARROW_UP_KEYCODE;
            const isEnterKey = e.keyCode === ENTER_KEYCODE;

            if (isArrowDownKey && this.searchBoxIndex < this.filteredSearchBoxData.length - 1) {
                this.searchBoxIndex++;
            } else if (isArrowUpKey && this.searchBoxIndex > 0) {
                this.searchBoxIndex--;
            } else if (isEnterKey) {
                this.complete(this.searchBoxIndex);
            }
        },
        initCustomSelect: function() {
            if (this.selectInitAlready) {
                return;
            }
            this.selectInitAlready = true;
            // Iterate over each select element
            jQuery('.custom-select select').each(function() {

                $isCheckbox = false;

                // Cache the number of options
                var $originalSelectElement = jQuery(this),
                    numberOfOptions = jQuery(this).children('option').length;

                if ($originalSelectElement.parent().hasClass('checkbox-select')) {
                    $isCheckbox = true;
                }

                // Hides the select element
                $originalSelectElement.addClass('s-hidden');

                // Wrap the select element in a div
                $originalSelectElement.wrap('<div class="custom-select"></div>');

                // Insert a styled div to sit over the top of the hidden select element
                $originalSelectElement.after('<div class="le-select"></div>');

                // Cache the styled div
                var $leSelect = $originalSelectElement.next('div.le-select');

                // Show the first select option in the styled div
                $leSelect.text($originalSelectElement.children('option').eq(0).text());

                // Insert an unordered list after the styled div and also cache the list
                var $list = jQuery('<ul />', {
                    'class': 'options'
                }).insertAfter($leSelect);


                $checbox = $isCheckbox ? '<span class="checkbox"></span>' : '';
                // Insert a list item into the unordered list for each select option
                for (var i = 0; i < numberOfOptions; i++) {

                    $elLi = '<li rel="' + $originalSelectElement.children('option').eq(i).val() + '">' + $checbox + $originalSelectElement.children('option').eq(i).text() + '</li>';

                    jQuery($elLi).appendTo($list);
                }

                // Cache the list items
                var $listItems = $list.children('li');

                // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
                $leSelect.click(function(e) {
                    e.stopPropagation();

                    jQuery('div.le-select.active').each(function() {
                        jQuery(this).removeClass('active').next('ul.options').removeClass('show-flex');
                    });

                    jQuery(this).toggleClass('active').next('ul.options').toggleClass('show-flex');
                });

                // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
                // Updates the select element to have the value of the equivalent option
                $listItems.click(function(e) {
                    e.stopPropagation();
                    $el = jQuery(this);

                    $isCheckbox = $el.find('.checkbox').length > 0 ? true : false;
                    console.log('$isCheckbox', $isCheckbox);
                    if ($isCheckbox) {
                        //     $leSelect.text($el.text()).removeClass('active');
                        //$originalSelectElement.val($el.attr('rel'));

                        $el.find('.checkbox').toggleClass('checked');
                        if ($el.attr('rel') == 0) {
                            $leSelect.removeClass('active');
                            $list.removeClass('show-flex');
                        }
                        $pop = $el.find('.checkbox.checked').length > 0 ? false : true;

                        app.filterApply($originalSelectElement.data('filtertype'), $el.text(), $el.attr('rel').trim(), true, $el.eq(), $el.text().trim(), true, $pop);
                    } else {
                        $leSelect.text($el.text()).removeClass('active');
                        $originalSelectElement.val($el.attr('rel'));
                        //                       $originalSelectElement.trigger('change');
                        //                        $originalSelectElement.trigger('click');
                        if ($originalSelectElement) {

                        }
                        app.radiusChange(event);
                        //      console.log('-------------------------------------------------------------------------------',$originalSelectElement,$originalSelectElement.val());
                        $list.removeClass('show-flex');
                        app.filterApply($originalSelectElement.data('filtertype'), $originalSelectElement.data('filterlabel'), $el.attr('rel').trim(), true, $el.eq(), $el.text().trim());
                    }


                    //      console.log($el,$el.attr('rel'),true,$el.eq(),$el.text().trim());

                    //    console.log($originalSelectElement,jQuery(this).attr('rel')); 
                });

                // Hides the unordered list when clicking outside of it
                jQuery(document).click(function() {
                    $leSelect.removeClass('active');
                    $list.removeClass('show-flex');
                });

            });

        },
        redirectTo: function(page) {
            //  console.log(this.redirectParams);
            paramsString = "&" + this.redirectParams.map(function(elem) {
                return elem.key + "=" + escape(elem.value);
            }).join("&");



            page = page ? page + "?" + paramsString : 'https://www.agespace.org/results-page?' + paramsString + this.filterText;
            console.log('redirected... to: ' + page);
            //     console.log(this.searchFilters,paramsString);
            window.location.href = page;
        },
        async addData(jsondata, keyword, salt) {
            this.addDisabled = true;


            await this.addDataToDb(jsondata, keyword, salt);
            //  this.cats = await this.getDataFromDb();
            this.addDisabled = false;

        },
        async deleteCat(id) {
            await this.deleteCatFromDb(id);
            // this.cats = await this.getDataFromDb();      
        },
        async clearDatabase() {
            await this.clearWholeDB();


        },
        async clearWholeDB() {
            return new Promise((resolve, reject) => {
                let trans = this.db.transaction(['cats'], 'readwrite');
                trans.oncomplete = e => {
                    resolve();


                };

                var objectStoreRequest = trans.objectStore('cats').clear();

                objectStoreRequest.onsuccess = function(event) {
                    // report the success of our request
                    this.loading = true;
                    this.loadingText = "Deleted";
                };


            });
        },
        async checkDatabaseForData(keyword, salt) {
                //   salt = salt ? salt : 'norfolk' ;
                databaseKey = keyword + '-' + salt;


                this.loading = true;
                this.loadingText = "Checking for existing data in cache...";

                return new Promise((resolve, reject) => {
                    let trans = this.db.transaction(['cats'], 'readonly');
                    trans.oncomplete = e => {
                        resolve();


                    };

                    var objectStoreRequest = trans.objectStore('cats').get(databaseKey);

                    objectStoreRequest.onsuccess = function(event) {
                        // report the success of our request

                        if (event.target.result == undefined) {

                            reject(false);
                            console.log("Error on this: " + objectStoreRequest.error);
                        } else {

                            resolve(event.target.result);


                        }




                    };
                    objectStoreRequest.onerror = function(event) {
                        // report the success of our request
                        console.log("Error on this: " + event + objectStoreRequest.error);
                        this.loading = true;
                        this.loadingText = objectStoreRequest.error;

                    };


                });




            }



            ,
        async addDataToDb(jsondata, keyword, salt) {
            //    salt = salt ? salt : 'norfolk' ;
            return new Promise((resolve, reject) => {

                let trans = this.db.transaction(['cats'], 'readwrite');
                trans.oncomplete = e => {
                    resolve();
                };

                let store = trans.objectStore('cats');
                databaseKey = keyword + '-' + salt;

                store.add(jsondata, databaseKey);

            });
        },
        async deleteCatFromDb(id) {
            return new Promise((resolve, reject) => {
                let trans = this.db.transaction(['cats'], 'readwrite');
                trans.oncomplete = e => {
                    resolve();
                };

                let store = trans.objectStore('cats');
                store.delete(id);
            });
        },
        doFilter: function(type) {

            this.loading = true;
            this.loadingText = "Data is Filtering...";


            //  this.storedDataRaw = response[0];
            type = type ? type : 'featured';
            if (type == "featured") {
                filteredData = this.storedFeaturedData;
            } else {
                filteredData = this.storedDataRaw;
            }
            filteredData.forEach(function(item,index){
                var rating_score = 0;
                switch(item.rating){
                    case 'Outstanding':
                        rating_score = 1;
                        break;
                    case 'Good':
                        rating_score = 2;
                        break;
                    case 'Requires improvement':
                        rating_score = 3;
                        break;
                    case 'Inadequate':
                        rating_score = 4;
                        break;
                    case '':
                        rating_score = 5;
                        break;
                }
                item.rating_score = rating_score;
            });
            filteredData.sort(function(a,b){
                if (a.rating_score < b.rating_score) {
                    return -1;
                }else if(a.rating_score > b.rating_score){
                    return 1;
                }else{
                    return 0;
                }
            })
            if (this.searchFilters.length == 0) {
                this.searchFilters = [{label: "15 Miles",optionText: "15 Miles",slug: undefined,value: "15"}]
            }
            this.searchFilters.forEach(function(item, index) {
                key = item.slug;
                value = item.value;
                if (item.value == '15' || item.value == '25' || item.value == '50' || item.value == '100') {
                    key = 'ag_cities';
                }
                console.log("-----> filters", item, key, value);
                switch (key) {
                    case 'specialist_service':
                        filteredData = filteredData.filter(function(a) {


                            filteredSpecialist = a.specialist_service_and_type.filter(function(b) {

                                if (parseInt(b.term_id) == parseInt(value)) {
                                    //            console.log(a.title, b.term_id,b,value);
                                    //                                      if(a.title=="Barley Court"){
                                    //     console.log(a.title, b.term_id,b,value);
                                    //}
                                    return true;
                                }
                            });


                            if (filteredSpecialist.length == 0 && a.location_regulated_activity) {
                                filteredSpecialist = a.location_regulated_activity.filter(b => b.term_id == parseInt(value)); //looking for nursing since its not real specialist service its regulated activity
                            }

                            if (filteredSpecialist.length == 0 && a.provider_regulated_activity) {
                                filteredSpecialist = a.provider_regulated_activity.filter(b => b.term_id == parseInt(value)); //looking for nursing since its not real specialist service its regulated activity
                            }

                            if (filteredSpecialist.length > 0) {
                                return true;
                            } else {
                                //      console.log(a.title,a);
                                return false;
                            }



                        });
                        break;

                    case 'ag_cities':

                        // filteredData = filteredData.filter(a => a.city[0].term_id == parseInt(value));
                        // filteredData = filteredData.filter(function(a) {
                        //     if (a.city) {

                        //         filteredSpecialist = a[0].city.filter(b => b.term_id == parseInt(value));


                        //         if (filteredSpecialist.length > 0) {
                        //             return true;
                        //         } else {
                        //             return false;
                        //         }

                        //     } else {
                        //         return false;
                        //     }


                        // });
                        compareDistance = value;
                        // this.visibleDistance=true;
                        // console.log('filteredData--->',app.data.filteredData);
                        //    app._data.filteredData=filteredData;
                        // console.log('filteredData--->',app.data.filteredData);
                        // console.log('app.data.filteredData:',app.data.filteredData);
                        // console.log('this.filteredData:',this.filteredData);

                        this.loading = true;
                        this.loadingText = "Recalculating Distances...";
                        console.log('-----> THIS IS IT: ', item, item.label);
                        var cityCenterLat = app.centerLat;
                        var cityCenterLong = app.centerLong;
                        fetch("https://maps.googleapis.com/maps/api/geocode/json?address=" + item.label + "&key=AIzaSyDMPD_lI4LuNtvjkT3MZ44pUIZ5q1GJEv4", {
                            headers

                        }).then((response) => {
                            if (response.ok) {
                                return response.json();
                            }
                        }).then((response) => {
                            if (response.results.length > 0) {
                                cityCenterLat = response.results[0].geometry.location.lat;
                                cityCenterLong = response.results[0].geometry.location.lng;
                            }
                        });
                        var tempFilteredData = app.updateRadiusPosition(filteredData, app.centerLong, app.centerLat);
                        filteredData = tempFilteredData.filter(
                            function(a) {
                                console.log(a.dynamic_distance_miles, compareDistance);
                                if (a.dynamic_distance_miles <= compareDistance) {
                                    return true;
                                } else {
                                    return false;
                                }
                            });
                        console.log('test', filteredData);
                        this.loading = false;


                        break;
                    case 'rate':
                        filteredData = filteredData.filter(a => a.latest_overall_rating == value);
                        break;

                    case 'regulatedActivity':
                        filteredData = filteredData.filter(function(a) {

                            return a.latest_overall_rating == value;


                        });

                        break;

                }
            });



            if (type == "featured") {
                //  console.log('paid'+filteredData);
                this.resultPaid = filteredData;

            } else {
                this.mytotalCount = filteredData.length;
                this.resetPagination();
                console.log('RESULT FILETERED IS : ', filteredData);

                this.result = filteredData;
                if (value == 'name-asc' || value == 'name-desc') {
                    this.result = this.sortData(filteredData, value);
                }

            }




        },
        async filterData(key, value) {
            this.loading = true;
            this.loadingText = "Data is Filtering...";
            //   console.log('this.storedDataRaw.length',this.storedDataRaw.length);
            if (this.storedDataRaw.length > 0) {

                arraytemp = await this.getDataFromDb(true)
                    .then(response => {

                        this.doFilter('free');

                    }).then(response => {
                        this.doFilter('featured');
                    }).then(response => {

                        if (key) {
                            //   this.result = filteredData;
                            //     console.log(key,arraytemp);
                        } else {
                            //       console.log('nokey',arraytemp);
                            filteredData = this.storedDataRaw;
                            this.mytotalCount = this.storedDataRaw.length;
                            this.mytotalCount = this.storedDataRaw.length;

                            // this.result = filteredData;
                            this.loading = false;
                            this.responseAvailable = true;
                            return filteredData;
                        }

                        this.loading = false;
                        this.responseAvailable = true;
                    })

                    .catch(error => {
                        this.error = error
                    });

            } else {

                this.doFilter('free');
                this.doFilter('featured');
                //                this.loading = false;
                //                this.responseAvailable = true;

            }

            // Parse it to something usable in js



            // console.log('--------->'+arraytemp[0]);

            //


            // console.log("searchRadiusTown", this.searchRadiusTown )   ;

            //this.searchRadius=this.searchRadiusTown;
            //
            if (parseInt(this.searchRadius) > 0) {
                this.loading = true;
                this.loadingText = "Radius Applying...";

                this.responseAvailable = false;
                var compareDistance = this.searchRadius;

                console.log('---->radius', compareDistance);

                filteredData = this.result.filter(
                    function(a) {

                        //   console.log(a.distance_miles,compareDistance);
                        //   send data longLat to google map to check if is in radius
                        if (a.distance_miles <= compareDistance) {

                            return true;
                        } else {
                            return false;
                        }
                    });

                //this.updateMapRadiusCircle();

                //console.log('this.searchRadius:'+this.searchRadius);
                this.mytotalCount = filteredData.length;
                this.mytotalCount = filteredData.length;
                if (this.perpage != -1) {
                    this.mytotalPages = this.mytotalCount / this.perpage;
                    filteredPaged = this.pageData(filteredData, this.pageOfItems, this.perpage);
                } else {
                    //fiter based on filterText
                    filteredPaged = filteredData;


                }



                //console.log('------------Paged:---->'+filteredPaged);
                this.result = filteredPaged;

                this.loading = false;
                this.responseAvailable = true;

                //     return filteredPaged;

            } else {
                filteredData = this.result; //disabled radius for now

            }

            //  filteredData = this.result; //disabled radius for now
            //   this.result = _.sortBy( this.result, 'rate' );

            if (this.result.length > 0) {
                getLong = jQuery('#myVueData').data('long');
                getLat = jQuery('#myVueData').data('lat');
                if (getLong != null && getLat != null) {
                    this.initGmap(getLong, getLat);
                } else {
                    this.initGmap();
                }

            }

            this.loading = false;

            return;

        },
        async getDataFromDb(hidemessage) {



            this.loading = true;
            this.loadingText = "Data is loading from local Database...";

            return new Promise((resolve, reject) => {

                let trans = this.db.transaction(['cats'], 'readonly');
                trans.oncomplete = e => {
                    resolve(cats);
                    this.loading = false;

                };

                let store = trans.objectStore('cats');
                let cats = [];
                //    console.log('ALLAHU EKBER! DATA FOUND! ',cats);
                store.openCursor().onsuccess = e => {
                    let cursor = e.target.result;
                    if (cursor) {
                        cats.push(cursor.value)
                        cursor.continue();
                    }
                };

            });
        },
        async getDb() {
            return new Promise((resolve, reject) => {

                let request = window.indexedDB.open(DB_NAME, DB_VERSION);

                request.onerror = e => {
                    console.log('Error opening db', e);
                    reject('Error');
                };

                request.onsuccess = e => {
                    resolve(e.target.result);
                };

                request.onupgradeneeded = e => {
                    console.log('onupgradeneeded');
                    let db = e.target.result;
                    //     let objectStore = db.createObjectStore("cats", { autoIncrement: true, keyPath:'id' });
                    let objectStore = db.createObjectStore("cats");
                };
            });
        },
        updateRadiusPosition: function(data, cityCenterLong, cityCenterLat) {
            var resultdata = data.map(function(item, index) {
                item.dynamic_distance_miles = app.calculateDistance(item.latitude, item.longitude, cityCenterLat, cityCenterLong);
                console.log("item.dynamic_distance_miles:  ", item.dynamic_distance_miles);
                return item;
            });
            console.log("DATAAAAAAAA:  ", resultdata);
            return resultdata;
        },
        calculateDistance: function(lat1, long1, lat2, long2) {
            try {

                //            var userLat = this.userLocation.coords.latitude;
                //            var userLong = this.userLocation.coords.longitude;


                //    console.log(userLat,userLong);
                var kilometers = calcCrow(lat1, long1, lat2, long2);
                var miles = kilometers * 0.621371;
                returnMiles = Math.trunc(miles);
                console.log('returnMiles--->', returnMiles);
                return returnMiles;
            } catch (e) {
                return 'N/A';
            }

        },
        formatPhone: function(tel) {
            return tel.replace(/\s+/g, '').replace(/(.)(\d{4})(\d)/, '+44 ($1)$2 $3');

        },
        cleaner: function(title) {
            if (title) {
                var cleaned = title.toString()
                    .replaceAll("&amp;", /&/g, )
                    .replaceAll("&lt;", /</g)
                    .replaceAll("&gt;", />/g)
                    .replaceAll("&quot;", /"/g)
                    .replaceAll("&#8217;", "'")
                    .replaceAll("&#038;", "&")
                    .replaceAll("&#38;", "&")
                    .replaceAll("&#8217;", /'/g)
                    .replaceAll("&#8211;", "-")
                    .replaceAll("&#039;", /'/g);;

                return cleaned;
            } else {
                return title;
            }

        },

        togglePlaceFilters: function() {
            this.placeFiltersVisible = !this.placeFiltersVisible;

            if (this.placeFiltersVisible) {
                this.pullTaxonomy('ag_primary_inspection_cat');

                this.pullTaxonomy('specialist_service');
                this.pullTaxonomy('ag_staff');
                this.pullTaxonomy('ag_brand');


            }

        },
        togglePlaceSorters: function() {
            this.placeSortersVisible = !this.placeSortersVisible;

            if (this.togglePlaceSorters) {


            }

        },
        clearCache: function() {
            this.clearDatabase();
            //  window.localStorage.clear();
        },
        filterLiveData: function(rawData) {
            rawData = rawData ? rawData : this.result;

            arraytemp = rawData;
            // Parse it to something usable in js




            if (this.searchRadius) {
                filteredData = arraytemp.filter(a => a.distance_miles <= this.searchRadius);
            } else {
                filteredData = arraytemp; //disabled radius for now
            }
            this.responseAvailable = false;
            this.mytotalCount = filteredData.length;
            if (this.perpage != -1) {
                this.mytotalPages = this.mytotalCount / this.perpage;
                filteredPaged = this.pageData(filteredData, this.pageOfItems, this.perpage);
            } else {

                filteredPaged = filteredData;
            }


            this.result = filteredPaged;

            this.loading = false;
            this.responseAvailable = true;



            return filteredPaged;

        },
        toggleFilters: function() {
            this.filtersVisible = !this.filtersVisible;

            if (this.filtersNotInit) {
                this.pullTaxonomy('ag_type_sector');
                this.pullTaxonomy('ag_regions');
                this.pullTaxonomy('ag_cities');
                this.pullTaxonomy('ag_county');
                this.pullTaxonomy('ag_local_authority');
                this.pullTaxonomy('ag_staff');
                this.pullTaxonomy('ag_brand');
                this.pullTaxonomy('ag_inspection_directorate');
                this.pullTaxonomy('ag_primary_inspection_cat');
                this.pullTaxonomy('ag_ownership_type');

            }

        },
        getRate: function(locationID, storedRate) {
            return storedRate;
            this.loading = true;
            this.loadingText = "Getting Locations CURRENT Ratings...";

            fetch("//www.agespace.org/wp-json/emin/cqc/?locationID=" + locationID, {
                headers

            }).then((response) => {
                if (response.ok) {
                    return response.json();

                }
            }).then((response) => {


                this.loading = false;
                liveRate = response.currentRatings.overal.rating;
                console.log(locationID, liveRate, storedRate);
                if (storedRate !== liveRate) {
                    //UPDATE
                    //    console.log('Stored  location rate is ' +storedRate);
                    //    console.log('Need to update this location rate to ' +liveRate);
                    return liveRate;
                } else {
                    return storedRate;
                }
                //console.log('Stored  location rate is ' +storedRate);

            }).catch((e) => {
                if (e.response) {
                    console.log(e.statusText);
                } else {
                    console.log("Network Connection Error");
                }
                console.log(storedRate);
                return storedRate;
            });
        },

        pullTaxonomy: function(param) {



            fetch("//www.agespace.org/wp-json/emin/postmeta?tax=" + param + "", {
                headers

            }).then((response) => {
                if (response.ok) {
                    return response.json();

                }
            }).then((response) => {


                switch (param) {
                    case "ag_cities":
                        this.cities = response;

                        break;
                    case "ag_type_sector":
                        this.types = response;
                        break;
                    case "ag_regions":
                        this.regions = response;
                        break;
                    case "ag_county":
                        this.counties = response;
                        break;
                    case "ag_staff":
                        this.staffs = response;
                        break;
                    case "specialist_service":
                        this.filter_specialistServices = response;
                        break;
                    case "ag_brand":
                        this.brands = response;
                        break;
                    case "ag_inspection_directorate":
                        this.inspectionDirectorates = response;
                        break;
                    case "ag_primary_inspection_cat": // SERVICE TYPE
                        this.serviceTypesFilter = response;
                        // this.filter_serviceTypes=response;
                        break;
                    case "ag_ownership_type":
                        this.ownershipTypes = response;
                        break;
                    case "ag_local_authority":
                        this.localAuthorities = response;
                        break;



                }




            });
        },
        addURLParam: function(key, value) {

            this.redirectParams.push({
                "key": key,
                "value": value
            });
            //consoe.log(this.redirectParams);
            //            if (value === "0") {
            //                this.searchFilters.pop({"slug": filterType});
            //            } else {
            //
            //                this.searchFilters.push({"slug": filterType, "label": label, "value": value, "optionText": optiontxt});
            //            }

        },

        sorterChange: function(event) {
            var value = event.target.value;

            var index = event.target.selectedIndex;


            arraytemp = this.result;

            if (this.searchRadius) {
                filteredData = arraytemp.filter(a => a.distance_miles <= this.searchRadius);
            } else {
                filteredData = arraytemp; //disabled radius for now
            }
            this.sortBy = value;
            sortedData = this.sortData(filteredData, this.sortBy);

            this.result = sortedData;
        },
        dynamicSort: function(property) {
            var sortOrder = 1;

            if (property[0] === "-") {
                sortOrder = -1;
                property = property.substr(1);
            }

            return function(a, b) {
                if (sortOrder == -1) {
                    return b[property].localeCompare(a[property]);
                } else {
                    return a[property].localeCompare(b[property]);
                }
            }
        },
        sortData: function(filteredData, sortBy) {
            switch (sortBy) {
                case 'name-desc':
                    sortedData = filteredData.sort(this.dynamicSort("-title"));
                    break;
                case 'name-asc':
                    sortedData = filteredData.sort(this.dynamicSort("title"));
                    break;
            }

            return sortedData;
        },
        scrollTo: function(el) {
            document.querySelector(el).scrollIntoView({
                behavior: 'smooth'
            });
        },
        filterApply: function(filterType, label, event, jQuery, index, label, multifilter, pop) {
            this.anyFilterApplied = true;
            if (jQuery) {
                var value = event;

                this.filterChange(filterType, label, event, true, index, label, multifilter, pop);
                this.filterData(filterType, value);
            } else {
                var value = event.target.value;
                this.filterChange(filterType, label, event);
                this.filterData(filterType, value);
            }



            //            var index = event.target.selectedIndex;
            //            var optiontxt = event.target[index].text;


            //
            //
            //            this.filterText = "&" + this.searchFilters.map(function (elem) {
            //                return elem.slug + "=" + elem.value;
            //            }).join("&");


            //    console.log(this.filterText);

            //this.getData('place');


            //    this.scrollTo('#show-results');

        },
        resetCheckboxes: function() {
            jQuery('#specialist_service_select').parent().find('.checkbox.checked').removeClass('checked');
        },
        removeFilter: function(filterSlug) {

            jQuery("#" + filterSlug + "_select").val(0);
            jQuery("#sorter_select").val();
            this.resetPagination();
            this.searchFilters.pop({
                "slug": filterSlug
            });
            this.filterData('refresh');
        },
        filterChange: function(filterType, label, event, jQuery, selectedIndex, optiontxt, multifilter, pop) {

            if (jQuery) {
                var value = event;

                var index = selectedIndex;
                var optiontxt = optiontxt;
            } else {
                var value = event.target.value;


                var index = event.target.selectedIndex;
                var optiontxt = event.target[index].text;
            }

            console.log('Emin multifilter: ' + multifilter);
            console.log("Here in filterChange", this.searchFilters);
            console.log('pop the ', pop, 'multifilter', multifilter);


            if (filterType == "specialist_service") {
                if (value === "0") {

                    this.searchFilters = this.searchFilters.filter((element) => element.slug !== "specialist_service");
                    //                      popIndex = this.searchFilters.findIndex(( element ) => element.slug === filterType);
                    //                    if (popIndex >= 0 ) {
                    //                         this.searchFilters.splice(popIndex,1);
                    //                    }
                    //                   // this.searchFilters.pop({"slug": filterType});
                    //                  this.resetCheckboxes();
                }

                if (pop) {

                    popIndex = this.searchFilters.findIndex((element) => element.value === value.toString());

                    //    console.log('pop the ', value,'popIndex',popIndex,popIndex2,popIndex3);
                    if (popIndex >= 0) {
                        this.searchFilters.splice(popIndex, 1);
                    }




                } else {
                    if (value !== "0") {
                        this.searchFilters.push({
                            "slug": filterType,
                            'serviceTypeName': optiontxt,
                            'serviceTypeID': value,
                            "label": label,
                            "value": value,
                            "optionText": optiontxt
                        });
                    }

                }

            } else {


                if (value === "0") {

                    popIndex = this.searchFilters.findIndex((element) => element.slug === filterType);

                    //    console.log('pop the ', value,'popIndex',popIndex,popIndex2,popIndex3);
                    if (popIndex >= 0) {
                        this.searchFilters.splice(popIndex, 1);
                    }

                } else {
                    popIndex = this.searchFilters.findIndex((element) => element.slug === filterType);

                    if (popIndex >= 0) {
                        this.searchFilters.splice(popIndex, 1);
                    }
                    this.searchFilters.push({
                        "slug": filterType,
                        "label": label,
                        "value": value,
                        "optionText": optiontxt
                    });
                }
            }

            //                    
            //  if(multifilter){//checbox
            //
            //               
            //               
            //                  
            ////                existingIndex2 = this.searchFilters.findIndex(({ slug }) => slug === 'serviceTypeName');
            ////                 
            ////                console.log("filterType: ",filterType);
            ////                
            ////                 console.log("existingIndex: ",existingIndex);
            //                
            //                //   console.log("existingIndex2: ",existingIndex2);
            //       
            //  }else{
            //  
            //            if (value === "0") {
            //              
            //                this.searchFilters.pop({"slug": filterType});
            //            } else {
            //
            //                existingIndex0 = this.searchFilters.findIndex(({ slug }) => slug === filterType);
            //              
            //              
            //                if (existingIndex0 >= 0) {
            //                    this.searchFilters.pop({"slug": filterType});
            //                }
            //
            //
            //                if (filterType == "serviceType") {
            //                    existingIndex = this.searchFilters.findIndex(({ slug }) => slug === 'serviceTypeID');
            //                    if (existingIndex >= 0 ) {
            //                        this.searchFilters.pop({"slug": 'serviceTypeID'});
            //                    }
            //                    existingIndex2 = this.searchFilters.findIndex(({ slug }) => slug === 'serviceTypeName');
            //                    if (existingIndex2 >= 0 ) {
            //                        this.searchFilters.pop({"slug": 'serviceTypeName'});
            //                    }
            //
            //                    this.searchFilters.push({"slug": filterType,'serviceTypeName':optiontxt,'serviceTypeID':serviceTypeID, "label": label, "value": value, "optionText": optiontxt});
            //                //    this.searchFilters.push({"slug": 'serviceTypeID', "label": label, "value": value, "optionText": optiontxt});
            //                    
            //                   
            //                } else {
            //
            //
            //                    //all other filters
            //                  
            //                    this.searchFilters.push({"slug": filterType, "label": label, "value": value, "optionText": optiontxt});
            //                }
            //            }
            //        }
            //console.log(this.searchFlters);



        },
        //        testJS:function (event) {
        //           alert('ding');
        //            var value = event.target.value;
        //            console.log('-----UPDATED RADIUS------->'+value);
        //            this.searchRadius = value ? value : this.searchRadius;
        //
        //            this.filterData();
        //        },
        radiusChange: function(event) {

            var value = event.target.attributes.rel.value;
            console.log('----------------------------------------------------------UPDATED RADIUS------->', event);
            // console.log('-----UPDATED RADIUS------->'+value);
            this.searchRadius = value ? value : this.searchRadius;

            this.filterData();
        },
        checkEnter: function(e) {
            if (e.keyCode === 13) { //pressed enter
                // this.keyword=this.keyword.toUpperCase();
                if (this.redirect) {
                    this.doSearch();
                }

            }
        },
        whiteSpace: function(a) {

            if (typeof a === 'undefined') {
                return 'no-rating';
            }
            return a.toLowerCase().replace(/\s/g, "");
        },

        validatePostcode: function(postcode) {
            this.loading = true;
            this.loadingText = "Validating Postcode...";
            this.searchString = "&" + this.keyword + '&page=' + this.pageOfItems;

            fetch("//api.postcodes.io/postcodes/" + this.postcodeQuery + "/validate", {
                headers

            }).then((response) => {
                if (response.ok) {
                    return response.json();
                    this.loading = false;
                }
            }).then((response) => {
                this.isPostcode = response.result;

                if (this.isPostcode) {

                    this.keywordType = "postcode";
                } else {
                    this.keywordType = "city";
                }


            });


        },
        postcodeToPlace: function(postcode) {
            this.loading = true;
            this.loadingText = "Getting Place From Postcode...";
            this.searchString = "&" + this.keyword + '&page=' + this.pageOfItems;

            fetch("//api.postcodes.io/postcodes/" + this.postcodeQuery + "/validate", {
                headers

            }).then((response) => {
                if (response.ok) {
                    return response.json();
                    this.loading = false;
                }
            }).then((response) => {
                this.isPostcode = response.result;

                if (this.isPostcode) {

                    this.keywordType = "postcode";
                } else {
                    this.keywordType = "city";
                }


            });


        },
        convertCityToLongLat: function() {
            this.loading = true;
            this.loadingText = "Getting Place Info...";


            this.searchString = "&" + this.keyword + '&page=' + this.pageOfItems;

            fetch("//www.agespace.org/wp-json/emin/city?per_page=" + this.requestedItemCount + "&filter_distance=" + this.searchRadius + "&city=" + this.keyword + this.filterText, {
                headers

            }).then((response) => {
                if (response.ok) {
                    return response.json();
                    this.loading = false;
                }
            }).then((response) => {
                try {
                    this.postcodeQueryLatitude = response[0].latitude;
                    this.postcodeQueryLongitude = response[0].longitude;

                    this.cityName = response[0].name;
                    this.cityType = response[0].type;


                    this.fetchQuery = "//www.agespace.org/wp-json/emin/location?per_page=" + this.requestedItemCount + "&placeName=" + this.placeName + "&" + this.placeType + "=" + this.placeID + "&filter_distance=" + this.searchRadius + "&keyword=" + this.cityName + "&longitude=" + this.postcodeQueryLongitude + "&latitude=" + this.postcodeQueryLatitude + this.filterText;
                    this.getData();
                } catch (e) {
                    console.log(e);
                }

            });


        },

        convertPostcodeToLongLat: function(postcode) {

            this.loading = true;
            this.loadingText = "Checking Postcode...";
            this.searchString = "&" + this.keyword + '&page=' + this.pageOfItems;
            var localData = JSON.parse(window.localStorage.getItem(this.keyword + '-geo'));

            if (localData) {
                //load from localstorage



                // console.log(localData.result[0]);
                this.postcodeQueryLatitude = localData.result[0].latitude;
                this.postcodeQueryLongitude = localData.result[0].longitude;
                this.placeName = localData.result[0].admin_county;


                this.fetchQuery = "//www.agespace.org/wp-json/emin/location?per_page=" + this.requestedItemCount + "&placeName=" + this.placeName + "&" + this.placeType + "=" + this.placeID + "&filter_distance=" + this.searchRadius + "&keyword=" + this.postcodeQuery + "&longitude=" + this.postcodeQueryLongitude + "&latitude=" + this.postcodeQueryLatitude + this.filterText;
                this.getData();

            } else {
                this.loading = true;
                this.loadingText = "GEO Data is Calculating...";
                console.log('GEO Data is Calculating');
                fetch("//api.postcodes.io/postcodes?q=" + this.postcodeQuery, {
                    headers

                }).then((response) => {
                    if (response.ok) {
                        return response.json();
                        this.loading = false;
                    }
                }).then((response) => {
                    console.log(response);
                    if (response.result == null) {
                        this.loading = true;
                        this.loadingText = "POSTCODE IS WRONG! PLEASE TRY AGAIN!";
                    }
                    try {
                        this.postcodeQueryLatitude = response.result[0].latitude;
                        this.postcodeQueryLongitude = response.result[0].longitude;
                        $placeName = response.result[0].admin_county ? response.result[0].admin_county : response.result[0].admin_district;
                        console.log($placeName, response.result[0], response);
                        this.placeName = $placeName;

                        // this.addData(response,this.keyword,'geo');
                        window.localStorage.setItem(this.keyword + '-geo', JSON.stringify(response));


                        this.addURLParam(this.placeType, this.placeID); // city,8274
                        this.addURLParam('placeName', this.placeName);
                        this.addURLParam('serviceTypeID', this.serviceTypeID);
                        this.addURLParam('serviceTypeName', this.serviceTypeName);
                        this.addURLParam("keyword", this.keyword);
                        this.addURLParam("longitude", this.postcodeQueryLongitude);
                        this.addURLParam("latitude", this.postcodeQueryLatitude);


                        if (this.redirect) {
                            this.redirectTo();
                        }

                        //   this.fetchQuery = "//www.agespace.org/wp-json/emin/location?per_page=" + this.requestedItemCount + "&placeName=" + this.placeName + "&" + this.placeType + "=" + this.placeID + "&filter_distance=" + this.searchRadius + "&keyword=" + this.postcodeQuery + "&longitude=" + this.postcodeQueryLongitude + "&latitude=" + this.postcodeQueryLatitude + this.filterText;
                        //   this.getData();
                    } catch (e) {
                        console.log(e);
                    }
                });

            }




        },

        distance: function(lat, long) {
            try {

                //            var userLat = this.userLocation.coords.latitude;
                //            var userLong = this.userLocation.coords.longitude;

                var userLat = this.postcodeQueryLatitude;
                var userLong = this.postcodeQueryLongitude;
                //    console.log(userLat,userLong);
                var kilometers = calcCrow(userLat, userLong, lat, long);
                var miles = kilometers * 0.621371;
                return Math.trunc(miles);
            } catch (e) {
                return 'N/A';
            }

        },
        resetPagination: function() {
            this.currentPage = 1;

            page = this.currentPage;
            per_page = this.infinitePerPage;
            offset = (page - 1) * per_page;
            data = jQuery('#result-area-free .results > li');
            jQuery('.make-visible').removeClass();
            paginatedItems = data.slice(offset).slice(0, per_page);
            //  console.log(paginatedItems);
            jQuery(paginatedItems).addClass('make-visible');

            this.currentPage++;


            this.paginationFinished = false;
            if (this.mytotalCount <= per_page ) {
                this.paginationFinished = true;
            }

        },
        //        infinitePagination: function () {
        //
        //            //hide all listings except perpage first elements
        //            //virtual page is 1
        //            // check if perpage x page + 100px is inside viewport
        //            //if that is inside viewpoert, make next perpage elements visible 
        //            //update current virtualPage ++
        //
        //            page = this.currentPage;
        //            per_page = this.infinitePerPage;
        //            offset = (page - 1) * per_page;
        //            
        //            console.log(page, per_page, offset, this.mytotalCount);
        //            if (offset >= this.mytotalCount && offset != 0) {
        //                this.paginationFinished = true;
        //  this.currentPage++;
        //            } else {
        //              this.resetPagination(false);
        //            }
        //        },
        infinitePagination: function() {

            //hide all listings except perpage first elements
            //virtual page is 1
            // check if perpage x page + 100px is inside viewport
            //if that is inside viewpoert, make next perpage elements visible 
            //update current virtualPage ++

            page = this.currentPage;
            per_page = this.infinitePerPage;
            offset = (page - 1) * per_page;
            console.log(page, per_page, offset, this.mytotalCount);
            if (offset >= this.mytotalCount && offset != 0) {
                this.paginationFinished = true;

            } else {
                data = jQuery('#result-area-free .results > li');
                paginatedItems = data.slice(offset).slice(0, per_page);

                var i;
                for (i = 1; i <= paginatedItems.length; i++) {
                    jQuery(paginatedItems).eq(i).addClass('make-visible').addClass('delay-' + i);
                }




                this.currentPage++;
            }
            if (this.mytotalCount <= per_page ) {
                this.paginationFinished = true;
            }
        },
        pageData: function(data, page, per_page) {


            offset = (page - 1) * per_page,
                paginatedItems = data.slice(offset).slice(0, per_page),
                this.mytotalPages = Math.ceil(data.length / per_page);


            return paginatedItems;
        },
        changePage: function(pageOfItems) {
            // update page of items
            this.pageOfItems = pageOfItems.target.value;

            //    window.scrollTo(0, 0);
            this.filterData();

            //   this.doSearch();
        },
        findInObject: function(obj, key, value) {

            return obj.filter(
                function(obj) {
                    return obj.key == value
                }
            );


        },
        doFeaturedSearch: function(serviceTypeID, placeName) {
            storedFeaturedData = localStorage.getItem('featured-' + this.placeName);
            if (storedFeaturedData) {

                storedFeaturedData = JSON.parse(storedFeaturedData);
                this.storedFeaturedData = storedFeaturedData;
                this.resultPaid = storedFeaturedData;
                this.responseAvailablePaid = true;

            } else {

                customFetchQuery = "https://www.agespace.org/wp-json/emin/location?featured=" + placeName + "&per_page=1&serviceTypeID=" + serviceTypeID;
                fetch(customFetchQuery, {
                        headers

                    })
                    .then(response => {
                        if (response.ok) {


                            return response.json();
                        } else {
                            alert("Server returned " + response.status + " : " + response.statusText);
                        }
                    })
                    .then(response => {
                        this.resultPaid = response;
                        this.storedFeaturedData = response;

                        localStorage.setItem('featured-' + this.placeName, JSON.stringify(response));
                        this.responseAvailablePaid = true;



                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        showAllPlaceData: function(keyword) {
            this.keyword = urlParams.get('keyword') ? urlParams.get('keyword') : keyword;
            this.filter_distance = urlParams.get('filter_distance') ? urlParams.get('filter_distance') : this.filter_distance;
            this.responseAvailable = false;
            this.placeName = urlParams.get('placeName') ? urlParams.get('placeName') : this.placeName;
            this.serviceTypeID = urlParams.get('serviceTypeID') ? urlParams.get('serviceTypeID') : this.serviceTypeID;
            this.serviceTypeName = urlParams.get('serviceTypeName') ? urlParams.get('serviceTypeName') : this.serviceTypeName;
            this.postcodeQueryLatitude = urlParams.get('latitude') ? urlParams.get('latitude') : 52.6140;
            this.postcodeQueryLongitude = urlParams.get('longitude') ? urlParams.get('longitude') : 0.8864;


            var params = "&placeName=" + this.placeName +
                "&" + this.placeType + "=" + this.placeID +
                "&latitude=" + this.postcodeQueryLatitude +
                "&longitude=" + this.postcodeQueryLongitude +
                "&serviceTypeID=" + this.serviceTypeID +
                "&serviceTypeName=" + this.serviceTypeName

                +
                "&filter_distance=" + this.filter_distance


            this.filterText = "&" + this.searchFilters.map(function(elem) {
                return elem.slug + "=" + elem.value;
            }).join("&");


            if (!this.postcodeResultPage) { //locatio page
                //    this.searchRadius = 25;
                this.visibleDistance = false;
            }
            //        if (!("geolocation" in navigator)) {
            //            this.errorStr = 'Geolocation is not available.';
            //            return;
            //        }
            //        this.gettingLocation = true;
            //        // get position
            //        navigator.geolocation.getCurrentPosition(pos => {
            //            this.gettingLocation = false;
            //            this.userLocation = pos;
            //            console.log(pos);
            //              this.postcodeQueryLatitude = this.userLocation.coords.latitude;
            //         this.postcodeQueryLongitude  = this.userLocation.coords.longitude;
            //            
            //        }, err => {
            //            this.gettingLocation = false;
            //            this.errorStr = err.message;
            //        })
            this.fetchQuery = "//www.agespace.org/wp-json/emin/location?sortby=title&per_page=" + this.requestedItemCount + this.filterText + params;

            //      
            //if(this.postcodeResultPage){
            //     this.fetchQuery = "//www.agespace.org/wp-json/emin/location?sortby=title&per_page=" + this.requestedItemCount + "&placeName=" + this.placeName + "&" + this.placeType + "=" + this.placeID + "&filter_distance=" + this.searchRadius + "&keyword=" + this.postcodeQuery + "&longitude=" + this.postcodeQueryLongitude + "&latitude=" + this.postcodeQueryLatitude + this.filterText;
            //
            //}else{
            //     this.fetchQuery = "//www.agespace.org/wp-json/emin/location?sortby=title&per_page=" + this.requestedItemCount + "&placeName=" + this.placeName + "&" + this.placeType + "=" + this.placeID  +"&filter_distance=200"+ this.filterText;
            //
            //           
            //}

            this.getData('place');
        },

        doSearch: function(keyword) {
            console.log(this.keyword, keyword);
            if (keyword.type == 'click') {
                if (this.keyword == null) {

                    this.warningMessage = "Please Enter Postcode or Region name...";
                    return;
                }

            } else {
                this.keyword = keyword ? keyword : this.keyword;
            }



            if (this.keyword && this.keyword != "") {

                this.warningMessage = null;

                this.postcodeQuery = this.keyword;
                this.responseAvailable = false;

                this.filterText = "&" + this.searchFilters.map(function(elem) {
                    return elem.slug + "=" + elem.value;
                }).join("&");


                //check if its postcode
                var postcoderegex = "^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$";
                var temp = this.keyword.toUpperCase();
                //
                //http://api.postcodes.io/postcodes/SY4%205AA/validate

                //
                var patt = new RegExp(postcoderegex);
                this.isPostcode = patt.test(temp);
                // console.log('isPostcode --->', this.isPostcode);
                //
                //                console.log('--->', this.keyword);
                if (this.isPostcode) {

                    this.keywordType = "postcode";



                    this.warningMessage = null;
                    //     searchString =  this.postcodeQuery + '&page=' + this.pageOfItems;


                    // fetchQuery ="//www.agespace.org/wp-json/emin/location?per_page=3&filter[meta_key]=location_postal_code&filter[meta_compare]=LIKE&filter[meta_value]="+searchString;
                } else {

                    this.warningMessage = "Please Enter Postcode or Region name...";

                    //  this.keywordType="city";
                    //  this.keywordType="city";
                    //                    this.loading = true;
                    //                    this.loadingText = "Checking Keyword Type...";
                    //
                    //                    //check if it's town/city/region
                    //                    fetch("//maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" + this.keyword + "&inputtype=textquery&fields=name,rating,geometry&key="+apikey, {
                    //                        headers
                    //
                    //                    }).then((response) => {
                    //                        if (response.ok) {
                    //                            return response.json();
                    //                            this.loading = false;
                    //                        }
                    //                    }).then((response) => {
                    //                        this.loading = false;
                    //                        console.log(response.result[0]);
                    //                        if (response.candidates.name) {
                    //                            this.keywordType = "city";
                    //                            this.postcodeQueryLatitude = response.result[0].candidates.geometry.location.lat;
                    //                            this.postcodeQueryLongitude = response.result[0].candidates.geometry.location.lng;
                    //                        }
                    //
                    //
                    //
                    //
                    //                    });
                    //                    


                }




                switch (this.keywordType) {



                    case 'postcode':

                        this.searchRadius = this.searchRadius < 1 ? 15 : this.searchRadius;


                        this.convertPostcodeToLongLat();
                        break;


                        //                    case 'city' :
                        //
                        //this.searchRadius=this.searchRadius < 1 ? 25 : this.searchRadius ;
                        //     this.convertCityToLongLat();
                        //                   
                        //                        break;


                    default:
                        //                        this.searchRadius=0;
                        //                        this.searchString = this.keyword + '&page=' + this.pageOfItems;
                        //
                        //                        this.fetchQuery = "//www.agespace.org/wp-json/emin/location?per_page="+this.requestedItemCount+"&search=" + this.searchString + this.filterText;
                        //                        this.getData();
                        break;
                }




            } else {
                this.warningMessage = "Please Enter Enter Postcode...";
            }
        },
        sortTowns() {
            var options = jQuery('#ag_cities_select option').not('#ag_cities_select option:first-child');
            var arr = options.map(function(_, o) {
                return {
                    t: jQuery(o).text(),
                    v: o.value
                };
            }).get();
            arr.sort(function(o1, o2) {
                return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
            });
            options.each(function(i, o) {
                o.value = arr[i].v;
                jQuery(o).text(arr[i].t);
            });
        },
        createFilters: function(serviceTypeID, placeType, placeID, filterName) {

            this.loading = true;
            this.loadingText = "Filters are creating...";
            //    this.fetchQuery = "//www.agespace.org/wp-json/emin/location?sortby=title&per_page=" + this.requestedItemCount + "&placeName=" + this.placeName + "&" + this.placeType + "=" + this.placeID + "&filter_distance=" + this.searchRadius + "&keyword=" + this.postcodeQuery + "&longitude=" + this.postcodeQueryLongitude + "&latitude=" + this.postcodeQueryLatitude + this.filterText;
            storedFilterData = localStorage.getItem(filterName + '-' + this.placeName);
            if (storedFilterData) {

                storedFilterData = JSON.parse(storedFilterData);
                this.storedFeaturedData = storedFeaturedData;
                switch (filterName) {
                    case 'city':
                        this.filter_cities = storedFilterData;
                        //    console.log('SORTED');



                        break;
                    case 'serviceType':
                        this.filter_serviceType = storedFilterData;
                        break;
                    case 'specialistServices':
                        this.filter_specialistServices = storedFilterData;
                        break;
                    case 'regulatedActivity':
                        this.filter_regulatedActivity = storedFilterData;
                        break;

                    case 'rate':
                        this.filter_rate = storedFilterData;
                        break;
                }


                this.filtersAreAvailable = true;

            } else {
                //this.getData('place');
                customFetchQuery = "//www.agespace.org/wp-json/emin/location?per_page=100&filtersOnly=1&filterName=" + filterName + "&" + placeType + "=" + placeID + "&serviceTypeID=" + serviceTypeID;
                //     customFetchQuery=" https://www.agespace.org/wp-json/emin/location?per_page=100&county=8325&serviceTypeID=12179&filtersOnly=1&filterName=city";

                fetch(customFetchQuery, {
                        headers

                    })
                    .then(response => {
                        if (response.ok) {


                            return response.json();
                        } else {
                            alert("Server returned " + response.status + " : " + response.statusText);
                        }
                    })
                    .then(response => {

                        switch (filterName) {
                            case 'city':
                                this.filter_cities = response;
                                //    console.log('SORTED');



                                break;
                            case 'serviceType':
                                this.filter_serviceType = response;
                                break;
                            case 'specialistServices':
                                this.filter_specialistServices = response;
                                break;
                            case 'regulatedActivity':
                                this.filter_regulatedActivity = response;
                                break;

                            case 'rate':
                                this.filter_rate = response;
                                //                                    this.filter_rate =  [
                                //        {"name": "Outstanding"},
                                //          {"name": "Good"},
                                //            {"name": "Requires Improvement"},
                                //              {"name": "Inadequate"},
                                //           
                                //
                                //                
                                //
                                //                   
                                //                ];;
                                break;
                        }

                        localStorage.setItem(filterName + '-' + this.placeName, JSON.stringify(response));
                        this.filtersAreAvailable = true;



                    })
                    .catch(err => {
                        console.log(err);
                    });

            }
        },
        //        birthFilter:function(data){
        //          filter_specialistServices=[];
        //          filter_serviceType=[];
        //          filter_cities=[];
        //              data.forEach(function(item,index){
        //                  
        //                   item.specialist_service.forEach(function(item,index){
        //                         this.filter_specialistServices.push({ "name": item.specialist_service[index].name, "value": item.specialist_service[index].term_id});
        //                   });
        //       
        //                item.filter_serviceType.forEach(function(item,index){
        //                         this.filter_serviceType.push({ "name": item.service_category[index].name, "value": item.service_category[index].term_id});
        //                   });
        //          item.filter_cities.forEach(function(item,index){
        //                         this.filter_cities.push({ "name": item.county[index].name, "value": item.county[index].term_id});
        //                   });
        //            
        ////            
        ////                if(item.county)
        ////                  filter_cities.push({ "name": item.county[index].name, "value": item.county[index].term_id});
        ////                  
        //            });
        //      this.filter_specialistServices=filter_specialistServices;
        //      this.filter_serviceType=filter_serviceType;
        //  console.log(  this.filter_specialistServices,this.filter_serviceType);
        //        },
        fetchAPIData: function(customFetchQuery) {

            customFetchQuery = customFetchQuery ? customFetchQuery : this.fetchQuery;

            fetch(customFetchQuery, {
                    headers

                })
                .then(response => {
                    if (response.ok) {
                        //      this.loading = false;

                        this.resultCount = response.headers.get('x-wp-total') ? response.headers.get('x-wp-total') : false;
                        this.totalPages = response.headers.get('X-WP-TotalPages') ? response.headers.get('X-WP-TotalPages') : false;

                        return response.json();
                    } else {
                        alert("Server returned " + response.status + " : " + response.statusText);
                    }
                })
                .then(response => {
                    try {
                        this.resultCount = this.resultCount ? this.resultCount : response[0].totalresult;
                        this.totalPages = this.totalPages ? this.totalPages : response[0].totalpages;
                    } catch (e) {

                    }

                    if (this.resultCount < 1) {
                        this.loading = false;
                        this.noResultFound = true;
                        this.responseAvailable = true;
                        this.responseAvailablePaid = true;
                        return;
                    }

                    // this.createFilters(response);


                    if (!window.indexedDB) {
                        console.log("Your browser doesn't support a stable version of IndexedDB. Such and such feature will not be available.");
                    } else {




                        if (this.db) {

                            // this.clearDatabase();


                            try {
                                // response[0]['keyword']="test";

                                this.keyword = this.keyword;
                                //                                    type = "Norfolk";//must set on landing page using php or JS maybe
                                //                                    console.log(type);
                                this.addData(response, this.keyword, this.placeName);


                                this.responseAvailable = true;
                                this.result = response;
                                //this.result=  this.filterLiveData(response);
                                this.storedDataRaw = response;
                                this.filterData();
                                //    this.filterLiveData();

                                //localStorage.setItem('searched_data',JSON.stringify(response)); 


                                //console.log(response);
                                //this.result.formatDate=response.date;

                            } catch (e) {
                                console.log(e);

                                //alert('LocalStorage Database Quota exceeded!'); //data wasn't successfully saved due to quota exceed so throw an error
                                this.loading = true;

                                this.loadingText = e;

                            }


                        }

                    }


                    if (this.redirect) {
                        this.redirectTo();
                    }


                })
                .catch(err => {
                    console.log(err);
                });

        },
        getData: function(keyword) {
            this.keyword = keyword ? keyword : this.keyword;
            this.loading = true;

            this.loadingText = "Preparing Data...";




            this.addURLParam(this.placeType, this.placeID); // city,8274
            this.addURLParam('placeName', this.placeName);
            this.addURLParam('serviceTypeID', this.serviceTypeID);
            this.addURLParam('serviceTypeName', this.serviceTypeName);
            this.addURLParam("keyword", this.keyword);
            //   console.log(this.storedDataRaw);
            if (this.storedDataRaw.length < 1) {
                // console.log(this.db ,this.placeType,this.placeID,this.keyword,this.placeName);
                if (this.db) { //this.db removed
                    this.loading = true;
                    this.loadingText = "Data is loading from local Database...";
                    this.checkDatabaseForData(this.keyword, this.placeName).then((res) => {

                        if (res) {

                            this.addURLParam("cached", true);

                            if (this.isResultPage || this.doSearchInit) {
                                //this.result=res;
                                this.storedDataRaw = res;
                                this.loading = false;
                                this.resetPagination();
                                this.filterData();


                                //  this.createFilters(res);
                                //this.filterLiveData(res);
                            } else {
                                //nothing
                            }
                            if (this.redirect) {
                                this.redirectTo();
                            }




                        }

                    }, (err) => {
                        if (err == false) {
                            this.addURLParam("cached", false);

                            this.loading = true;
                            this.loadingText = "Data is loading from Server...";
                            if (this.redirect) {
                                this.redirectTo();
                            }
                            this.fetchAPIData();
                        }
                    });


                }


            } else {
                this.loading = true;
                this.loadingText = "Data is loading from RAM...";
                this.result = this.storedDataRaw;
                this.filterData();

            }
        }
    }




});


//This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
function calcCrow(lat1, lon1, lat2, lon2) {
    var R = 6371; // km
    var dLat = toRad(lat2 - lat1);
    var dLon = toRad(lon2 - lon1);
    var lat1 = toRad(lat1);
    var lat2 = toRad(lat2);

    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d;
}

// Converts numeric degrees to radians
function toRad(Value) {
    return Value * Math.PI / 180;
}


Vue.component('preloader-item-featured', {
    template: `
    <div class="preloader-list-item featured ph-item">
    <div class="p-image"></div>
    <div class="wrap">
    <div class="space-between">
<div class="p-title"></div>
    
    <div class="p-badge"></div>
</div>
    
   
   <div class="space-between">
<div>
 <div class="p-list-item"></div>
        <div class="p-list-item"></div>
    <div class="p-list-item"></div>
</div>
    
    
  <div class="p-button"></div>
</div>
   
</div>

</div>
`
});



Vue.component('preloader-item-free', {
    template: `
    <div class="preloader-list-item ph-item">
<div class="p-title"></div>
    <div class="p-badge"></div>
    <div class="p-button"></div>
</div>
`
});