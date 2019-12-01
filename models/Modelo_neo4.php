<?php

class Modelo_neo4 extends CI_Model{

	function __construct(){
		require('vendor/autoload.php');
	}

 	function regresaNodos(){
        $client = new Everyman\Neo4j\Client('localhost', 7474);
        $client->getTransport()->setAuth('neo4j','123456');
        $queryString = 'MATCH (n) RETURN  n';
        $query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
        $resultkey = $query->getResultSet();
        return $resultkey;
    }

    function guardaNuevo($nombre,$ciudad,$salario){
        $client = new Everyman\Neo4j\Client('localhost', 7474);
        $client->getTransport()->setAuth('neo4j','123456');
        $client->makeNode()->setProperty('nombre',$nombre)->setProperty('Ciudad',$ciudad)->setProperty('sal',$salario)->save();
        return 'OK';
    }

    function eliminarNodo($nombreborrar){
        $client = new Everyman\Neo4j\Client('localhost', 7474);
        $client->getTransport()->setAuth('neo4j','123456');
        $queryString = "MATCH (n) WHERE n.nombre='".$nombreborrar."' RETURN ID(n) as ID";
        $query = new Everyman\Neo4j\Cypher\Query($client, $queryString);
        $resultkey = $query->getResultSet();
        $ID_BORRAR=json_encode($resultkey[0]['ID']);
        $client->getNode($ID_BORRAR)->delete();
        return 'OK';
    }


}