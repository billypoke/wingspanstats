var myapp = angular.module('mainApp', []);
myapp.controller('mainController',function($scope,$http){

    $scope.contents = '';
   try{
        $http.get('results/2016-12/agents.json')
            .then(
                function(success){
                    console.log("SUCCESS");
                    $scope.contents = success.data
                    
                    
                },
                function(error){
                    console.log("ERR");
                    console.log(error);
                }
            );
            
        }
    catch(err){
        console.log(err.name + ":" + err.message);
    }
    $scope.propertyName = 'ships_destroyed';
  $scope.reverse = true;

  $scope.sortBy = function(propertyName) {
    $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
    $scope.propertyName = propertyName;
  };
    // $scope.contents = [{heading:"Content heading", description:"The actual content"}];
    //Just a placeholder. All web content will be in this format
});