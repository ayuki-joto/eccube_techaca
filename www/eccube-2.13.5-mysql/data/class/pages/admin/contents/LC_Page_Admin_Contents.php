<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2014 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

/**
 * コンテンツ管理 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Admin_Contents extends LC_Page_Admin_Ex
{
    /**
     * Page を初期化する.
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        $this->tpl_mainpage = 'contents/index.tpl';
        $this->tpl_subno = 'index';
        $this->tpl_mainno = 'contents';
        $this->arrForm = array(
            'year' => date('Y'),
            'month' => date('n'),
            'day' => date('j'),
        );
        $this->tpl_maintitle = 'コンテンツ管理';
        $this->tpl_subtitle = '新着情報管理';
        //---- 日付プルダウン設定
        $objDate = new SC_Date_Ex(ADMIN_NEWS_STARTYEAR);
        $this->arrYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    public function process()
    {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    public function action()
    {
        $objNews = new SC_Helper_News_Ex();

        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);
        $objFormParam->convParam();

        $news_id = $objFormParam->getValue('news_id');

        //---- 新規登録/編集登録
        switch ($this->getMode()) {
            case 'edit':
                $this->arrErr = $this->lfCheckError($objFormParam);
                if (!SC_Utils_Ex::isBlank($this->arrErr['news_id'])) {
                    trigger_error('', E_USER_ERROR);

                    return;
                }

                if (count($this->arrErr) <= 0) {
                    // POST値の引き継ぎ
                    $arrParam = $objFormParam->getHashArray();
                    // 登録実行
                    $res_news_id = $this->doRegist($news_id, $arrParam, $objNews);
                    if ($res_news_id !== FALSE) {
                        // 完了メッセージ
                        $news_id = $res_news_id;
                        $this->tpl_onload = "alert('登録が完了しました。');";
                    }
                }
                // POSTデータを引き継ぐ
                $this->tpl_news_id = $news_id;
                break;

            case 'pre_edit':
                $news = $objNews->getNews($news_id);
                list($news['year'],$news['month'],$news['day']) = $this->splitNewsDate($news['cast_news_date']);
                list($news['start_news_year'],$news['start_news_month'],$news['start_news_day']) = $this->splitNewsDate($news['cast_start_news_date']);
                list($news['end_news_year'],$news['end_news_month'],$news['end_news_day']) = $this->splitNewsDate($news['cast_end_news_date']);
                $objFormParam->setParam($news);

                // POSTデータを引き継ぐ
                $this->tpl_news_id = $news_id;
                break;

            case 'delete':
            //----　データ削除
                $objNews->deleteNews($news_id);
                //自分にリダイレクト（再読込による誤動作防止）
                SC_Response_Ex::reload();
                break;

            //----　表示順位移動
            case 'up':
                $objNews->rankUp($news_id);

                // リロード
                SC_Response_Ex::reload();
                break;

            case 'down':
                $objNews->rankDown($news_id);

                // リロード
                SC_Response_Ex::reload();
                break;

            case 'moveRankSet':
            //----　指定表示順位移動
                $input_pos = $this->getPostRank($news_id);
                if (SC_Utils_Ex::sfIsInt($input_pos)) {
                    $objNews->moveRank($news_id, $input_pos);
                }
                SC_Response_Ex::reload();
                break;

            default:
                break;
        }

        $this->arrNews = $objNews->getList();
        $this->line_max = count($this->arrNews);

        $this->arrForm = $objFormParam->getFormParamList();
    }

    /**
     * 入力されたパラメーターのエラーチェックを行う。
     * @param  SC_FormParam_Ex $objFormParam
     * @return Array  エラー内容
     */
    public function lfCheckError(&$objFormParam)
    {
        $objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
        $objErr->arrErr = $objFormParam->checkError();
        $objErr->doFunc(array('日付', 'year', 'month', 'day'), array('CHECK_DATE'));
        $objErr->doFunc(array('開始期限','終了期限','start_news_year','start_news_month','start_news_day','end_news_year', 'end_news_month', 'end_news_day'),array('CHECK_SET_TERM'));//期限設定

        return $objErr->arrErr;
    }

    /**
     * パラメーターの初期化を行う
     * @param SC_FormParam_Ex $objFormParam
     */
    public function lfInitParam(&$objFormParam)
    {
        $objFormParam->addParam('news_id', 'news_id');
        $objFormParam->addParam('日付(年)', 'year', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('日付(月)', 'month', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('日付(日)', 'day', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('開始日付(年)', 'start_news_year', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK')); //追加
        $objFormParam->addParam('開始日付(月)', 'start_news_month', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK')); //追加
        $objFormParam->addParam('開始日付(日)', 'start_news_day', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK')); //追加
        $objFormParam->addParam('終了日付(年)', 'end_news_year', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK')); //追加
        $objFormParam->addParam('終了日付(月)', 'end_news_month', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK')); //追加
        $objFormParam->addParam('終了日付(日)', 'end_news_day', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK')); //追加
        $objFormParam->addParam('タイトル', 'news_title', MTEXT_LEN, 'KVa', array('EXIST_CHECK','MAX_LENGTH_CHECK','SPTAB_CHECK'));
        $objFormParam->addParam('URL', 'news_url', URL_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('本文', 'news_comment', LTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('別ウィンドウで開く', 'link_method', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * 登録処理を実行.
     *
     * @param  integer  $news_id
     * @param  array    $sqlval
     * @param  SC_Helper_News_Ex   $objNews
     * @return multiple
     */
    public function doRegist($news_id, $sqlval, SC_Helper_News_Ex $objNews)
    {
        $sqlval['news_id'] = $news_id;
        $sqlval['creator_id'] = $_SESSION['member_id'];
        $sqlval['link_method'] = $this->checkLinkMethod($sqlval['link_method']);
        $sqlval['news_date'] = $this->getRegistDate($sqlval);
        unset($sqlval['year'], $sqlval['month'], $sqlval['day']);
        $sqlval['start_news_date'] = $this->getStartDate($sqlval);
        unset($sqlval['start_news_year'],$sqlval['start_news_month'],$sqlval['start_news_day']);
        $sqlval['end_news_date'] = $this->getEndDate($sqlval);
        unset($sqlval['end_news_year'],$sqlval['end_news_month'],$sqlval['end_news_day']);

        return $objNews->saveNews($sqlval);
    }


    /**
     * お知らせ表示終了期限を返す。
     * @param  Array  $arrPost POSTのグローバル変数
     * @return string 表示終了期限を示す文字列
     */
    public function getEndDate($arrPost) //追加
    {
        $endDate = $arrPost['end_news_year'] .'/'. $arrPost['end_news_month'] .'/'. $arrPost['end_news_day'];

        return $endDate;
    }


    /**
     * お知らせ表示開始期限を返す。
     * @param  Array  $arrPost POSTのグローバル変数
     * @return string 表示開始期限を示す文字列
     */
    public function getStartDate($arrPost) //追加
    {
        $startDate = $arrPost['start_news_year'] .'/'. $arrPost['start_news_month'] .'/'. $arrPost['start_news_day'];

        return $startDate;
    }

    /**
     * データの登録日を返す。
     * @param  Array  $arrPost POSTのグローバル変数
     * @return string 登録日を示す文字列
     */
    public function getRegistDate($arrPost)
    {
        $registDate = $arrPost['year'] .'/'. $arrPost['month'] .'/'. $arrPost['day'];

        return $registDate;
    }

    /**
     * チェックボックスの値が空の時は無効な値として1を格納する
     * @param  int $link_method
     * @return int
     */
    public function checkLinkMethod($link_method)
    {
        if (strlen($link_method) == 0) {
            $link_method = 1;
        }

        return $link_method;
    }

    /**
     * ニュースの日付の値をフロントでの表示形式に合わせるために分割
     * @param String $news_date
     */
    public function splitNewsDate($news_date)
    {
        return explode('-', $news_date);
    }

    /**
     * POSTされたランクの値を取得する
     * @param Integer $news_id
     */
    public function getPostRank($news_id)
    {
        if (strlen($news_id) > 0 && is_numeric($news_id) == true) {
            $key = 'pos-' . $news_id;
            $input_pos = $_POST[$key];

            return $input_pos;
        }
    }
}
