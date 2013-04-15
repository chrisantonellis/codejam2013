<?

///////////////////////////////////////////////////////////////////
//                                                               //
//   Google Code Jam 2013                                        //
//   https://code.google.com/codejam                             //
//   Practice Problem                                            //
//   Africa 2010 Qualification Round: Problem B. Reverse Words   //
//                                                               //
///////////////////////////////////////////////////////////////////

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

////////////////////////
//                    //
//   Program Start    //
//                    //
////////////////////////

$io = new IOHandler("B-large-practice.in");

$cases = $io -> getData();

for($i = 0; $i < $cases; $i++) {
	$words = array_reverse(explode(" ", $io -> getData()));
	$io -> output .= ("Case #" . ($i + 1) . ": " . implode(" ", $words) . "\n");
}

$io -> saveOutput();

print("completed successfully");
