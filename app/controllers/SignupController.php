<?php 
	use Phalcon\Mvc\Controller;
	
	
	class SignupController extends Controller{

		public function indexAction(){
			$this->assets->addCss("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",false);
			
		}

		public function registerAction(){
			if($this->request->isPost()){
				$user = User::getUserType($this->request->getPost("Tip"));
				
				$user->addUser($this->request->getPost(),
								 $this->security->hash($this->request->getPost("password"))
						);
			
				if ($this->request->hasFiles() == true) {
					$barId = Klub::lastId();
					
					mkdir("img/" . $barId  ."/", 0755);
					$cnt = 0;
            		foreach ($this->request->getUploadedFiles() as $file) {
            		     $file->moveTo("img/". $barId ."/". $barId . $cnt . ".jpeg");
            		     $cnt = $cnt+1;
            		}
       			}
       			$this->response->redirect("index");

			}else{
				$this->response->redirect("signup/index");
			}
			

		}

		public function facebookAction(){
			$this->session->start();
			$fb = new \Facebook\Facebook([
					"app_id" => $this->config->facebook->app_id,
					"app_secret" => $this->config->facebook->app_secret,
					"default_graph_version" => "v2.10"
				]);

			$helper = $fb->getRedirectLoginHelper();

			$redirectUrl = "http://dir.dev/signup/callback";
			$permissions = ['email'];
			$loginURL = $helper->getLoginUrl($redirectUrl,$permissions); 


			$this->response->redirect($loginURL);
		}

		public function callbackAction(){
			$this->session->start();
			$fb = new \Facebook\Facebook([
					"app_id" => $this->config->facebook->app_id,
					"app_secret" => $this->config->facebook->app_secret,
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
			
			$response = $fb->get("/me?fields=id,first_name,last_name,gender,email,hometown,address", $accessToken);
			$userData = $response->getGraphNode()->asArray();
			
			$this->session->set("first_name",$userData["first_name"]);
			$this->session->set("last_name",$userData["last_name"]);
			$this->session->set("email",$userData["email"]);
			$this->session->set("id",$userData["id"]);
			$this->session->set("accessToken",(string) $accessToken);
			
				
			$this->response->redirect("signup");
		}	
	}
?>