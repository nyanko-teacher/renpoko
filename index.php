<!DOCTYPE html> 
<html> 
    <head> 
        <meta charset="UTF-8">
        <title>れんぽこS</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1"> 
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
        <script src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
        <script>
            
            $(document).bind("mobileinit", function() {
                
                $.mobile.page.prototype.options.addBackBtn = true;
                
            });
            
        </script>
        <script src="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>
        <style>
            #search-box{
                margin-top: 30px
            }
        </style>
    </head>
    <body>
        <div data-role="page" id="contact" data-theme="b" data-back-btn-text="戻る">

            <div data-role="header">

                <h1>検索</h1>

            </div>

            <div data-role="content">
                <script type="text/javascript">
                    jQuery(document).ready( function() {
                        $("input:button").click(function(){
                            getData();
                        });
                        
                        $("#ISBN", "#kikaku1", "#kikaku2", "#keyword").live("keypress", function(e){
                            if(e.keyCode == $.mobile.keyCode.ENTER){
                                getData();
                            }
                        });    
                    });
                    
                    function getData() {
                        // 要素の数が10個だったら最初の1個を消す
                        if ($("li").size() == 10) {
                            $("li:last").remove();
                        }
                        
                        // ISBNを取得
                        var isbn;
                        var kikaku1;
                        var kikaku2;
                        var keyword;
                        var category;
                        
                        isbn = $("#ISBN").val();
                        kikaku1 = $("#kikaku1").val();
                        kikaku2 = $("#kikaku2").val();
                        keyword = $("#keyword").val();
                        category = $("#category").val();
                        
                        var data = {ISBN:isbn, kikaku1:kikaku1, kikaku2:kikaku2, keyword:keyword, category:category};
                        
                        $.ajax({
                            type: "POST",
                            url: "controller.php",
                            data: data,
                            success:function(data){
                                $("ul").prepend(data);
                                $("ul").listview('refresh');
                                $("#ISBN").val("");
                                $("#kikaku1").val("");
                                $("#kikaku2").val("");
                                $("#keyword").val("");
                            }
                        });
                    }
                </script>
                <div data-role="fieldcontain"> 
                    <label for="name">ISBN</label>
                    <input type="tel" id="ISBN" data-role="none"><br/>
                    <label for="name">規格</label>
                    <input type="search" id="kikaku1" style="width:20%" data-inline="true" data-role="none">-<input type="tel" id="kikaku2" style="width:20%" data-inline="true" data-role="none"><br/>
                    <label for="name">キーワード</label>
                    <input type="search" id="keyword" data-role="none"><br/>
                    <label for="name">ｶﾃｺﾞﾘ</label>
                    <select id="category" data-role="none">
                        <option selected="selected" value="search-alias=aps">全て</option>
                        <option value="search-alias=stripbooks">和書</option>
                        <option value="search-alias=dvd">DVD</option>
                        <option value="search-alias=popular">ﾐｭｰｼﾞｯｸ</option>
                        <option value="search-alias=classical">ｸﾗｼｯｸ音楽</option>
                        <option value="search-alias=videogames">TVｹﾞｰﾑ</option>
                        <option value="search-alias=english-books">洋書</option>
                    </select>
                    <input type="button" value="検索" data-theme="b" data-icon="arrow-r" data-inline="true">
                </div>
                <ul data-role="listview" id="search-box"></ul>
            </div>

            <div data-role="footer">

                <h4>&copy; left 2012 せどグ</h4>

            </div>

        </div>

    </body>

</html>
