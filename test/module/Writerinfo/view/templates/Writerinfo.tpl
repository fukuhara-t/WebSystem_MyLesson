<html>
    {include file='../../../temp/header.tpl'}
    <body>    
        <h2>書籍詳細</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>著者名</th>
                <th>著者名(ふりがな)</th>
                <th></th>
            </tr>
            {foreach from=$writers item=writers_info}
            <tr>
                <td>{$writers_info.writer_id}</td>
                <td>{$writers_info.writer_name}</td>
                <td>{$writers_info.writer_phonetic_name}</td>
                <td>
                    <input type="button" onclick="location.href='/Main.php/Writerupdate/writer_id={$writers_info.writer_id}/'" value="編集" />
                    <form action="/Main.php/Writerindex/Writerdelete/writer_id={$writers_info.writer_id}/" method="post" onsubmit="return confirm('内容を削除しても良いですか？');">
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