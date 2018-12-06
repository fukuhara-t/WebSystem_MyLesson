<html>
    {include file='../../../temp/header.tpl'}
    <body>
        
        <h2>著者情報編集</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>著者名</th>
                <th>著者名(ふりがな)</th>
            </tr>
            {foreach from=$writers item=writer_info}
            <tr>
                <td>{$writer_info.writer_id}</td>
                <td>{$writer_info.writer_name}</td>
                <td>{$writer_info.writer_phonetic_name}</td>
            </tr>
            <tr>
                <td> </td>
                <td>↓</td>
                <td>↓</td>
            </tr>
            <form action="/Main.php/Writerupdate/Writerchange/writer_id={$writer_info.writer_id}/" method="post" onsubmit="return submitChk()">
                <tr>
                    <td>{$writer_info.writer_id}</td>
                    <td><input type="text" name="name" size="15" value={$writer_info.writer_name} /></td>
                    <td><input type="text" name="phonetic_name" size="15" value={$writer_info.writer_phonetic_name} /></td>
                </tr>
                <tr>
                    <td colspan="6"><input type="submit" value="編集"><td>
                </tr> 
            </form>

            {/foreach} 

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