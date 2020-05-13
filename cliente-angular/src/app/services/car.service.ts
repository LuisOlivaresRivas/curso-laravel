import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpClientModule } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { GLOBAL } from './global';
import { Car } from '../models/car';
import { Params } from '@angular/router';
import { isGeneratedFile } from '@angular/compiler/src/aot/util';

@Injectable()
export class CarService{
    public url: string;

    constructor(
        public _http: HttpClient
    ){
        this.url = GLOBAL.url;
    }
    pruebas(){
        return "Hola mundo";
    }
    create(token, car: Car): Observable<any> {
        let json = JSON.stringify(car);
        let params = 'json='+json;
        let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
                                        .set('Authorization', token);
        return this._http.post(this.url + 'cars', params, {headers: headers});
    }
    getCars(): Observable<any>{
        let headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded');
        return this._http.get(this.url + 'cars',  {headers: headers});
    }
}
