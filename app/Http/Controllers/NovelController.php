<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novel;
use App\Episode;
use App\Background;

class NovelController extends Controller
{
    // NOVEL INFO
    public function novelInfo($id) 
    {
        // echo $id;

        $novelTable = new Novel();
        $novelData = $novelTable->dataJoinEpisode($id);
        $backgroundData = $novelTable->dataJoinBackground($id);
        
        // var_dump($novelData);
        // var_dump($backgroundData);

        $i = 0;
        $bData = array(array());

        foreach($backgroundData as $back) {
            $bData[$i]['title'] = $back->title;
            $bData[$i]['background_id'] = $back->background_id;
        }

        $data = array();
        // echo(gettype($data));

        if(empty($bData[0])) {
            for($i = 0; $i < count($novelData); $i++) {
                $datas = [
                    'noBack' => 'noBack',
                    'novelId' => $novelData[$i]->id,
                    'episode_count' => $i+1,
                    'title' => $novelData[$i]->title,
                    'intro' => $novelData[$i]->intro,
                    'summary_intro' => $novelData[$i]->summary_intro,
                    'cover_img_src' => $novelData[$i]->cover_img_src,
                    'episode_cover_src' => $novelData[$i]->episode_cover_src,
                    'publish_case' => $novelData[$i]->publish_case,
                    'period' => $novelData[$i]->period,
                    'genre' => $novelData[$i]->genre,
                    'belong_to_novel' => $novelData[$i]->belong_to_novel,
                    'episode_title' => $novelData[$i]->episode_title,
                    'created_at' => $novelData[$i]->created_at
                ];
                
                array_push($data, $datas);
            }
        } else if(!empty($bData[0])) {
            for($i = 0; $i < count($novelData); $i++) {
                $datas = [
                    'novelId' => $novelData[$i]->id,
                    'episode_count' => $i+1,
                    'title' => $novelData[$i]->title,
                    'intro' => $novelData[$i]->intro,
                    'summary_intro' => $novelData[$i]->summary_intro,
                    'cover_img_src' => $novelData[$i]->cover_img_src,
                    'episode_cover_src' => $novelData[$i]->episode_cover_src,
                    'publish_case' => $novelData[$i]->publish_case,
                    'period' => $novelData[$i]->period,
                    'genre' => $novelData[$i]->genre,
                    'belong_to_novel' => $novelData[$i]->belong_to_novel,
                    'episode_title' => $novelData[$i]->episode_title,
                    'created_at' => $novelData[$i]->created_at
                ];
                
                array_push($data, $datas);
            }
        }

        // var_dump($data);
         
        if (empty($data[0])) {
            // echo ("ECHO!");
            $novelData = $novelTable->basicData($id);

            $data = array();

            for($i = 0; $i < count($novelData); $i++) {
                $datas = [
                    'noEpi' => 'noEpi',
                    'novelId' => $novelData[$i]->id,
                    'title' => $novelData[$i]->title,
                    'intro' => $novelData[$i]->intro,
                    'summary_intro' => $novelData[$i]->summary_intro,
                    'cover_img_src' => $novelData[$i]->cover_img_src,
                    'publish_case' => $novelData[$i]->publish_case,
                    'period' => $novelData[$i]->period,
                    'genre' => $novelData[$i]->genre
                ];
                    
                array_push($data, $datas);
            }
        }

        // var_dump($data);
        // echo $data[0]['title'];
        
        // echo(gettype($data));

        return view('novel.info.novel_info')->with('data', $data);
    }

