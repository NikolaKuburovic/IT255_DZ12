System.register(['angular2/core', 'angular2/router', 'angular2/http', 'rxjs/Rx', '../pipe/search', '../pipe/search2'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
        var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
        if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
        else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
        return c > 3 && r && Object.defineProperty(target, key, r), r;
    };
    var __metadata = (this && this.__metadata) || function (k, v) {
        if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
    };
    var core_1, router_1, http_1, search_1, search2_1;
    var SobeComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (router_1_1) {
                router_1 = router_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (_1) {},
            function (search_1_1) {
                search_1 = search_1_1;
            },
            function (search2_1_1) {
                search2_1 = search2_1_1;
            }],
        execute: function() {
            SobeComponent = (function () {
                function SobeComponent(router, http) {
                    var _this = this;
                    this.kreveti = "";
                    this.m2 = "";
                    this.router = router;
                    this.http = http;
                    var headers = new http_1.Headers();
                    if (localStorage.getItem('token') !== null) {
                        http.get('http://localhost/MetHotels/sobejson.php', { headers: headers })
                            .map(function (res) { return res.json(); })
                            .subscribe(function (sobe) { _this.sobe = sobe; });
                    }
                    else {
                        alert("Pretraga soba je moguca samo prijavljenim korisnicima.");
                    }
                }
                SobeComponent = __decorate([
                    core_1.Component({
                        selector: 'Sobe',
                        templateUrl: 'app/sobe/sobe.html',
                        pipes: [search_1.SearchPipe, search2_1.SearchPipe2],
                        directives: [router_1.ROUTER_DIRECTIVES],
                    }), 
                    __metadata('design:paramtypes', [router_1.Router, http_1.Http])
                ], SobeComponent);
                return SobeComponent;
            }());
            exports_1("SobeComponent", SobeComponent);
        }
    }
});
//# sourceMappingURL=sobe.component.js.map