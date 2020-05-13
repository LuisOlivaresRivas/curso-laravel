import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { User } from '../../models/user';
import { Car } from '../../models/car';
import { UserService } from '../../services/user.service';
import { CarService } from '../../services/car.service';
import { isGeneratedFile } from '@angular/compiler/src/aot/util';




@Component({
    // tslint:disable-next-line: component-selector
    selector: 'default',
    templateUrl: './default.component.html',
    providers: [UserService, CarService]
})
export class DefaultComponent implements OnInit{
    public title: string;
    public cars: Array<Car>;
    constructor(
        private _userService: UserService,
        private _carService: CarService,
        private _route: ActivatedRoute,
        private _router: Router
    ){
        this.title = 'Inicio';
    }
    ngOnInit(){
        console.log('default.component cargado correctamente!!');
        this._carService.getCars().subscribe(
            response => {
                if (response.status == 'success'){
                    this.cars = response.cars;
                }
            },
            error => {
                console.log(error);
            }
        );
    }


}
