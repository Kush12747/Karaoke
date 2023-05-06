<?php

  include("karaokelib.php");

  class Karaoke implements \JsonSerializable{
    # attributes
    public $pdo;
    public $srt;
    public $dir;

    # methods
    function __construct($dsn, $username, $password, $srt = "Location", $dir = "ASC") {
      $this->pdo = new PDO($dsn,$username,$password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $this->srt = $srt;
      $this->dir = $dir;
    }

    public function jsonSerialize() {
      return [
        'srt' => $this->srt,
        'dir' => $this->dir
      ];
    }

    # accesors
    function get_pdo() {
      return $this->pdo;
    }
    function get_srt() {
      return $this->srt;
    }
    function get_dir() {
      return $this->dir;
    }

    # mutators

    # sets the current free sort to $sort
    function set_srt($srt) {
      $this->srt = $srt;
    }
    # sets the current free direction to $d
    function set_dir($dir) {
      $this->dir = $dir;
    }

    function flip_dir() {
      if ($this->get_dir() == "ASC") {
        $this->set_dir("DESC");
      } else {
        $this->set_dir("ASC");
      }
    }

  }

?>