    // NOVEL EPISODE
    public static function episodeShow($id) 
    {
        $string = explode('&', $id);
        // var_dump($string);

        $novelId = $string[0];
        $episodeCount = $string[1];

        // echo($novelId);
        // echo($episodeCount);

        $episodeTable = new Episode();
        $episodeData = $episodeTable->dataJoinNovel($novelId);
        $backgroundData = $episodeTable->dataJoinBackground($novelId);

        // var_dump($episodeData);
        // var_dump($backgroundData);

        $i = 0;
        $bData = array(array());

        foreach($backgroundData as $back) {
            $bData[$i]['belong_to_novel'] = $back->belong_to_novel;
            $bData[$i]['background_id'] = $back->background_id;
        }

        $data = array(array());
        $i = 0;

        if (empty($bData[0])) {
            // var_dump($bData);

            foreach($episodeData as $datas) {
                $data[$i]['noBack'] = 'noBack';
                $data[$i]['episode_count'] = $episodeCount;

                $data[$i]['belong_to_novel'] = $datas->belong_to_novel;
                $data[$i]['is_charge'] = $datas->is_charge;
                $data[$i]['is_notice'] = $datas->is_notice;
                $data[$i]['cover_img_src'] = $datas->cover_img_src;
                $data[$i]['episode_title'] = $datas->episode_title;
                $data[$i]['episode'] = $datas->episode;
                $data[$i]['writers_postscript'] = $datas->writers_postscript;
                $data[$i]['char_count'] = $datas->char_count;
                $data[$i]['created_at'] = $datas->created_at;

                $data[$i]['novel_title'] = $datas->title;

                if ($i == $episodeCount - 1) {
                    $i = $episodeCount - 1;

                    break;
                }

                $i++;
            }
        } else if(!empty($bData[0])) {
            foreach($episodeData as $datas) {
                $data[$i]['episode_count'] = $episodeCount;

                $data[$i]['belong_to_novel'] = $datas->belong_to_novel;
                $data[$i]['is_charge'] = $datas->is_charge;
                $data[$i]['is_notice'] = $datas->is_notice;
                $data[$i]['cover_img_src'] = $datas->cover_img_src;
                $data[$i]['episode_title'] = $datas->episode_title;
                $data[$i]['episode'] = $datas->episode;
                $data[$i]['writers_postscript'] = $datas->writers_postscript;
                $data[$i]['char_count'] = $datas->char_count;
                $data[$i]['created_at'] = $datas->created_at;

                $data[$i]['novel_title'] = $datas->title;

                if ($i == $episodeCount - 1) {
                    $i = $episodeCount - 1;

                    break;
                }

                $i++;
            }
        }


        // var_dump($data);

        // echo($episodeCount);
        // var_dump($data[$i]);

        return view('novel.read.novel_read_view')->with('data', $data[$i]);
    }

    // NOVEL BACKGROUND : CHARACTER
    public static function backgroundCharacter($id) {
        // echo $id;

        $novelId = $id;

        $backgroundTable = new Background();
        $characterData = $backgroundTable->selectCharacter($novelId);
        
        // var_dump($characterData);

        $data = array(array());

        $i = 0;

        foreach ($characterData as $datas) {
            $data[$i]['id'] = $datas->id;
            $data[$i]['name'] = $datas->name;
            $data[$i]['info'] = $datas->info;
            $data[$i]['age'] = $datas->age;
            $data[$i]['gender'] = $datas->gender;
            $data[$i]['refer_info'] = $datas->name;
            $data[$i]['img_src'] = $datas->img_src;

            $i++;
        }

        if (empty($data[0])) {
            $data[0] = 0;
        }

        // var_dump($data);
        
        return view('novel.read.background.character')->with('data', $data);
    }

    // NOVEL BACKGROUND : ITEM
    public static function backgroundItem($id) {
        // echo $id;

        $novelId = $id;

        $backgroundTable = new Background();
        $itemData = $backgroundTable->selectItem($novelId);
        
        // var_dump($itemData);

        $data = array(array());

        $i = 0;

        foreach ($itemData as $datas) {
            $data[$i]['id'] = $datas->id;
            $data[$i]['name'] = $datas->name;
            $data[$i]['info'] = $datas->info;
            $data[$i]['category'] = $datas->category;
            $data[$i]['refer_info'] = $datas->name;
            $data[$i]['img_src'] = $datas->img_src;

            $i++;
        }

        if (empty($data[0])) {
            $data[0] = 0;
        }

        // var_dump($data);
        
        return view('novel.read.background.item')->with('data', $data);
    }

