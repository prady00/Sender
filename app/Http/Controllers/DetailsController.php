<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use \App\ZipFile as ZipFile;
use \App\Receiver as Receiver;
use \App\History as History;

/**
 * Class DetailsController
 * @package App\Http\Controllers
 */
class DetailsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $files = History::orderBy('created_at','desc')->take(10)->get();
        return view('welcome', array('files' => $files));
    }


    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function save(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'file' => 'required',
        ]);

        // for file
        $fileName = time().".".$request->file('file')->getClientOriginalExtension();

    	$request->file('file')->move(
        	base_path() . DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR, $fileName
    	);

    	$fileInFS = ZipFile::getFiles(base_path() . "/public/uploads/$fileName");

    	$files = ZipFile::encyptFileNames($fileInFS);

    	$data = [
    				'username' => $request->username,
    				'password' => $request->password,	
    				'file' 	=> $files
    	];

    	// send this data to receiver

    	$data = Receiver::send($data);

        //print_r($fileInFS); die();

        

        $data = json_decode($data);

        //print_r($data); die();

    	if($data->status == 'success'){
    		$request->session()->flash('message.level', 'success');
        	$request->session()->flash('message.content', 'Bingo! Send the file successfully');
            // save this transaction 

            $history = new History();
            $history->username = $request->username;
            $history->file = "/public/uploads/$fileName";
            $history->save();

    	}else{
    		$request->session()->flash('message.level', 'danger');
        	$request->session()->flash('message.content', $data->message);
    	}      

        return redirect('/');
    }


    /**
     * return group detail from URL.
     *
     * @return Response
     */
    public function groupDetails(Request $request)
    {
        $data = $request->get('url');

       // print_r($data); die();

        $data = FB::groupDetails($data);

        return $data;
    }

}