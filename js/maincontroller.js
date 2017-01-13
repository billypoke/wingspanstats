var myapp = angular.module('mainApp', []);
myapp.controller('mainController',function($scope,$http){

    $scope.contents = '';
   try{
        $http.get('database/2016-12/2016-12_01.json')
            .then(
                function(success){
                    console.log("SUCCESS");
                    $scope.contents = success.data
                    console.log(success.data)
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
    // $scope.contents = [{heading:"Content heading", description:"The actual content"}];
    //Just a placeholder. All web content will be in this format
});