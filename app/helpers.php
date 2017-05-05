<?php

  function getGitLastTag()
  {
    return shell_exec("git describe --tags");
  }
?>
