<?php 
/** UploadedFile.php ==> System\Http
|- Uploading Files System
|- 
|- Pre-Requisites
|- Uploading Files
|-
|- Content
|- UploadFile Class
|- Completing Validation Class
|- Ajax Upload
|-
|- Proprieties :
|- private \System\Application $app
|- private array  $file : The Uploaded Data given from _FILES variable
|- private string $filename : Uploaded File name ( With Extension)
|- private string $name : Uploaded File name ( With Extension)
|- private string $extension : Uploaded extension
|- private string $mime : Uploaded File Mime Type
|- private string $tempFile : Uploaded Temp File extension
|- private int $size : File Size in bytes
|- private in $error : Get Uploaded File Error
|-
|- 
|- Methods
|- public bool exists() : Determine whether the file is uploaded
|- public string getFileName()  : Get the File Name of the uploaded file
|- public string getNameOnly()  : Get the file name (without extension)
|- public string getExtension() : Get the file extension
|- public string getMimeType()  : Get the file Mime Type
|- public string moveTo(string $target, string $fileName = null) : Upload the  File
|- public bool isImage() : Determine whether the uploaded file is image
|- private void getFileInfo(string $input) : Prepare and get uploaded file info
|-
|- Your Task
|- private void setFileSize()  : Set the file Size
|- public string getFileSize() : Get the file Size
|-
--|