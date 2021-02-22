<?php

class Bd	
{
	private $link;
	function __construct()
	{
		
		try{
			$this->link= new PDO("mysql:host=localhost;dbname=blog", "root", "");
			$this->link->exec("set names utf8mb4");
		}
		catch(PDOException $e){
			$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 			return $dato;
 			die();
 		}
 		
	}
		
	function __get($var){
		return $this->$var;
	}
}

/**
 * 
 */
class Post
{
	private $id;
	private $title;
	private $status;
	private $content;
	private $user_id;

	function __construct($id,$title,$status,$content,$user_id)
		{
		$this->id=$id;
		$this->title=$title;
		$this->status=$status;
		$this->content=$content;
		$this->user_id=$user_id;
	}
	function buscar ($link)
	{
		try{
			$sql = $link->prepare("SELECT * FROM posts where id='$this->id'");
    		$sql->execute();
    		return $sql->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
	}
	static function getAll($link){
			try{
				$consulta="SELECT * FROM posts";
				$result=$link->prepare($consulta);
				$result->execute();
				$result->setFetchMode(PDO::FETCH_ASSOC);
       			return $result->fetchAll();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
		}
	function insertar ($link){
		try{
			$sql = "INSERT INTO posts (title, status, content, user_id) VALUES ('$this->title', '$this->status', '$this->content', '$this->user_id')";
    		$result = $link->prepare($sql);   
    		$result->execute();
    		return $link->lastInsertId();
    	}
    	catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
	}
	function borrar ($link)
	{
		try{
			$sql = $link->prepare("DELETE FROM posts where id='$this->id'");
    		$sql->execute();
    		return $sql->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
	}
	function getParams($input)
 	{
   	 $filterParams = [];
    	foreach($input as $param => $value)
    	{
    		
    		$filterParams[] = "$param='$value'";
    	}
    	return implode(", ", $filterParams);
	}
	function modificar ($link,$param){
		try{
			$fields =$this->getParams($param);
			$sql = "UPDATE posts SET $fields  WHERE id='$this->id' ";
			echo $sql;
    		$result = $link->prepare($sql);   
    		$result->execute();
    		
    	}
    	catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
 				return $dato;
 				die();
 			}
	}
}