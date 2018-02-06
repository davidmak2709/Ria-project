<?php  
	use Phalcon\Mvc\Controller;

	class LoginController extends Controller{
	

		public function indexAction(){

		}

		public function loginAction($email = null, $pwd = null){

			if ($email == null && $pwd == null) {
				$email = $this->request->getPost("email");
				$pwd = $this->request->getPost("password");
				
			}



			$success = Korisnik::findFirstByEmail($email);

			if($success && $this->security->checkHash($pwd,$success->getPassword())){


				$this->session->set("id",$success->getIdKorisnik());
                $this->setRole($success->getIdKorisnik());
               	$this->session->set("first_name", $success->getFirstName());
				
				$this->response->redirect("/index");
			
			}else{
				$this->response->redirect("/login");
			}
		}


		public function logoutAction(){
			$this->session->destroy();
			$this->response->redirect("/index");
		}
		

		public function facebookAction(){
			$this->session->start();
			$fb = new \Facebook\Facebook([
					"app_id" => $this->config->facebook->app_id,
					"app_secret" => $this->config->facebook->app_secret,
					"default_graph_version" => "v2.10"
				]);

			$helper = $fb->getRedirectLoginHelper();
			$redirectUrl =  "http://".$this->request->getHttpHost()."/login/callback";
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
			
			$response = $fb->get("/me?fields=id,email", $accessToken);
			$userData = $response->getGraphNode()->asArray();			
		


			try {
				$fbResult = Facebook::find(
					[
						"id_Facebook = :id_Facebook:",
    					"bind" => [
           					"id_Facebook" => $userData["id"],
			        	],
					]
				);
			
				$idUser =$fbResult->getFirst()->get();

				$user = Korisnik::findFirst($idUser);


				$this->session->set("id", $user->getIdKorisnik());
				$this->session->set("first_name", $user->getFirstName());
				$this->session->set("accessToken", (string) $accessToken);
                $this->setRole($user->getIdKorisnik());

				$this->response->redirect("/index");

			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}

		private function setRole($id){
            $this->session->set("role_type","Users");

            $retVal = Admin::count(
                [
                    "id_korisnik = :name:",
                    "bind" => [
                        "name" => $id,

                    ],
                ]
            );
            if($retVal) $this->session->set("role_type","Admins");

            try {
                $retVal = Vlasnik::count(
                    [
                        "id_korisnik = :name:",
                        "bind" => [
                            "name" => $id,
                        ],
                    ]
                );
            } catch (Exception $e){
                echo $e->getMessage();
            }

            if($retVal) $this->session->set("role_type","Vlasnik");


        }
		
}

?>