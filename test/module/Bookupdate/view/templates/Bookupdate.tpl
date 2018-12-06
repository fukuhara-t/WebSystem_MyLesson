<html>
    {include file='../../../temp/header.tpl'}
    <body>
        
        <h2>書籍詳細</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>書籍名</th>
                <th>書籍名(ふりがな)</th>
                <th>書籍ID</th>
                <th>出版年</th>
            </tr>
            <tr>
                <td>{$books[0]["book_id"]}</td>
                <td>{$books[0]["book_name"]}</td>
                <td>{$books[0]["book_phonetic_name"]}</td>
                <td>{$writer[0]["writer_name"]}</td>
                <td>{$books[0]["publication_date"]}</td>
            </tr>
            <tr>
                <td> </td>
                <td>↓</td>
                <td>↓</td>
                <td>↓</td>
                <td>↓</td>
            </tr>
            <form action="/Main.php/Bookupdate/Bookchange/book_id={$books[0]["book_id"]}/" method="post" onsubmit="return submitChk()">
                <tr>
                    <td>{$books[0]["book_id"]}</td>
                    <td><input type="text" name="name" size="15" value={$books[0]["book_name"]} /></td>
                    <td><input type="text" name="phonetic_name" size="15" value={$books[0]["book_phonetic_name"]} /></td>
                    <td>
                        <select name="writer_id">
                        {foreach from=$writers item=writer_info}
                        {if $writer_info.writer_name != 'NO_DATA'}
                        <option value={$writer_info.writer_id}>{$writer_info.writer_name}</option>
                        {/if}
                        {/foreach}
                        </select>
                    </td>
                    <td><input type="number" name="publication_date" min="0" size="15" value={$books[0]["publication_date"]} ></td>
                </tr>
                <tr>
                    <td colspan="6"><input type="submit" value="編集"><td>
                </tr> 
            </form>

            
        </table>
    
        
        <script>
            function submitChk () {
                /* 確認ダイアログ表示 */
                var flag = confirm ( "更新してもよろしいですか？\n\n更新したくない場合は[キャンセル]ボタンを押して下さい");
                /* send_flg が TRUEなら送信、FALSEなら送信しない */
                return flag;
            }
        </script>
        
    </body>
    <footer>
        {include file='../../../temp/footer.tpl'}
    </footer>
</html>