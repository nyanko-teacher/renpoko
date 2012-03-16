<?php
/**
 * れんぽこからデータを取得する 
 */

class renpoko {
    private $ISBN;
    private $kikaku1;
    private $kikaku2;
    private $keyword;
    private $category;
    
    public function setISBN($ISBN) {
        $this->ISBN = $ISBN;
    }
    
    public function setKikakuNumber($kikaku1, $kikaku2, $category) {
        $this->kikaku1 = $kikaku1;
        $this->kikaku2 = $kikaku2;
        $this->category = $category;
    }
    
    public function setKeyword($keyword, $category) {
        $this->keyword = $keyword;
        $this->category = $category;
    }
    
    public function getISBN() {
        $url = 'http://bookle.sakura.ne.jp/renpoko.php';
        $data = array(
            'text1' => $this->ISBN,
        );
        $options = array('http' => array(
                'method' => 'POST',
                'content' => http_build_query($data),
                ));
        $contents = file_get_contents($url, false, stream_context_create($options));
        $contents = mb_convert_encoding($contents, 'UTF-8', 'SJIS');
        $result = '<li><object>' . $contents . '</object></li>';
        return $result;
    }
    
    public function getKikakuNumber() {
        $url = 'http://bookle.sakura.ne.jp/renpoko.php';
        $data = array(
            'text3' => $this->kikaku1,
            'text4' => $this->kikaku2,
            'url'   => $this->category
        );
        $options = array('http' => array(
                'method' => 'POST',
                'content' => http_build_query($data),
                ));
        $contents = file_get_contents($url, false, stream_context_create($options));
        $contents = mb_convert_encoding($contents, 'UTF-8', 'SJIS');
        $result = '<li><object>' . $contents . '</object></li>';
        return $result;
    }
    
    public function getKeyword() {
        $url = 'http://bookle.sakura.ne.jp/renpoko.php';
        $data = array(
            'text2' => mb_convert_encoding($this->keyword, 'SJIS', 'UTF-8'),
            'url'   => $this->category
        );
        $options = array('http' => array(
                'method' => 'POST',
                'content' => http_build_query($data),
                ));
        $contents = file_get_contents($url, false, stream_context_create($options));
        $contents = mb_convert_encoding($contents, 'UTF-8', 'SJIS');
        $result = '<li><object>' . $contents . '</object></li>';
        return $result;
    }
}
?>
