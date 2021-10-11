<?php 

class Error_handle extends Exception 
{
  public function draw_message()
  {
    echo "Error : <b>" . $this->getMessage() . "</b><br>";
    echo "Code : <b>" . $this->getCode() . "</b><br>";
    echo "File : <b>" . $this->getFile() . "</b><br>";
    echo "Line : <b>" . $this->getLine() . "</b><br>";
    echo "<br>Trace Error</br>";
    foreach ($this->getTrace() as $item) {
      echo "<br></br>";
      echo "File : <b>" . $item["file"] . "</b><br>";
      echo "Line : <b>" . $item["line"] . "</b><br>";
      echo "<br></br>";
    }
  }
}

set_exception_handler(function ($e) {
  echo "Error : <b>" . $e->getMessage() . "</b><br>";
  echo "Code : <b>" . $e->getCode() . "</b><br>";
  echo "File : <b>" . $e->getFile() . "</b><br>";
  echo "Line : <b>" . $e->getLine() . "</b><br>";
  echo "<br>Trace Error</br>";
  foreach ($e->getTrace() as $item) {
    echo "<br></br>";
    echo "File : <b>" . $item["file"] . "</b><br>";
    echo "Line : <b>" . $item["line"] . "</b><br>";
    echo "<br></br>";
  }
});