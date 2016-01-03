/**
 * Created by mithundas on 12/3/15.
 */
var appModule = angular.module("cpa",['ui.router','ui.bootstrap','ngAnimate', 'ngTouch','angular-confirm',
    'LocalStorageModule','toaster']);

appModule.config(function (localStorageServiceProvider) {
    localStorageServiceProvider
        .setPrefix('cpa')
        .setStorageType('localStorage') //sessionStorage
        .setNotify(true, true)

});


