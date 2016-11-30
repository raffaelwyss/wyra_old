var App = angular.module('App', [
    'ngRoute',
    'ngSanitize',
    'ngAnimate',
    'ngclipboard'
]).config([
    '$compileProvider',
    function($compileProvider) {
        let props = document.querySelector('html').getAttribute('data-properties');
        if (props) {
            props = JSON.parse(props);
            if (!props.debugMode) {
                $compileProvider.debugInfoEnabled(false);
            }
        }
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(http|https|mailto|tel:|):/);
    }
]);

moment.locale('de');
