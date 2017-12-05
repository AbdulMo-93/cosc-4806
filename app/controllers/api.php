<?php
class API extends Controller{

    public function export(){

        $url = $this->parseUrl();

        $users[] = array('username'=>$url[2], 'email'=>$url[3], 'lastLogged'=>$url[4], 'numberOfNotes'=>$url[5]);

        $file = 'useReport.json';
        $fp = fopen($file, 'w') or die("Can't find file");
        fwrite($fp, json_encode($users));
        fclose($fp);
        
        $user = $this->model('User');
        $this->view('reports/usersInfo', $user);
    }
    
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}