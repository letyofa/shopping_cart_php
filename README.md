測試帳號:test1 or test2
測試密碼:test1 or test2

詳解流程及資料表在PPT

流程:
將商品加入購物車前必須先登入
起始頁---->登入---->將商品加入購物車--->按結帳按鈕進入訂單頁面---->訂單頁面可修改訂單或刪除訂單--->確定結帳--->顯示訂單

將購物車使用COOKIE存，到最後要成立訂單再匯入資料庫


2019/08/11 V1
未完成:無使用oop、最後訂單入資料庫、帳號註冊、防呆、加入購物車function優化...

改善方向:資料庫相關的要學好一點、學習使用oop寫法應該比較方便、各個function的優化...

2019/08/11 V2
將最後訂單匯入資料庫後顯示出來。

未完成:無使用oop、帳號註冊、防呆、function addCart()優化、使用者訂單查詢功能...  

BUG:購買單項商品超過20個，在訂單頁面的數量會抓不到而顯示1

改善方向:資料庫相關的(pdo,關聯...)要學好一點、學習使用oop寫法應該比較方便、addCart()判斷寫好一點...    
BUG:限制購買數量               
$_COOKIE有時消失或銷毀沒做好或亂切畫面，購物車會大亂                 
流程應該要改成沒登入也能先加入購物車               
訂單匯入資料庫的時候，發現table cart設計不好，匯不進去，之後才改primary key才成功匯入                   
table cart應該命名為order比較適當                  
購物車要使用$_COOKIE還是$_SESSION還是資料庫的差別              








        
