<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head profile="http://www.w3.org/2005/10/profile">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Hernani Costa" />
<meta name="description" content="This tool receives a raw text as a input and processes it.
Some of the features of this tool are the automatic sentence boundaries detection and the removal of whitespace between words.
The final process text is a clean text, without breaking lines or whitespaces." />
<meta name="keywords" content="Sentence boundary detection, Whitespace removal, Sentence splitter, Regular expressions." />

<title>SCleaner</title>
    
<link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="styles/style.css" />
    
</head>

<body>
    
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand">SCleaner<p class="sub-title">Sentence Splitter and Cleaner</p></a>
        </div>
        <div class="collapse navbar-collapse">
          
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    <div class="container">
        
        
        
        <div class="sentence-container">
                <?
                    //auxiliary functions
                    include 'functions.php';
                    
                    //global variables 
                    global $tableCols;
                    global $tableRows;
                    global $data;
                    $data='June, 2014';
                    $tableCols = 80;
                    $tableRows = 20;
                    
                    //print FORM
                    print '<div class="panel panel-info">';
                    print '<div class="panel-heading"><h3 class="panel-title">Raw Text</h3></div>';
                    print '<div class="panel-body">';
                    print '<form role="form" action="'.$_SERVER["PHP_SELF"].'" method="POST">';
                    print '<div class="form-group">';
                    print '<textarea id="rawText" class="form-control" cols="'.$tableCols.'" rows="'.$tableRows.'" name="rawtext">';
                    
                    $value = isset($_POST['rawtext']) ? $_POST['rawtext'] : null;
                    if($value==null){
                        print 'This is   sentence            one. 
                        
                                Sentence 
                                
                                two! Sentence three?                Sentence "four". 
                                
And   so   on    (öüßñîéêüã)... 
...$ # & ( ) [ ] @ > <  ¡ ¿ { } ? ' ;

                    }else{
                        print $value;
                    }
                    print '</textarea>';
                    print '</div>';
                    print '<button type="submit" class="btn btn-info">Submit</button>';
                    print '</form>';
                    print '</div>';
                    print '</div>';


                    //Get text
                    //$value = isset($_POST['rawtext']) ? $_POST['rawtext'] : null;
                    if($value!=null){
                        //$rawtext=preg_replace('/\s\s+/', ' ',$_GET["rawtext"]);
                        $sentences = sentenceDetector($_POST["rawtext"]);

                        print '<div class="panel panel-primary">';
                        print '<div class="panel-heading"><h3 class="panel-title">Text</h3></div>';
                        print '<div class="panel-body">';
                        print '<div class="form-group">';
                        print '<textarea id="ttext" class="form-control" cols="'.$tableCols.'" rows="'.$tableRows.'" name="text">';
                        for ($i = 0; $i < count($sentences); ++$i) {
                                $sentence = preg_replace('/\s\s+/', ' ',$sentences[$i]);
	                            //printf("Sentence[%d] = [%s]\n", $i + 1, trim($sentence));
                                printf("%s\n", trim($sentence));
	                    }
                        print '</textarea>';
                        print '</div>';
                        print '</div>';
                        print '</div>';
                    }

            ?>
            
        </div>
        
    </div>
    
    <div id="footer">
        <div class="container">
            <span class="footer-text"> Created by <a href="http://eden.dei.uc.pt/~hpcosta/" target="_blank"><b>Hernani Costa</b></a> @ <a href="http://lexytrad.es" target="_blank"><b>LEXYTRAD</b></a> | &copy; This tool has been (partially) carried out in the framework of: the Educational Innovation Project "TRADICOR: Corpora Management System for the Teaching Innovation in Translation and Interpreting" (ref. n. PIE 13-054, Project Type B University of Málaga Innovation and European Convergence Programs); the R&D project "INTELITERM: Intelligent Terminology Management System for Translators" (ref. n. FFI2012-38881, 2012-2015, Ministry of Economy and Competitiveness; and the R&D Project for Excelence "TERMITUR: Intelligent terminological dictionary for the tourism sector (German-English-Spanish)" (ref. n. HUM2754, 2014-2017, Andalusian Ministry for Education, Spain) | Last update: <?print $data ?>.
            </span>
        </div>
    </div>
    	
            
            
    <script href="libs/jquery/jquery-1.11.1.min.js"></script>  
    <script href="libs/bootstrap/js/bootstrap.min.js"></script>  
</body>
</html>
