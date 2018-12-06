<html>
    {include file='../../../temp/header.tpl'}
    <body>
        <h2>著者一覧</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>著者名</th>
                <th>著者名(ふりがな)</th>
            </tr>

            {foreach from=$writers item=writers_info}
            {if $writers_info.writer_name != 'NO_DATA'}
            <tr>
                <td>{$writers_info.writer_id}</td>
                <td><a href="/Main.php/Writerinfo/writer_id={$writers_info.writer_id}/">{$writers_info.writer_name}</a></td>
                <td>{$writers_info.writer_phonetic_name}</td>
                <td>
                    <input type="button" onclick="location.href='/Main.php/Writerupdate/writer_id={$writers_info.writer_id}/'" value="編集" />
                    <form action="/Main.php/Writerindex/Writerdelete/writer_id={$writers_info.writer_id}/" method="post" onsubmit="return confirm('内容を削除しても良いですか？');">
                        <input type="submit" value="削除">
                    </form>   
                </td>
            <tr>
            {/if}
            {/foreach}
        </table>
        <h2>新規追加</h2>
        <table>
            <tr>
                <th>著者名</th>
                <th>著者名(ふりがな)</th>
            </tr>
            <form action="/Main.php/Writerindex/Writerinsert/" method="post" onsubmit="return confirm('内容を追加しても良いですか？');">
                <tr>
                    <td><input type="text" name="name" size="15" value="" /></td>
                    <td><input type="text" name="phonetic_name" size="15" value="" /></td>
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