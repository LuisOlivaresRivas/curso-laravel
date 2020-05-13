import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { isGeneratedFile } from '@angular/compiler/src/aot/util';



@Component({
    // tslint:disable-next-line: component-selector
    selector: 'default',
    templateUrl: './default.component.html',
    providers: [UserService]
})
export class DefaultComponent implements OnInit{
    public title: string;
    constructor(
        private _userService: UserService,
        private _route: ActivatedRoute,
        private _router: Router
    ){
        this.title = 'Inicio';
    }
    ngOnInit(){
        console.log('default.component cargado correctamente!!');
    }


}
