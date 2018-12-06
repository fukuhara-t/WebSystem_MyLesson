<html>
    {include file='../../../temp/header.tpl'}
    <body>
        
        <h2>書籍詳細</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>書籍名</th>
                <th>書籍名(ふりがな)</th>
                <th>著者名</th>
                <th>著者名(ふりがな)</th>
                <th>出版年</th>
                <th></th>
            </tr>
            {foreach from=$books item=book_info}
            <tr>
                <td>{$book_info.book_id}</td>
                <td>{$book_info.book_name}</td>
                <td>{$book_info.book_phonetic_name}</td>
                <td>{$writers[0]['writer_name']}</td>
                <td>{$writers[0]['writer_phonetic_name']}</td>
                <td>{$book_info.publication_date}</td>
                <td>
                    <input type="button" onclick="location.href='/Main.php/Bookupdate/book_id={$book_info.book_id}/'" value="編集" />
                    <form action="/Main.php/Bookindex/Bookdelete/book_id={$book_info.book_id}/" method="post" onsubmit="return confirm('内容を削除しても良いですか？');">
                        <input type="submit" value="削除">
                    </form>
                </td>
                
            </tr>
            {/foreach}    
        </table>
    </body>
    <footer>
        {include file='../../../temp/footer.tpl'}
    </footer>
</html>