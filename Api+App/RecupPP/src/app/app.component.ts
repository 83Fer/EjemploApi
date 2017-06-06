import { Component, OnInit } from '@angular/core';
import { ClienteService } from './servicios/cliente.service';
import { Http, HttpModule} from '@angular/http'

 

import { Cliente } from './clases/cliente';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {


  title = 'Primer Parcial Laboratorio 4!!';
  muestra : boolean = true;
  datosClientes : Array<any>;

  //Variables
  nomApell : string="Jorge Toledo";
  telefono: string="123213-12312"; 
  email: string="jor@gmail.com";
  sexo: string="Masculino"; 
  fecIngreso: string="2017/01/31"; 
  foto:string="23.jpg"; 
  direccion:string="Montevideo 123";
  localidad:string="Olavarria";


  constructor (public datosClieApi : ClienteService){

    console.log(datosClieApi.TraerTodosLosClientes()
      .then(datos => {
        // console.info(datosPersApi);
        this.datosClientes = datos;
    }).catch( error => {
      console.log(error);
    }));
    // console.info("Datos",datosPersApi);
  }

  //Agregar Persona
  AgregarCliente()
  {
    var cliente : Cliente = new Cliente();
    cliente.nomApell = this.nomApell;
    cliente.telefono = this.telefono;
    cliente.email = this.email;
    cliente.sexo = this.sexo;
    cliente.fecIngreso= this.fecIngreso;
    cliente.foto = this.foto;
    cliente.direccion = this.direccion;
    cliente.localidad = this.localidad;

    
    console.log(cliente);

    this.datosClieApi.AgregarCliente(cliente);
  }

  BorrarCliente(id:number)
  {
    console.log(id);

    this.datosClieApi.BorraCliente(id);
  }

}
