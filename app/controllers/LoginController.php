<?php  
	use Phalcon\Mvc\Controller;
	require_once APP_PATH . "/Facebook/autoload.php";
	class LoginController extends Controller{
	

		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			$this->assets->addCss("css/style.css");

			
		}

		public function loginAction($email = null, $pwd = null){
			
			if ($email == null && $pwd == null) {
				$email = $this->request->getPost("email");
				$pwd = $this->request->getPost("password");
				
			}


			$success = Korisnik::findFirstByEmail($email);


			if($success && $this->security->checkHash($pwd,$success->getValue("password"))){

				$this->session->set("id",$success->getValue("id_Korisnik"));

				$retVal = Admin::count(
			    	[
			        	"id_korisnik = :name:",
			        	"bind" => [
			            	"name" => $success->getValue("id_Korisnik"),
			        	    
			        	],
			    	]
				);
				if($retVal) $this->session->set("admin", 1);

				$retVal = Vlasnik::count(
			    	[
			        	"id_korisnik = :name:",
			        	"bind" => [
			            	"name" => $success->getValue("id_Korisnik"),
			        	    
			        	],
			    	]
				);

				if($retVal) $this->session->set("vlasnik", 1);
				
				$this->session->set("first_name", $success->getFirstName());
				
				$this->response->redirect("index");
			
			}else{
				$this->response->redirect("login");
			}
		}


		public function logoutAction(){
			$this->session->destroy();
			$this->response->redirect("index");
		}
		

		public function facebookAction(){
			$this->session->start();
			$fb = new \Facebook\Facebook([
					"app_id" => "636102426778495",
					"app_secret" => "040fcbf122e1caaf368365f50ef82f6d ",
					"default_graph_version" => "v2.10"
				]);

			$helper = $fb->getRedirectLoginHelper();

			$redirectUrl = "http://dir.dev/login/callback";
			$permissions = ['email'];
			$loginURL = $helper->getLoginUrl($redirectUrl,$permissions); 


			$this->response->redirect($loginURL);
		}

		public function callbackAction(){
			$this->session->start();
			$fb = new \Facebook\Facebook([
					"app_id" => "636102426778495",
					"app_secret" => "040fcbf122e1caaf368365f50ef82f6d",
					"default_graph_version" => "v2.10"
				]);

			$helper = $fb->getRedirectLoginHelper();


			try {
				$accessToken = $helper->getAccessToken();
			} catch (\Facebook\Exceptions\FacebookResponseException $e) {
				echo "Response exceptions: " . $e->getMessage();
				exit();
			} catch (\Facebook\Exceptions\FacebookSDKException $e ){
				echo "SDK exceptions: " . $e->getMessage();
				exit();
			}
			
			if (!$accessToken){
				$this->response->redirect("login");
			}
			
			$oAuth2Client = $fb->getOAuth2Client();
			
			if(!$accessToken->isLongLived()){
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			}
			
			$response = $fb->get("/me?fields=id,email", $accessToken);
			$userData = $response->getGraphNode()->asArray();

			$this->loginAction($userData["email"],$userData["id"]);
			
		}	
		
}

?>