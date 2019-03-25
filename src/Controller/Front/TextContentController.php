<?php

namespace App\Controller\Front;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\TextContentManager;

class TextContentController extends Controller
{
    const PREPOSITIONS = array(
        '-' => '-&nbsp;',
        ' w '=> ' w&nbsp;',
        ' na '=> ' na&nbsp;',
        ' o '=> ' o&nbsp;',
        ' z '=> ' z&nbsp;',
        ' za '=> ' za&nbsp;',
        ' ku '=> ' ku&nbsp;',
        ' do '=> ' do&nbsp;',
        ' śród '=> ' śród&nbsp;',
        ' bez ' => ' bez&nbsp;',
        ' pod '=> ' pod&nbsp;',
        ' przed '=> ' przed&nbsp;',
        ' nad '=> ' nad&nbsp;',
        ' obok '=> ' obok&nbsp;',
        ' dla '=> ' dla&nbsp;',
        ' między '=> ' między&nbsp;',
        ' przez '=> ' przez&nbsp;',
        ' po '=> ' po&nbsp;',
        ' to '=> ' to&nbsp;',
        ' u '=> ' u&nbsp;',
        ' przy '=> ' przy&nbsp;',
        ' od '=> ' od&nbsp;',
        ' ku '=> ' ku&nbsp;',
        ' mimo '=> ' mimo&nbsp;',
        ' i '=> ' i&nbsp;',
        ' by '=> ' by&nbsp;'
    );

    const PREPOSITIONS_EN = array(
        ' of ' => ' of&nbsp;',
        ' with ' => ' with&nbsp;',
        ' at ' => ' at&nbsp;',
        ' from ' => ' from&nbsp;',
        ' into ' => ' into&nbsp;',
        ' during ' => ' during&nbsp;',
        ' including ' => ' including&nbsp;',
        ' until ' => ' until&nbsp;',
        ' against ' => ' against&nbsp;',
        ' among ' => ' among&nbsp;',
        ' throughout ' => ' throughout&nbsp;',
        ' despite ' => ' despite&nbsp;',
        ' towards ' => ' towards&nbsp;',
        ' upon ' => ' upon&nbsp;',
        ' concerning ' => ' concerning&nbsp;',
        ' to ' => ' to&nbsp;',
        ' in ' => ' in&nbsp;',
        ' for ' => ' for&nbsp;',
        ' on ' => ' on&nbsp;',
        ' by ' => ' by&nbsp;',
        ' about ' => ' about&nbsp;',
        ' like ' => ' like&nbsp;',
        ' through ' => ' through&nbsp;',
        ' over ' => ' over&nbsp;',
        ' before ' => ' before&nbsp;',
        ' between ' => ' between&nbsp;',
        ' after ' => ' after&nbsp;',
        ' since ' => ' since&nbsp;',
        ' without ' => ' without&nbsp;',
        ' under ' => ' under&nbsp;',
        ' within ' => ' within&nbsp;',
        ' along ' => ' along&nbsp;',
        ' following ' => ' following&nbsp;',
        ' across ' => ' across&nbsp;',
        ' behind ' => ' behind&nbsp;',
        ' beyond ' => ' beyond&nbsp;',
        ' plus ' => ' plus&nbsp;',
        ' except ' => ' except&nbsp;',
        ' but ' => ' but&nbsp;',
        ' up ' => ' up&nbsp;',
        ' out ' => ' out&nbsp;',
        ' around ' => ' around&nbsp;',
        ' down ' => ' down&nbsp;',
        ' off ' => ' off&nbsp;',
        ' above ' => ' above&nbsp;',
        ' near ' => ' near&nbsp;'
    );

    private $manager;

    public function __construct(TextContentManager $manager)
    {
        $this->manager = $manager;
    }

    public function textContentContent(string $name, string $lang)
    {
        $content = $this->manager->findTextContentByName($name);
        $content_string = '';
        if ($content) {
            $content_string = $content->getContentByLang($lang);
            $prepositions_array = $lang == 'pl' ? static::PREPOSITIONS : static::PREPOSITIONS_EN;
            $content_string = trim(strtr(' ' . $content_string, $prepositions_array));
        }
        return $this->render('front/text_content/content.html.twig', [
            'content' => $content_string
        ]);
    }

    public function textContentTitle(string $name, string $lang)
    {
        $content = $this->manager->findTextContentByName($name);
        $content_string = '';
        if ($content) {
            $content_string = $content->getTitleByLang($lang);
            $prepositions_array = $lang == 'pl' ? static::PREPOSITIONS : static::PREPOSITIONS_EN;
            $content_string = trim(strtr(' ' . $content_string, $prepositions_array));
        }
        return $this->render('front/text_content/title.html.twig', [
            'title' => $content_string
        ]);
    }
}
