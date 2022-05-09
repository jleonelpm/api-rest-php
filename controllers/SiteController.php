<?php

namespace micro\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Json;
use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;


class SiteController extends Controller
{

    //public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'except' => [
                'login',
                'data',
                'index',
            ],
        ];

        return $behaviors;
    }
    
    public function actionIndex()
    {
        return 'Hello World!';
    }

    public function actionLogin(){
        
/*         $raw = Yii::$app->request->getRawBody();   
        $data = Json::decode($raw, $asArray = true);

        return $data; */
   

        if ( Yii::$app->request->getRawBody() && !count($_POST)) {

            $raw = Yii::$app->request->getRawBody();   
            $data = Json::decode($raw, $asArray = true);

            $hash = hash('sha256', '123');

            if ($data["user"] == "admin" && $data["password"]==$hash) {

                $jwt = Yii::$app->jwt;
                $signer = $jwt->getSigner('HS256');  
                $key = $jwt->getKey();
                $time = time();

                $token = Yii::$app->jwt->getBuilder()
                            ->issuedBy('http://api-rest') // Configures the issuer (iss claim)
                            ->permittedFor('http://api-rest') // Configures the audience (aud claim)
                            ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                            ->issuedAt($time) // Configures the time that the token was issue (iat claim)
                            //->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
                            ->expiresAt($time + 3600) // Configures the expiration time of the token (exp claim)
                            ->withClaim('uid', 1) // Configures a new claim, called "uid"
                            ->getToken($signer, $key); // Retrieves the generated token    
                
                $arr = array('message' => 'Autenticación Exitosa', 'token' => (string) $token);

            }else{
                $arr = array('error' => 'Usuario Incorrecto', 'data'=>$data);                
            }
        }else{
            $arr = "No pudo procesar el POST"; 
        }

        #return $data;
 
        return Json::encode($arr);   

    }

    public function actionInfo(){
        return "info";
    }

    public function actionData()
    {
        return $this->asJson([
            'success' => true,
        ]);
    }


}
