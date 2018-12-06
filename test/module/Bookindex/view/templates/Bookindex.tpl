<html>
    {include file='../../../temp/header.tpl'}
    <body>
        <h2>書籍一覧</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>書籍名</th>
                <th>書籍名(ふりがな)</th>
                <th>出版年</th>
                <th></th>
            </tr>
            {foreach from=$books item=book_info}
            {if $book_info.book_name != 'NO_DATA'}
            <tr>
                <td>{$book_info.book_id}</td>
                <td><a href="/Main.php/Bookinfo/book_id={$book_info.book_id}/">{$book_info.book_name}</a></td>
                <td>{$book_info.book_phonetic_name}</td>
                <td>{$book_info.publication_date}</td>
                <td>
                    <input type="button" onclick="location.href='/Main.php/Bookupdate/book_id={$book_info.book_id}/'" value="編集" />
                    <form action="/Main.php/Bookindex/Bookdelete/book_id={$book_info.book_id}/" method="post" onsubmit="return confirm('内容を削除しても良いですか？');">
                        <input type="submit" value="削除">
                    </form>   
                </td>
            </tr>
            {/if}
            {/foreach}    
        </table>
        <h2>新規追加</h2>
        <table>
            <tr>
                <th>書籍名</th>
                <th>書籍名(ふりがな)</th>
                <th>著者名</th>
                <th>出版年</th>
            </tr>
            <form action="/Main.php/Bookindex/Bookinsert/" method="post" onsubmit="return confirm('内容を追加しても良いですか？');">
                <tr>
                    <td><input type="text" name="name" size="15" value="" /></td>
                    <td><input type="text" name="phonetic_name" size="15" value="" /></td>
                    <td>
                    <select name="writer_id">
                    {foreach from=$writers item=writer_info}
                    {if $writer_info.writer_name != 'NO_DATA'}
                    <option value={$writer_info.writer_id}>{$writer_info.writer_name}</option>
                    {/if}
                    {/foreach}
                    </select>
                    </td>
                    <td><input type="number" name="publication_date" min="0" size="10" value="" ></td>
                </tr>
                <tr>
                    <td colspan="6"><input type="submit" value="新規追加"><td>
                </tr>
            </form> 
                
        </table>
    </body>
    <footer>
        {include file='../../../temp/footer.tpl'}
    </footer>
</html>