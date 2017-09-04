<?php

class linklist {
    public $key;
    public $data;
    public $next = null;

    public function __construct($key,$data){
        $this->key = $key;
        $this->data = $data;
    }
}

class dataItem {
    public $data;
    public $key;
    public $next = null;

    public function __construct($key,$data){
        $this->data = $data;
        $this->key = $key;
    }
}

class hashTable {
    private $hashArray = array();
    private $sizeOfHash = 0;

    public function getSizeOfHash(){
        return $this->sizeOfHash;
    }

    private function hashGenerator($key){
        return $key%100;
    }

    public function KeyExist($key){
        if(isset($this->hashArray[$this->hashGenerator($key)])) return true;
        else return false;
    }

    public function insertData($dataItem){
        if(!$this->KeyExist($dataItem->key)){
            $TempEl = array($dataItem->key,$dataItem->data,NULL);
            $this->hashArray[$this->hashGenerator($dataItem->key)] = $TempEl;
        }else {
            if($this->hashArray[$this->hashGenerator($dataItem->key)][2] == NULL){
                $this->hashArray[$this->hashGenerator($dataItem->key)][2] = new linklist($dataItem->key,$dataItem->data);
            }else {
                $current = $this->hashArray[$this->hashGenerator($dataItem->key)][2]->next;
                $addto = "->next";
                while($current != null){
                    $current = $current->next;
                    $addto .= "->next";
                }
                eval('$this->hashArray[$this->hashGenerator($dataItem->key)][2]'.$addto.' = new linklist($dataItem->key,$dataItem->data);');
            }
        }
        $this->sizeOfHash++;
    }

    public function searchData($key){
        if(!$this->KeyExist($key)){
            echo "Data Not found 1";
        }else {
            if($this->hashArray[$this->hashGenerator($key)][0] == $key ){
                echo $this->hashArray[$this->hashGenerator($key)][1];
            }elseif($this->hashArray[$this->hashGenerator($key)][2] == NULL){
                echo "Data Not found 2";
            }else {
                $current = $this->hashArray[$this->hashGenerator($key)][2]->next;
                $before_current = $this->hashArray[$this->hashGenerator($key)][2];
                $addto = "";
                while($current != null && $before_current->key != $key){
                    $before_current = $current;
                    $current = $current->next;
                    $addto .= "->next";
                }

                if($current == null){
                    if($before_current->key != $key) echo "Data Not found 3";
                    else eval('echo $this->hashArray[$this->hashGenerator($key)][2]' . $addto . '->data;');
                }else {
                    eval('echo $this->hashArray[$this->hashGenerator($key)][2]' . $addto . '->data;');
                }
            }
        }
        $this->sizeOfHash++;
    }

    public function displayAll(){
        var_dump($this->hashArray);
    }
}

$data = new dataItem(12,"-12");
$newHashT = new hashTable();
$newHashT->insertData($data);
$data = new dataItem(112,"-112");
$newHashT->insertData($data);
$data = new dataItem(312,"-312");
$newHashT->insertData($data);
$data = new dataItem(412,"-412");
$newHashT->insertData($data);
$data = new dataItem(2,"-2");
$newHashT->insertData($data);
$newHashT->displayAll();
echo "<br /><br />";
$newHashT->searchData(412);
?>