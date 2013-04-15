<?

//////////////////////////////////////////
//                                      //
//   Google Code Jam 2013               //
//   https://code.google.com/codejam    //
//   Problem C. Fair and Square         //
//                                      //
//////////////////////////////////////////

/**
 *   IOHandler
 *   Handles IO functions for Google CodeJam .in and .out files
 */
class IOHandler {
	var $data;
	var $index;
	var $output;
	var $outputfilename;

	function __construct($inputfile) {

		$filehandle = fopen ($inputfile, 'r');
		$this -> data = fread($filehandle, filesize($inputfile));
		fclose($filehandle);

		$this -> outputfilename = explode(".", $inputfile);
		$this -> outputfilename = $this -> outputfilename[0] . ".out";

		$this -> data = explode("\n", $this -> data);
		$this -> index = -1;
	}

	function getData() {
		$this -> index++;
		return($this -> data[$this -> index]);
	}

	function saveOutput() {
		file_put_contents($this -> outputfilename, $this -> output);
	}
}

/**
 *   is_palindrome($string)
 *   Checks is a string is a palindrome
 *   @param  string  $string    The input string
 *   @return boolean            Returns true if the input string is
 *                              a palindrome, false if not.
 */
function is_palindrome($string) {

	$chars = str_split($string);
	$count = round((strlen($string) / 2), 0, PHP_ROUND_HALF_DOWN);
	
	for($i = 0; $i < $count; $i++) {
		if($chars[$i] !== $chars[(count($chars) - $i) - 1]) {
			return false;
		}
	}
	return true;
}

///////////////////////
//                   //
//   Start Program   //
//                   //
///////////////////////

$io = new IOHandler("C-small-attempt0.in");

$cases = $io -> getData();

$cache = array();

for($i = 0; $i < $cases; $i++) {

	$values = explode(" ", $io -> getData());

	$fas = 0;

	for($j = $values[0]; $j <= $values[1]; $j++) {

		// check the cache so we don't process
		// a number multiple times
		if (isset($cache[$j])) {
			if($cache[$j] == true) {
				$fas++;
				continue;
			} else {
				continue;
			}
		}

		// Is it a palindrome?
		if(!is_palindrome(strval($j))) {
			$cache[$j] = false;
			continue;
		}

		// Is is a square?
		$sqrt = sqrt($j);
		if(intval($sqrt) != $sqrt) {
			$cache[$j] = false;
			continue;
		}

		// Is its root a palindrome?
		if(!is_palindrome(strval($sqrt))) {
			$cache[$j] = false;
			continue;
		}

		// Its a fair and square number, increment the count
		$cache[$j] = true;
		$fas++;
	}

	$io -> output .= "Case #" . ($i + 1) . ": " . $fas;

	if($i != ($cases -1)) {
		$io -> output .= "\n";
	}
}

$io -> saveOutput();

print("completed successfully");
