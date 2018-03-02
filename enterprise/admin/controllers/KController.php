<?php

class KController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Log = new Log();

        $this->title = Wave::app()->config['projectTitle'].'后台';
        $this->shortitle = '后台';
    }

}

?>