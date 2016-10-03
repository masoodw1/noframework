<?php
//to do:
// - hidden fields: choose fields to hide and set their value 
// - post actions after

$this_page = "sch01_algo.php";
require 'custom_functions.php';
//simplexml_load_file("");

$xml=simplexml_load_file("contact_sfObject.xml");
$fields = $xml->xpath("/complexType/complexContent/extension/sequence/element");
if ($fields) {
// the last parameter is field name in wp it is field but with wsdl it is name
//---- BELOW IS THE TEST CODE TO GET FIELD NAMES----/*
//echo "<h2>All Fields</h2> ";
 foreach ($fields as $field) {
     $field_val = (string)$field->attributes()['name'];
     $method = "not defiened";
    $data[ $field_val] =  $method;
   // echo "[[".$field_val."]]<br>"; ///// test prints
    $field_lable = get_lable($field_val);
    $htmltr_for_fields[] = "<div>".
        "<label for='".$field_val."'>".$field_lable.":</label>
        <input type='text' id='".$field_val."'name='".$field_val."' />
    </div>";
 	// print_r(expression)
 }
 // print_r($htmltr_for_fields); exit;

echo "<h2>Register:</h2>";
echo '<FORM action="'.$this_page.'" method="post">';
 foreach ($htmltr_for_fields as $html_fields) {	
 	echo $html_fields;
 }
 echo '<INPUT type="submit" value="Send"> <INPUT type="reset"></FORM>';
echo "<h2>user input in json format:</h2>";
echo "<div style='background-color:#ccc;min-height: 200px; padding: 20px; border: 1px solid #78909c;'>";
if(empty($_POST)){echo "empty values"; }else{
    
    if(validate($_POST, NULL, 'test') == true){
     print_r(json_encode($_POST)); 
    }
    else{ echo "not valid";}
}
echo "</div>";
}
echo "<br><br><br><h3>data tests(validation methods)</h3> ";

// /////////-----------Define Validations for each fields here-----------/////////
// $data['meta_id'] = "notEmpty;;check::character;;regex;;/^([a-zA-Z]+\s)*[a-zA-Z]+$/";
// $data['comment_id'] = "isNumber;;check";
// $data['meta_value'] = "isNumber;;check";
require 'validation_commands.php';
$validation_data = json_decode($field_valid);
validate($_POST, $validation_data);
//print_r($data);





//////////////util funcitons/////////

function get_lable($str) {
return ucwords(str_replace("__c", "", $str));
}
//////////validation function///////
function validate($post, $data, $env='null'){
    if($env === 'test'){
    return true;
	}
	else{
		/*-----------------JSON Array format Approach-------------------*/
				foreach ($data as $data_key => $data_value) {
				
				//list of functions for the field; ----  print_r($data->{$data_key});
					$field_name = $data_key;
					$field_functions = $data->{$data_key};
					$i=0;
					//$function_names  = array();
					foreach ($field_functions as $field_key => $field_value) {
						$function_names[]=$field_key;
						
						$function_args[]=$field_value;
						$i++;
					}
					
				}
				
                $number_of_funcitons = count($function_names);
                for ($i=0; $i <$number_of_funcitons ; $i++) { 
                		$function_name = $function_names[$i];
                		$arguments = $function_args[$i];
                		//echo $arguments;
                		$multi_arguments = explode("::",$arguments);
                		if(isset($multi_arguments[1])){
                			call_user_func_array($function_name, $multi_arguments);
                		}
                		else{
                			call_user_func_array($function_name, $multi_arguments);
                		}
                	}

	}
}
function _alt_method(){
	/*-----------------String Delimiter Approach-------------------*/
		
		foreach ($data as $key => $value){
			if($value === 'not defiened'){
				unset($key);
			}
			else{
				$user_function_string = explode("::",$data[$key]);
				//--//$uftest[$key] = $user_function_string;
				//--//--//print_r($user_function[0]);///// test prints
			$field_key[]= $key;
			$ufsNumber = count($user_function_string);
			for ($i=0; $i < $ufsNumber; $i++) { 
				$user_function = explode(";;",$user_function_string[$i]);
				$function_name = $user_function[0]; //--// first keyword is alwsys function name and rest of the keywords are parameters
				$function_names[] = $function_name;
				//--// print_r(count($user_function));///// test prints
				$ufNumber = count($user_function);
				//--//$args=array();
				for ($j=1; $j < $ufNumber; $j++) { 
					
					$args[$i][]= $user_function[$j];
					
				}
				
				
			}

			
			
			}

		}
}

?>








<style>
    h2{
        font-family: Arial, Helvetica, sans-serif;
        background-color:#78909c;
        color:#fff;
    }
    h3{
        font-family: Arial, Helvetica, sans-serif;
        background-color:#e53935;
        color:#fff;
    }
    form {
    /* Just to center the form on the page */
    margin: 0 auto;
    width: 400px;
    /* To see the outline of the form */
    padding: 1em;
    border: 1px solid #CCC;
    border-radius: 1em;
}
form div + div {
    margin-top: 1em;
}
label {
    /* To make sure that all labels have the same size and are properly aligned */
    display: inline-block;
    width: 90px;
    text-align: right;
}
input, textarea {
    /* To make sure that all text fields have the same font settings
       By default, textareas have a monospace font */
    font: 1em sans-serif;

    /* To give the same size to all text field */
    width: 300px;
    -moz-box-sizing: border-box;
    box-sizing: border-box;

    /* To harmonize the look & feel of text field border */
    border: 1px solid #999;
}
input:focus, textarea:focus {
    /* To give a little highlight on active elements */
    border-color: #000;
}
textarea {
    /* To properly align multiline text fields with their labels */
    vertical-align: top;

    /* To give enough room to type some text */
    height: 5em;

    /* To allow users to resize any textarea vertically
       It does not work on all browsers */
    resize: vertical;
}
.button {
    /* To position the buttons to the same position of the text fields */
    padding-left: 90px; /* same size as the label elements */
}
button {
    /* This extra margin represent roughly the same space as the space
       between the labels and their text fields */
    margin-left: .5em;
}
</style>