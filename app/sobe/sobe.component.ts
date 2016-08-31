import { Component, Directive } from 'angular2/core';
import {Router, ROUTER_PROVIDERS, ROUTER_DIRECTIVES} from 'angular2/router';
import {Http, HTTP_PROVIDERS, Headers} from 'angular2/http';
import 'rxjs/Rx';
import {FORM_DIRECTIVES, FORM_BINDINGS} from 'angular2/common';
import {SearchPipe} from '../pipe/search';
import {SearchPipe2} from '../pipe/search2';

@Component({
  selector: 'Sobe',
  templateUrl: 'app/sobe/sobe.html',
  pipes: [SearchPipe, SearchPipe2],
  directives: [ROUTER_DIRECTIVES],
})


export class SobeComponent {

  router: Router;
  http: Http;
  kreveti: String = "";
  m2: String = "";

  sobe: Object[];
  constructor(router: Router, http: Http) {
    this.router = router;
    this.http = http;

    var headers = new Headers();


    if(localStorage.getItem('token') !== null){
      http.get('http://localhost/MetHotels/sobejson.php', { headers: headers })
      .map(res => res.json())
      .subscribe(sobe => { this.sobe = sobe; });
      
    }
    else{
    alert("Pretraga soba je moguca samo prijavljenim korisnicima.");      
      }
  }
}