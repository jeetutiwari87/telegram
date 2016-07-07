<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Telegram\Bot\Api;

class DashboardController extends Controller {

	
	protected $nbrPages;

	/**
	 * Create a new BlogController instance.
	 *
	 * @param  App\Repositories\BlogRepository $blog_gestion
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @return void
	*/
	public function __construct()
	{
		$this->nbrPages = 2;

		$this->middleware('user');
	}	


	/**
	 * Display a listing of the resource.
	 *
	 * @return Redirection
	 */
	public function index()
	{
	    $telegram = new Api('224395586:AAGQE4hkQbS1hG2_XkflPldqMBP5jyqEOho');
		//$response = $telegram->setWebhook(['url' => 'http://local.citymes/224395586:AAGQE4hkQbS1hG2_XkflPldqMBP5jyqEOho/get_updates']);
        //$response = $telegram->getMe();
		//echo $botId = $response->getId();
		/*$botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();
*/
      /*$response = $telegram->sendMessage([
		  'chat_id' => '203633121', 
		  'text' => 'this is test'
	  ]);*/
	  
	  $updates = $telegram->getUpdates();
	  echo '<pre>';
	  print_r($updates);
	exit;
	    $keyboard = [
			['7', '8', '9'],
			['4', '5', '6'],
			['1', '2', '3'],
				 ['0']
		];
		
		$reply_markup = $telegram->replyKeyboardMarkup([
		  'keyboard' => $keyboard, 
		  'resize_keyboard' => true, 
		  'one_time_keyboard' => false
		]);
		
		$response = $telegram->sendMessage([
		  'chat_id' => '203633121', 
		  'text' => 'Hi ', 
		  'reply_markup' => $reply_markup
		]);
		
		echo $messageId = $response->getMessageId();


	  exit;
		file_put_contents(public_path().'/updates.txt',json_encode($updates));
echo '<pre>';
        //print_r($response);
		print_r($updates);
		exit;

	
		
		return view('front.dashboard.index');
	}
	public function get_updates(){
	  $telegram = new Api('224395586:AAGQE4hkQbS1hG2_XkflPldqMBP5jyqEOho');
	  $updates = $telegram->getUpdates();
		file_put_contents(public_path().'/updates.txt',json_encode($updates));
echo '<pre>';
		print_r($updates);
		exit;
	}

	

}