    // NOVEL BACKGROUND : RELATION
    public static function backgroundRelation($id) {
        // echo $id;

        $novelId = $id;

        $imgRoot = '/img/background/relationImg/';
        $backgroundTable = new Background();
        // $chaInfos = $backgroundTable->selectCharacter($novelId);
        $relInfos = $backgroundTable->selectRelation($novelId);

        // var_dump($relInfos);

        $data = array(array());
        $i = 0;

        foreach ($relInfos as $datas) {
            $data[$i]['id'] = $datas->id;
            $data[$i]['relHref'] = $datas->cover_src;

            // $data[$i]['img_src'] = $imgRoot.$data[$i]['relHref'];

            $i++;
        }

        if (empty($data[0])) {
            $data[0] = 0;
        }

        // var_dump($data);
        
        return view('novel.read.background.relation')->with('data', $data);
    }

    // NOVEL BACKGROUND : HISTORY
    public static function backgroundHistory($id) {
        // echo $id;

        $novelId = $id;

        $backgroundTable = new Background();
        $historyData = $backgroundTable->selectHistory($novelId);

        // var_dump($historyData);
        
        $data = array(array());

        $i = 0;

        foreach ($historyData as $datas) {
            $data[$i]['id'] = $datas->id;
            $data[$i]['event_name'] = $datas->event_names;
            $data[$i]['event_content'] = $datas->event_contents;
            $data[$i]['start_day'] = $datas->start_days;
            $data[$i]['end_day'] = $datas->end_days;
            $data[$i]['other'] = $datas->others;
            $data[$i]['refer_info'] = $datas->refer_info;

            $i++;
        }

        if (empty($data[0])) {
            $data[0] = 0;
        }

        // var_dump($data);
        
        return view('novel.read.background.history')->with('data', $data);
    }

    // NOVEL BACKGROUND : MAP
    public static function backgroundMap($id) {
        // echo $id;

        $novelId = $id;

        $backgroundTable = new Background();
        $mapData = $backgroundTable->selectMap($novelId);
        
        $data = array(array());

        $i = 0;

        foreach ($mapData as $datas) {
            $data[$i]['id'] = $datas->id;
            $data[$i]['cover_src'] = $datas->cover_src;
            $data[$i]['title'] = $datas->title;
            $data[$i]['created_at'] = $datas->created_at;
            $data[$i]['updated_at'] = $datas->updated_at;

            $i++;
        }

        if (empty($data[0])) {
            $data[0] = 0;
        }

        // var_dump($data);
        
        return view('novel.read.background.map')->with('data', $data);
    }

    // VIEWER QUICK MENU
    public static function quickMenu($data) {
        $novelId = $data['belong_to_novel'];

        $episodeTable = new Episode();
        $episodeData = $episodeTable->episodeTitle($novelId);
        $backgroundData = $episodeTable->dataJoinBackground($novelId);

        // var_dump($episodeData);
        // var_dump($backgroundData);

        $i = 0;
        $bData = array(array());

        foreach($backgroundData as $back) {
            $bData[$i]['belong_to_novel'] = $back->belong_to_novel;
            $bData[$i]['background_id'] = $back->background_id;
        }

        $i = 0;
        $dataE = array(array());

        if (empty($bData[0])) {
            // var_dump($backgroundData);

            foreach ($episodeData as $datas) {
                $dataE[$i]['noBack'] = 'noBack';
                $dataE[$i]['novel_id'] = $novelId;
                $dataE[$i]['episode_title'] = $datas->episode_title;

                $i++;
            }
        } else if (!empty($bData[0])) {
            foreach ($episodeData as $datas) {
                $dataE[$i]['novel_id'] = $novelId;
                $dataE[$i]['episode_title'] = $datas->episode_title;

                $i++;
            }
        }
        

        // $episodeCount = count($episodeData);
        // echo $episodeCount;

        // var_dump($dataE);

        return view('novel.read.quick_menu')->with('dataE', $dataE);
    }

    public static function viewerModal() {
        return view('novel.read.viewer_modal');
    }

    public static function backgroundModal($id) {
        // echo "PASS";
        return view('novel.read.background_modal')->with('id', $id);
    }
}
