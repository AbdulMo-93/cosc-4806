<?php

class Reports extends Controller {
    public function attempts() {
		 $user = $this->model('User');
		 $this->view('reports/students');    
    }
}