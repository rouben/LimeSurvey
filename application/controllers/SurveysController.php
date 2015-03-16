<?php

    /**
     * This class will handle survey creation and manipulation.
     */
    class SurveysController extends LSYii_Controller
    {
        public $layout = 'bare';
        public $defaultAction = 'publicList';

        public function actionPublicList($lang = null)
        {
            if (!empty($lang))// Control is a real language , in restrictToLanguages ?
            {
                App()->setLanguage($lang);
            }

            // Custom index page for Neill Watson
            print file_get_contents("custom-homepage.html");
            
        }
    }
?>
