var dcapp = angular.module('scotchApp', ['ngRoute']);

// configure our routes
dcapp.config(function($routeProvider) {
    $routeProvider
    // route page initial
    .when('/', {
        templateUrl : 'data/home/app.html',
        controller  : 'mainController',
        activetab: 'inicio'
    })        
    // route usuarios
    .when('/user', {
        templateUrl : 'data/user/app.html',
        controller  : 'usuarioController',
        activetab: 'usuario'
    })          
      // route cargos
    .when('/cargo', {
        templateUrl : 'data/cargo/app.html',
        controller  : 'cargoController',
        activetab: 'cargo'
    })           
      // route clientes
    .when('/clientes', {
        templateUrl : 'data/clientes/app.html',
        controller  : 'clientesController',
        activetab: 'clientes'
    })  
       // route planes
    .when('/planes', {
        templateUrl : 'data/planes/app.html',
        controller  : 'planesController',
        activetab: 'planes'
    })                
        // route tiposPlan
    .when('/tiposPlan', {
        templateUrl : 'data/tiposPlan/app.html',
        controller  : 'tiposPlanController',
        activetab: 'tiposPlan'
    })     
      // route interfaces                    
     .when('/interfaces', {
        templateUrl : 'data/interfaces/app.html',
        controller  : 'interfacesController',
        activetab: 'interfaces'
    })                         
});
 
dcapp.factory('Auth', function($location) {
    var user;
    return {
        setUser : function(aUser) {
            user = aUser;
        },
        isLoggedIn : function() {
            var ruta = $location.path();
            var ruta = ruta.replace("/","");
            var accesos = JSON.parse(Lockr.get('users'));
                accesos.push('inicio');
                accesos.push('');

            var a = accesos.lastIndexOf(ruta);
            if (a < 0) {
                return false;    
            } else {
                return true;
            }
        }
    }
});


dcapp.run(['$rootScope', '$location', 'Auth', function ($rootScope, $location, Auth) {
    $rootScope.$on('$routeChangeStart', function (event) {
        var rutablock = $location.path();
        
    });
}]);

    