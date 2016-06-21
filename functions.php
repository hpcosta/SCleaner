	
<?php
/************************************************************************************************************************/
/****************************************************Auxiliary Functions*************************************************/
/************************************************************************************************************************/
/*Autor: Hernani Costa***************************************************************************************************/
/*Last Update: 17-June-2014**********************************************************************************************/
/************************************************************************************************************************/

function sentenceDetector($sentences){ 
	$re = '/# Split sentences on whitespace between them.
	    (?<=                # Begin positive lookbehind.
	      [.!?]             # Either an end of sentence punct,
	    | [.!?][\'"]        # or end of sentence punct and quote.
	    )                   # End positive lookbehind.
	    (?<!                # Begin negative lookbehind.
	      Mr\.              # Skip either "Mr."
	    | Mrs\.             # or "Mrs.",
	    | Ms\.              # or "Ms.",
	    | Jr\.              # or "Jr.",
	    | Dr\.              # or "Dr.",
	    | Prof\.            # or "Prof.",
	    | Sr\.              # or "Sr.",
	    | T\.V\.A\.         # or "T.V.A.",
	                        # or... something.	
	    )                   # End negative lookbehind.
	    \s+                 # Split on whitespace between sentences.
	    /ix';

	/*$text = 'This is sentence one. Sentence two! Sentence thr'.
	        'ee? Sentence "four". Sentence "five"! Sentence "'.
	        'six"? Sentence "seven." Sentence \'eight!\' Dr. '.
	        'Jones said: "Mrs. Smith you have a lovely daught'.
	        'er!" The T.V.A. is a big project!';*/
	$text = $sentences;
    
    //Splitting sentences (with some exceptions)
	$tempSentences = preg_split($re, $text, -1, PREG_SPLIT_NO_EMPTY);
	/*for debugging purposes*/
    //print 'sentences:'.count($tempSentences);
	//print '<br>';
    
	//This is necessary to clean whitespaces between the last word and the final mark (e.g. 'This is   sentence       one .')
	//And to prevent white spaces between words containing ä|ö|ü|ß
    $finalSentence="";
    for ($i = 0; $i < count($tempSentences); $i++) {
        $words = preg_split("/(?<=\w)\b\s*(^äöüß)/", $tempSentences[$i]);
		//printf("sentence[%d] = [%s]", $i, $words[0]);
		//print '<br>';
		$parts = preg_split('/\s+/', $words[0]);
		//var_dump($parts);
		
        $sentenceSize = count($parts);
        $tempSentence="";
		//print 'tamanho:'.$sentenceSize;
        for ($j=0; $j < $sentenceSize; $j++){
            //deleting whitespace between the last two words

            if($j==$sentenceSize-1 	){
				if( (strcmp('!', $parts[$j])==0) || (strcmp('?', $parts[$j])==0) || (strcmp('.', $parts[$j])==0) || (strcmp('...', $parts[$j])==0)){
					//print '>>>>>>@>'. $parts[$j];
					//print '<br>';
					$tempSentence = trim($tempSentence). trim($parts[$j]); 
				}else{
		            $tempSentence = $tempSentence . $parts[$j]." "; 
		        }
                //print 'j==size-2 || j==size-1';
				//print  $parts[$j];    
            }else{
                $tempSentence = $tempSentence . $parts[$j]." "; 
            }
            //printf("word[%d] = [%s] -  [%s]\n", $j + 1, $parts[$j], $tempSentence);
            //print '<br>';
        }
        //print '<br>';      
        $finalSentence[$i] = $tempSentence;
        //printf("Sentence[%d] = [%s]\n", $i + 1, $finalSentence[$i]);
	}
    
    
	return $finalSentence;
	/*for ($i = 0; $i < count($finalSentence); ++$i) {
	    printf("Sentence[%d] = [%s]\n", $i + 1, $finalSentence[$i]);
	}*/	
}//END function sentenceDetector
/*
see: http://stackoverflow.com/questions/5032210/php-sentence-boundaries-detection
*/
?>