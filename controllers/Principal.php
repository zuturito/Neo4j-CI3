<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct(){
		parent :: __construct();
		$this->load->model('Modelo_neo4');
	}


	public function index(){
		$datos['nodos'] = $this->Modelo_neo4->regresaNodos();
		$this->load->view('principal', $datos, false);
	}


	public function guardar(){
		$nombre = $this->input->post('nombre');
		$ciudad = $this->input->post('ciudad');
		$salario = $this->input->post('salario');
		$this->Modelo_neo4->guardaNuevo($nombre,$ciudad,$salario);
	}

	public function eliminar(){
		$nombreborra = $this->input->post('nombreBorra');
		$this->Modelo_neo4->eliminarNodo($nombreborra);
	}




	public function ejemplo_de_conexion()
	{	
		//jala el folder de las librerias del Everyman que están dentro de vendor
		require('vendor/autoload.php');
		//constructor de un nuevo cliente de neo4j
    	$client = new Everyman\Neo4j\Client('localhost', 7474);
    	//se genera el acceso, con los datos de configuración por defecto de instalación del servidor neo4j o se pone el usuario y contraseña que uno da de alta al momento de instalarlo
    	$client->getTransport()->setAuth('neo4j','123456');

		//muestra los datos del servidor en caso de realizarse correctamente la conexión
    	//print_r($client->getServerInfo());


    	//query simple para seleccionar todos los nodos
		$queryString = 'MATCH (n) RETURN  n'; //"n" se toma como un valor temporal para representar los nodos
		$query = new Everyman\Neo4j\Cypher\Query($client, $queryString); //se genera la conexión de acuerdo a la documentación con los valores declarador arriba
		$resultkey = $query->getResultSet(); //resultSet() obtiene el resultado del execute query
		foreach ($resultkey as $row) {
		    echo json_encode($row['n']->name); // toma como referencia la linea o renglón que se obtiene y en mi BD tengo una propiedad llamado "NAME" en donde guardo nombres que es lo que únicamente me va pintar
		}
	}





}
