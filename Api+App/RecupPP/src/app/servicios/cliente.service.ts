import { Injectable } from '@angular/core';

import { Http, Response, Headers, RequestOptionsArgs} from '@angular/http';

import 'rxjs/add/operator/toPromise';

import { Observable } from 'rxjs/Observable';


import { Cliente } from '../clases/cliente';


@Injectable()
export class ClienteService {
  headers:Headers;
  constructor(public http:Http) { }

  TraerTodosLosClientes()
  {
    let url = 'http://localhost:8080/ApiLab4/public/index.php/clientes';    
    return this.http
      .get(url)
      .toPromise()
      .then(this.ExtraerDatos)
      .catch(this.ErrorExtraerDatos);
  }

  ExtraerDatos(res: Response){
    return res.json() || "No ha datos";
  }

  ErrorExtraerDatos(res: Response){
    return "Error ";
  }

  // Agregar Persona
 AgregarCliente(cliente: Cliente) 
  { 
     let datos={
       '"nomApell"' :  cliente.nomApell ,
       '"telefono"' : cliente.telefono ,
       '"email"' : cliente.email ,
       '"sexo"' : cliente.sexo ,
       '"fecIngreso"' : cliente.fecIngreso ,
       '"foto"' : cliente.foto ,
       '"direccion"' : cliente.direccion,
       '"localidad"' : cliente.localidad 
            };
            console.log(datos);
    
    this.http.post("http://localhost:8080/ApiLab4/public/index.php/clientes/alta" , datos)
             .toPromise()
             .then()
             .catch(this.ErrorExtraerDatos)
  }

  BorraCliente(id:number)
  {

    this.http.delete("http://localhost:8080/ApiLab4/public/index.php/clientes/borrar/" + id)
             .toPromise()
             .then()
             .catch(this.ErrorExtraerDatos)

  }

}
