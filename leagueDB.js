/**
 * Created by Colin Smith on 8/19/2014.
 */
var jumboHeight = $('.jumbotron').outerHeight();
function parallax(){
    var scrolled = $(window).scrollTop();
    $('.bg').css('height', (jumboHeight-scrolled) + 'px');
}

$(window).scroll(function(e){
    parallax();
});

var leagueApp = angular.module('leagueApp', ['ngRoute', 'ngAnimate', 'ngCookies','ui.directives']);

// configure our routes
leagueApp.config(function($routeProvider) {
    $routeProvider


        .when('/', {
            templateUrl : 'home.html',
            controller  : 'homeController'
        })

        // route for the home page
        .when('/home', {
            templateUrl : 'home.html',
            controller  : 'homeController'
        })

        // route for the about page
        .when('/select', {
            templateUrl : 'select.html',
            controller  : 'ContentCtrl'
        })

        // route for the contact page
        .when('/add', {
            templateUrl : 'add.html',
            controller  : 'addController'
        })

        //rout for the profile page
        .when('/delete', {
            templateUrl : 'deleteCharacter.html',
            controller  : 'deleteController'
        })

        .when('/signIn', {
            templateUrl : 'signIn.html',
            controller  : 'signInController'
        })

        .when('/register', {
            templateUrl : 'register.html',
            controller  : 'registerController'
        });
});

//used for sharing user object across controllers
leagueApp.factory('userObj', function($cookies){
    return {loggedIn: ''};
});

leagueApp.controller('logoutController', function($scope, $http, userObj, $cookies, $cookieStore) {
    $scope.logout= function ($route){

        $cookieStore.put("loggedIn", false);
        $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

        $route.reload();

    };
});

// create the controller and inject Angular's $scope
leagueApp.controller('homeController', function($scope, userObj) {
    // create a message to display in our view
    $scope.message = 'Everyone come and see how good I look!';
    $scope.pageClass = 'home';

    $scope.logout= function ($route){

        $cookieStore.put("loggedIn", false);
        $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

        $route.reload();
    };
});

leagueApp.controller('addController', function($scope, $http, $window, $route, userObj, $cookies, $cookieStore) {

    $scope.userObj = userObj;
    $scope.userObj.loggedIn = $cookieStore.get('loggedIn');
    $scope.userObj.username = $cookieStore.get('username');
    $scope.userObj.message = $cookieStore.get('message');
    $scope.custom_character = {};
    $scope.custom_character.username = $cookieStore.get('username');





    $http.post('custom_characters.php', $scope.userObj)
        .success(function(data) {
            $scope.characters =data;
            $scope.message ="you succeeded!";
        })
        .error(function(data, status, headers, config) {
         $scope.message ="Database error. Sorry.";
    });

    $http.post('custom_roles.php', $scope.userObj)
        .success(function(data) {
            $scope.roles =data;
            $scope.message ="you succeeded!";
        })
        .error(function(data, status, headers, config) {
            $scope.message ="Database error. Sorry.";
        });


    $http.post('custom_lanes.php', $scope.userObj)
        .success(function(data) {
            $scope.lanes =data;
            $scope.message ="you succeeded!";
        })
        .error(function(data, status, headers, config) {
            $scope.message ="Database error. Sorry.";
        });

    $http.post('custom_abilities.php', $scope.userObj)
        .success(function(data) {
            $scope.abilities =data;
            $scope.message ="you succeeded!";
        })
        .error(function(data, status, headers, config) {
            $scope.message ="Database error. Sorry.";
        });

    $scope.addCharacter = function (){
        $http({
            url: "addCharacter.php",
            data: $scope.custom_character,
            method: 'POST',
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}

        }).success(function(data){
            $scope.message = "Successfully added "+$scope.custom_character.name;

            $window.alert($scope.message);

            $route.reload();

        }).error(function(err){
            $scope.message="Database error. Sorry.";



        })

    };

    $scope.addAbilities = function (){
        $http({
            url: "addAbilities.php",
            data: $scope.custom_character,
            method: 'POST',
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}

        }).success(function(data){
            $scope.message = data

            $window.alert($scope.message);

            $route.reload();

        }).error(function(err){
            $scope.message="Database error. Sorry.";



        })

    };


    $scope.logout= function ($route){

        $cookieStore.put("loggedIn", false);
        $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

        $route.reload();
    };

});

leagueApp.controller('selectController', function($scope, $http, userObj, $cookies, $cookieStore) {
    $scope.pageClass = 'select';

    $scope.logout= function ($route){

        $cookieStore.put("loggedIn", false);
        $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

        $route.reload();
    };
});

