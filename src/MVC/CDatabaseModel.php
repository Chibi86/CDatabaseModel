<?php
namespace Anax\MVC;

/**
 * Model for database-methods.
 *
 */
class CDatabaseModel implements \Anax\DI\IInjectionAware
{
  use \Anax\DI\TInjectable;
  
  /**
   * Get the table name
   *
   * @Return    String    The table name
   */
  public function getSource(){
    return strtolower(implode('', array_slice(explode('\\', get_class($this)), -1)));
  }
  
  /**
   * Get object properties.
   *
   * @Return    Array   With object properties.
   */
  public function getProperties()
  {
      $properties = get_object_vars($this);
      unset($properties['di']);
      unset($properties['db']);

      return $properties;
  }
  
  /**
   * Set object properties
   *
   * @Param   Array   $properties   Properties to set
   * @Return  Void
   */
  public function setProperties($properties){
    // Update object with incoming values, if any
    if(!empty($properties)){
      foreach($properties as $key => $val){
        $this->$key = $val;
      }
    }
  }
  
  /**
   * Find and return all
   *
   * @Return    Array
   */
  public function findAll()
  {
    $this->db->select()
             ->from($this->getSource());
    
    $this->db->execute();
    $this->db->setFetchModeClass(__CLASS__);
    return $this->db->fetchAll();
  }
  
  /**
   * Find and return specific row
   *
   * @Param   Int   $id   Row index
   * @Return  this
   */
  public function find($id = 0){
    $this->db->select()
             ->from($this->getSource())
             ->where("id = ?");
    
    $this->db->execute([$id]);
    return $this->db->fetchInto($this);
  }
  
  /**
   * Save current object/row
   * 
   * @Param   Array     $values     Key/values to save or empty to use object properties
   * @Return  Boolean   True/false  If saving went okey
   */
  public function save($values = []){
    $this->setProperties($values);
    $values = $this->getProperties();
    
    if(isset($values['id'])){
      return $this->update($values);
    }
    else{
      return $this->create($values);
    }
  }
  
  /**
   * Create new row
   *
   * @Param   Array     $values     Key/values to save
   * @Return  Boolean   True/false  If saving went okey
   */
  public function create($values = []){
    $keys   = array_keys($values);
    $values = array_values($values);
    
    $this->db->insert(
      $this->getSource(),
      $keys
    );
    
    $res = $this->db->execute($values);
    
    $this->id = $this->db->lastInsertId();
    
    return $res;
  }
  
  /**
   * Update row
   * 
   * @Param   Array     $values     Key/values to save
   * @Return  Boolean   True/false  If saving went okey
   */
  public function update($values = []){
    $keys   = array_keys($values);
    $values = array_values($values);
    
    // Its update, remove id and use where-clause
    unset($keys['id']);
    $values[] = $this->id;
    
    $this->db->update(
      $this->getSource(),
      $keys,
      "id = ?"
    );
    
    return $this->db->execute($values);
  }
  
  /**
   * Delete row
   *
   * @Param   Int       $id         Row index
   * @Return  Boolean   True/false  If deleting went okey
   */
  public function delete($id = 0){
    $this->db->delete(
      $this->getSource(),
      'id = ?'
    );
    
    return $this->db->execute([$id]);
  }
  
  /**
   * Build a select-query
   * 
   * @Param   String    $columns   Columns to select
   * @Return  Object    $this      
   */
  public function query($columns = "*"){
    $this->db->select($columns)
             ->from($this->getSource());
             
    return $this;
  }
  
  /**
   * Build the where part
   *
   * @Param   String    $condition    For bulding the where part of the query
   * @Return  Object    $this         
   */
  public function where($condition){
    $this->db->where($condition);
    
    return $this;
  }

  /**
   * Build more on the where part
   * 
   * @Param   string    $condition    For bulding the where part of the query
   * @Return  Object    $this
   */
  public function andWhere($condition){
    $this->db->andWhere($condition);
    
    return $this;
  }
  
  /**
   * Build a limit for query-request
   * 
   * @Param   Integer    $condition    For building limit part of query
   * @Return  Object    $this
   */
  public function limit($condition){
    $this->db->limit($condition);
    
    return $this;
  }
  
  /**
   * Build a offset for query-request
   * 
   * @Param   Integer    $condition    For building offset part of query
   * @Return  Object     $this
   */
  public function offset($condition){
    $this->db->offset($condition);
    
    return $this;
  }
  
  /**
   * Execute the query built
   *
   * @Param   String    $query    Custom query
   * @Return  Object    $this
   */
  public function execute($params = []){
    $this->db->execute($this->db->getSQL(), $params);
    $this->db->setFetchModeClass(__CLASS__);
    
    return $this->db->fetchAll();
  }
}
