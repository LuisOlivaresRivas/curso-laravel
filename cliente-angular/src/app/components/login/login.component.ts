import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
    // tslint:disable-next-line: component-selector
    selector: 'login',
    templateUrl: './login.component.html'
})
export class LoginComponent implements OnInit{
    title: string;

    constructor(
        // tslint:disable-next-line: variable-name
        private _route: ActivatedRoute,
        // tslint:disable-next-line: variable-name
        private _router: Router
    ){
        this.title = 'Identificate';
    }
    ngOnInit(){
        console.log('login.component cargado correctamente!!');
    }
}