leagueApp.controller('deleteController', function($scope, $window, $route, $http, userObj, $cookies, $cookieStore) {

    $scope.userObj = userObj;
    $scope.userObj.loggedIn = $cookieStore.get('loggedIn');
    $scope.userObj.username = $cookieStore.get('username');
    $scope.userObj.message = $cookieStore.get('message');


    $scope.custom_character = {};
    $scope.custom_character.username = $cookieStore.get('username');





    $http.post('custom_characters.php', $scope.userObj)
        .success(function(data) {
            $scope.characters =data;
            $scope.message ="you succeeded!";
        })
        .error(function(data, status, headers, config) {
            $scope.message ="Database error. Sorry.";
        });

    $http.post('custom_roles.php', $scope.userObj)
        .success(function(data) {
            $scope.roles =data;
            $scope.message ="you succeeded!";
        })
        .error(function(data, status, headers, config) {
            $scope.message ="Database error. Sorry.";
        });


    $http.post('custom_lanes.php', $scope.userObj)
        .success(function(data) {
            $scope.lanes =data;
            $scope.message ="you succeeded!";
        })
        .error(function(data, status, headers, config) {
            $scope.message ="Database error. Sorry.";
        });

    $http.post('custom_abilities.php', $scope.userObj)
        .success(function(data) {
            $scope.abilities =data;
            $scope.message ="you succeeded!";
        })
        .error(function(data, status, headers, config) {
            $scope.message ="Database error. Sorry.";
        });

    $scope.deleteCharacter = function (){
        $http({
            url: "deleteCharacter.php",
            data: $scope.custom_character,
            method: 'POST',
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}

        }).success(function(data){
            $scope.message = data;

            $window.alert($scope.message);

            $route.reload();

        }).error(function(err){
            $scope.message="Database error. Sorry.";



        })

    };


    $scope.logout= function ($route){

        $cookieStore.put("loggedIn", false);
        $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

        $route.reload();
    };
});

leagueApp.controller('signInController', function($scope, $http, userObj, $cookies, $cookieStore) {

    $scope.userObj = userObj;
    $scope.userObj.loggedIn = $cookieStore.get('loggedIn');
    $scope.userObj.username = $cookieStore.get('username');
    $scope.userObj.message = $cookieStore.get('message');
    $scope.uid = "NULL";

    $scope.login = function (){
        $http({
            url: "login.php",
            data: $scope.user,
            method: 'POST',
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}

        }).success(function(data){
            $scope.uid = data;

            if($scope.uid != ""){
                $scope.message ="Welcome ";
                $cookieStore.put("loggedIn", true);
                $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

                var userinfo = $scope.user.username;
                $cookieStore.put ("username", userinfo );
                $scope.userObj.username = $cookieStore.get('username');

                var messageinfo = "Welcome ";
                $cookieStore.put ("message", messageinfo );
                $scope.userObj.message = $cookieStore.get('message');
            }
            else{
                $scope.message="The information you entered was incorrect. Please try again.";
                $cookieStore.put("loggedIn", false);
                $scope.userObj.loggedIn = $cookieStore.get('loggedIn');
            }

        }).error(function(err){
            $scope.message="Database error. Sorry.";
            $cookieStore.put("loggedIn", false);
            $scope.userObj.loggedIn = $cookieStore.get('loggedIn')
        })

    };

    $scope.logout= function ($route){

        $cookieStore.put("loggedIn", false);
        $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

        $route.reload();
    };
});

leagueApp.controller('registerController', function($scope, $http, userObj, $cookies, $cookieStore) {


    $scope.userObj = userObj;
    $scope.userObj.loggedIn = $cookieStore.get('loggedIn');
    $scope.userObj.username = $cookieStore.get('username');
    $scope.userObj.message = $cookieStore.get('message');

    $scope.register = function (){
        $http({
            url: "register.php",
            data: $scope.user,
            method: 'POST',
            headers : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}

        }).success(function(data){
            $scope.message = data;

        }).error(function(err){
            $scope.message="Database error. Sorry.";
        })

    };

    $scope.logout= function ($route){

        $cookieStore.put("loggedIn", false);
        $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

        $route.reload();
    };
	
});

leagueApp.controller('ContentCtrl', ['$scope', '$http', function ($scope, $http, userObj) {
    $http.get('characters.php')
        .success(function(data) {
            $scope.characters = data;
            $scope.success ="you succeeded!";

        })
        .error(function(data, status, headers, config) {
            $scope.fail="Error1: Unable to connect to database 1...Sorry!";
        });

    $http.get('lanes.php')
        .success(function(data) {
             $scope.lanes =data;
             $scope.success2 ="you succeeded!";

        })
        .error(function(data, status, headers, config) {
            $scope.fail2 ="Error2: Unable to connect to database 2...Sorry!";
         });

    $http.get('roles.php')
        .success(function(data) {
            $scope.roles =data;
            $scope.success3 ="you succeeded!";

        })
        .error(function(data, status, headers, config) {
            $scope.fail3 ="Error3: Unable to connect to database 3...Sorry!";
        });

    $http.get('abilities.php')
        .success(function(data) {
            $scope.abilities =data;
            $scope.success4 ="you succeeded!";

        })
        .error(function(data, status, headers, config) {
            $scope.fail4 ="Error3: Unable to connect to database 3...Sorry!";
        });

    $scope.logout= function ($route){

        $cookieStore.put("loggedIn", false);
        $scope.userObj.loggedIn = $cookieStore.get('loggedIn');

        $route.reload();
    };

}]);







