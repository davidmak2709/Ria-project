<?php  
	use Phalcon\Mvc\Controller;
	require_once APP_PATH . "/Facebook/autoload.php";
	class LoginController extends Controller{
	

		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			$this->assets->addCss("css/style.css");

			
		}

		public function loginAction($name = null,$pwd = null){
			
			if($name === null)
				$name = $this->request->getPost("email");
					
			var_dump($name);
			$success = Korisnik::findFirst([
				"ime = :email: AND password = :password:",
				"bind" =>[
					"email" => $name,
					"password" => $pwd,
				],
			]);
			if($success){
				$this->session->set("id",$success->getValue("id_Korisnik"));
				$this->session->set("ime",$success->getValue("ime"));
				echo "string";
				// $this->response->redirect("index");
			}else{
				// $this->response->redirect("login");
				echo "string1";
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
			
			$response = $fb->get("/me?fields=id,name,email", $accessToken);
			$userData = $response->getGraphNode()->asArray();

			$this->loginAction($userData["name"],$this->security->hash($userData["id"]));
			
		}	
		
}

?>