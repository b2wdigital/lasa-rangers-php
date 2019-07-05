<?php

namespace Bacon\Controller;

        # imports the Google Cloud client library
        use Google\Cloud\Vision\V1\ImageAnnotatorClient;

        # Imports the Google Cloud client library
        use Google\Cloud\Translate\TranslateClient;

class ApiController
{
    public function imageAction()
    {
        # Gerar json no Google Cloud Plataform
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/b2w/public/b2w.json');

        # Your Google Cloud Platform project ID
        $projectId = '4c03d41192f93467423a5e75f5d52b73acb4cedf';

        # Instantiates a client
        $translate = new TranslateClient([
            'projectId' => $projectId
        ]);

        # The target language
        $target = 'pt-br';

        # instantiates a client
        $imageAnnotator = new ImageAnnotatorClient();


        if(empty($_POST['image']))
        {
            // debug
            $image = file_get_contents('03.jpg');
        }
        else
        {
            $image = base64_decode($_POST['image']);
        }

        # performs label detection on the image file
        $response_label = $imageAnnotator->labelDetection($image);
        $response_logo = $imageAnnotator->logoDetection($image);

        $labels = $response_label->getLabelAnnotations();
        $logos = empty(!$response_logo->getLogoAnnotations()) ? $response_logo->getLogoAnnotations() : null;

        $data['status'][0] = true;

        if($logos) {
            //$data['logo'][] = $logos[0]->getDescription();
        }

        if ($labels) {
            foreach ($labels as $label) {
                $translation = $translate->translate($label->getDescription(), ['target' => $target]);
                $data['tags'][] = $translation['text'];
                $data['labels'][] = $label->getScore();
            }
        } else {
            $data['status'][0] = false;
        }
        print_r(json_encode($data, JSON_UNESCAPED_UNICODE));
    }
}