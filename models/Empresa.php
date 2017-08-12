<?php

class Empresa extends Illuminate\Database\Eloquent\Model
{
protected $table ='businnes';
protected $primaryKey = 'idNegocio';

//desactivar created_at updated_at
public $timestamps =false; 

}
?>