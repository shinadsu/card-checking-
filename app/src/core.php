<?php
DEFINE('CONFIG_FILE', ''); // константа кофинг файла, здесь нужно указать свой путь до моей папки с app/config/config.json
DEFINE('NL', PHP_EOL);

class ApiController
{

    public $configfile;
    public $decodedcfg;
    public $username;
    public $password;

    public $token;

    public function __construct()
    {
        $this->configfile = file_get_contents(CONFIG_FILE);
        $this->decodedcfg = json_decode($this->configfile, true);
        $this->username = $this->decodedcfg['username'];
        $this->password = $this->decodedcfg['password'];
        $this->token = $this->GetToken($this->username, $this->password);
    }
    
    // проверка на налчичие конфиг файла 
    public function CheckConfigFile()
    {
        if (!file_exists(CONFIG_FILE)) {
            die('Конфигурационный файл отсутсвует' . NL);
        } else {
            echo 'Кофигурационный файлл присутсвует';
        }
    }
    
     // получение токена
    public function GetToken($username, $password)
    {
        $UsernameEncoded = urlencode($username);
        $PasswordEncoded = urlencode($password);
        $url = "https://testapi.zabiray.ru/token";
        $arr = [
            "username" => $UsernameEncoded,
            "password" => $PasswordEncoded,

        ];
        $data = http_build_query($arr);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $data
        );
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);
        $token = $output['access_token'];
        return $token;
    }
    
    // получение кредитных карт
    public function Cards($id)
    {

        $data = ['id' => $id];
        $data = json_encode($data, 448);
        $url = "https://testapi.zabiray.ru/cards";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $authorization = "Authorization: Bearer " . $this->token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);
        return $output;
    }
}
