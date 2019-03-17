<?php 

/**
-
- View Factory + Response Class
-
- Prerequisites
- Interface
- ob_* "start, get_clean"
-
-
--------------------------------
- Factory Design Pattern
- Factory Design Pattern Vs Singleton
-
- View  Factory Class : \System\View\ViewFactory
- View  Factory Class is responsible to to generate view objects
- which are basically will handle html files for view
- 
- Properties :
-
- private \System\Application $app
-
- Methods
-                       // main/home => main/home.php
- public \System\View\View render(string $viewPath, array $passedVariablesToView) Render the given view path with the passed variables and
- generate new View Object for it 
-
----------------- 
- ( System de closure )
- \System\View class implements \System\View\ViewInterface
- This class is responsible for calling views "files that will contain the html code " and passing some variables for it 
- 
- 
- Properties :
-
- private \System\File $file
- private array $data 
- private string $viewPath
- private string $output

- Methods
- public string getOutput()  {@inheritDoc}
- private void preparePath(string $viewPath) Generate the fall path for view path
- private bool  viewFileExists()  Determine if the view path exists in the view directory
- public string __toString() {@inheritDoc}
- 
  Notion de _toString()
  $obj = new Test;
  echo $obj;

--------------------------------------
-
- System\View\ViewInterface interface
-
- public string getOutput()  Generate the output of the view path and get it
- public string __toString() Treat the "System\View\View" object as string in printing
-
--------------------------------------
-
- Response Class
- This Class is responsible for handling all responses
- as the output will be passed to it to display it in the browser.
-
- Proprietes
-
- private \System\Application $app
- private array $headers = []
- private string $content = ''
-
- Methods
-
- public  void setOutput(string $content)  Set the output that will be send to the browser 
- public void setHeader($header , $value)  Add new header that will be send to the browser
- public void send()  Send the headers and the output
- private void sendHeaders() Send Headers
- private void sendOutput() Send Output
-
-
*/