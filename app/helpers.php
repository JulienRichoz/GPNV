<?php

  /*function getGitLastTag()
  {
    return shell_exec("git describe --tags");
  }*/

  function getVersion(){
    $myfile = fopen("./version.tag", "r") or die("Unable to open file!");
    $version = fread($myfile,filesize("./version.tag"));
    fclose($myfile);
    return $version;
  }

  function getDateString($datetime){
    return date('m/d/Y', strtotime($datetime));
  }
?>
