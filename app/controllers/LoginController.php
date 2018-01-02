<?php  
	use Phalcon\Mvc\Controller;
	require_once APP_PATH . "/Facebook/autoload.php";
	class LoginController extends Controller{
	

		public function indexAction(){
			$this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',false);
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			$this->assets->addCss("css/style.css");

			
		}

		public function loginAction(){
			$value = $this->request->getPost();
		
			$success = Korisnik::findFirst([
				"email = :email: AND password = :password:",
				"bind" =>[
					"email" => $value["email"],
					"password" => $value["password"],
				],
			]);
			if($success){
				$this->session->set("id",$success->getValue("id_Korisnik"));
				$this->session->set("ime",$success->getValue("ime"));

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
					"app_id" => " ",
					"app_secret" => " ",
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
					"app_id" => " ",
					"app_secret" => " ",
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
			
			$response = $fb->get("/me?fields=id,name,gender, email", $accessToken);
			$userData = $response->getGraphNode()->asArray();
			$this->session->set("userData",$userData);
			$this->session->set("accessToken",(string) $accessToken);
			
			$this->response->redirect("index");
		}
}

?>